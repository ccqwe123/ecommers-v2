<template>
    <div class="container-fluid">
        <div class="row" v-if="on_sale_check">
            <div class="col-md-12">
                <div class="float-right">
                    <span class="mr-4" @click="updateOnsaleData(on_sale)">OnSale Ends: <b>{{on_sale.onsale | humanDate }}</b></span>
                </div>
            </div>
        </div>
        <div class="invoice p-3 m-3">
          <div class="row">
            <div class="col-md-12"  :class="{'loading': loading}">
              <h4>
                <i class="fas fa-store"></i> Product List
                <small class="float-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add-product" @click="loadModal"><i class="fas fa-plus"></i> Add Product</button>

                    <button class="btn btn-warning" data-toggle="modal" data-target="#add-onsale" @click="loadOnSaleModal"><i class="fas fa-calendar-plus"></i></i> Set On Sale Date</button>
                </small>
              </h4>
            </div>
          </div>

          <!-- Table row -->
          <div class="row mt-2">
            <div class="col-md-12 table-responsive">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    
                <tr v-for="product in products.data" :key="product.id">
                  <td style="width: 5px;"><img class="product-height" :src="product.preview_image ? product.preview_image.image_name : 'images/products/default.png'"></td>
                  <td class="tableheaderProduct">{{product.product_name}}</td>
                  <td class="tableheaderCategory">{{product.category_name}}
                  </td>
                  <td class="tableheaderPrice">{{product.regular_price}}.00</td>
                  <td class="tableheaderStatus" v-if="product.stock_status !== 'instock'"><span class="badge bg-danger">Out of Stock</span></td>
                  <td class="tableheaderStatus" v-else> <span class="badge bg-success">In Stock</span></td>
                  <td style="max-width: 20px; min-width: 160px;">
                    <button class="btn btn-primary" title="edit" @click="editProduct(product)"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" @click="deleteProduct(product.id)"><i class="fas fa-trash-alt"></i></button>
                  </td>
                </tr>
                </tbody>
              </table>
            <pagination :data="products" @pagination-change-page="getResults" class="float-right"></pagination>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <div class="modal fade" id="add-onsale">
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Set On Sale Date</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editmode ? updateOnSale() : createOnSale()">
                <div class="modal-body">
                    <div class="col-md-12">
                        <input v-model="form.onsale" type="datetime-local" name="onsale" 
                        class="form-control" :class="{ 'is-invalid': form.errors.has('onsale') }">
                        <has-error :form="form" field="onsale"></has-error>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
        </div>
        <div class="modal fade" id="add-product">
            <div class="modal-dialog modal-xl modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Product</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editmode ? updateProduct() : createProduct()">
                <div class="modal-body">
                        <div class="form-group" v-if="editmode">
                            <div class="uploader"
                                @dragenter="OnDragEnter"
                                @dragleave="OnDragLeave"
                                @dragover.prevent
                                @drop="onDrop"
                                :class="{ dragging: isDragging }">
                                
                                <div class="upload-control" v-if="editmodeImage">
                                    <button @click.prevent="newImage">New</button>
                                </div>
                                <div v-else>
                                    <div class="upload-control" v-show="images.length">
                                        <label for="file">Select Image</label>
                                        <button @click.prevent="clearImage">Clear</button>
                                    </div>
                                    <div v-show="!images.length">
                                        <i class="fa fa-cloud-upload"></i>
                                        <p>Drag your images here</p>
                                        <div class="or">OR</div>
                                        <div class="file-input">
                                            <label for="file">Select Image</label>
                                            <input type="file" id="file" @change="onInputChange" multiple accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                </div>

                                <div class="images-preview" v-if="editmodeImage">
                                    <div class="img-wrapper" v-for="image in this.form.images">
                                        <img :src="image.image_name ? image.image_name : 'images/products/default.png'">
                                        <div class="details">
                                        </div>
                                    </div>
                                </div>

                                <div class="images-preview" v-show="form.images.length" v-else>
                                    <div class="img-wrapper" v-for="(image, index) in form.images" :key="index">
                                        <img :src="image" :alt="`Image Uplaoder ${index}`">
                                        <div class="details">
                                            <span class="name" v-text="files[index].name"></span>
                                            <span class="size" v-text="getFileSize(files[index].size)"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" v-else>
                            <div class="form-group">
                            <div class="uploader"
                                @dragenter="OnDragEnter"
                                @dragleave="OnDragLeave"
                                @dragover.prevent
                                @drop="onDrop"
                                :class="{ dragging: isDragging }">
                                <div class="upload-control" v-show="images.length">
                                    <label for="file">Select Image</label>
                                    <button @click.prevent="clearImage">Clear</button>
                                </div>
                                <div v-show="!images.length">
                                    <i class="fa fa-cloud-upload"></i>
                                    <p>Drag your images here</p>
                                    <div class="or">OR</div>
                                    <div class="file-input">
                                        <label for="file">Select Image</label>
                                        <input type="file" id="file" @change="onInputChange" multiple accept=".png, .jpg, .jpeg">
                                    </div>
                                </div>

                                <div class="images-preview" v-show="form.images.length">
                                    <div class="img-wrapper" v-for="(image, index) in form.images" :key="index">
                                        <img :src="image" :alt="`Image Uplaoder ${index}`">
                                        <div class="details">
                                            <span class="name" v-text="files[index].name"></span>
                                            <span class="size" v-text="getFileSize(files[index].size)"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input v-model="form.product_name" type="text" name="product_name" placeholder="Product Name" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_name') }">
                                    <has-error :form="form" field="product_name"></has-error>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id">
                                    <option value="" disabled>Select Category</option>
                                    <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.category_name}}</option>
                                 </select>
                                  <has-error :form="form" field="category_id"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input v-model="form.regular_price" type="number" name="regular_price" placeholder="After Price" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('regular_price') }">
                                    <has-error :form="form" field="regular_price"></has-error>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.sale_price" type="number" name="sale_price" placeholder="Before Price (0 if not Sale/Promo)" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('sale_price') }">
                                  <has-error :form="form" field="sale_price"></has-error>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="new" value="1" v-model="form.new">
                              <label class="form-check-label" for="new">New</label>
                            </div>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="promo" value="1" v-model="form.promo">
                              <label class="form-check-label" for="promo">Promo</label>
                            </div>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="sale" value="1" v-model="form.sale">
                              <label class="form-check-label" for="sale">Sale</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <vue-editor v-model="form.details" placeholder="Produt Details" :editorToolbar="customToolbar"></vue-editor>
                        </div>
                        <div class="form-group">
                         
                        </div>
                        <div class="form-group">
                            <vue-editor v-model="form.description" placeholder="Item Description" :editorToolbar="customToolbar"></vue-editor>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
        </div>

    </div>
</template>
<style type="text/css" scoped>
    .uploader .file-input label:hover {
        background: #c9c9c973;
        color: #ffffff;
    }
    .uploader .file-input label, .uploader .file-input input {
        border: 1px solid;
        background: #ffffff73;
        color: #020202;
        width: 100%;
        position: absolute;
        left: 0;
        top: 0;
        padding: 10px;
        border-radius: 5px;
        margin-top: 7px;
        cursor: pointer;
    }
    .uploader
    {
        background: #c1c1c161!important;
    }
    p, .or{
        color:#000000;
    }
    .tableheaderStatus {
        max-width: 250px;
        height: 40px;
        white-space: nowrap;
        overflow-wrap: break-word;
        overflow: hidden;
        width: 250px;
    }
    .tableheaderPrice {
        max-width: 200px;
        height: 40px;
        white-space: nowrap;
        overflow-wrap: break-word;
        overflow: hidden;
        width: 40px;
    }
    .tableheaderCategory {
        max-width: 300px;
        height: 40px;
        white-space: nowrap;
        overflow-wrap: break-word;
        overflow: hidden;
        width: 300px;
    }
    .tableheaderProduct {
    max-width: 400px;
    height: 40px;
    white-space: nowrap;
    overflow-wrap: break-word;
    overflow: hidden;
    /*width: 400px;*/
    }
    .product-height {
        height: 60px;
        width: 60px;
        max-width: 60px;
    }
    .table th, .table td {
        padding: 0.5rem !important;
    }
</style>
<script>
    import datatable from 'datatables.net-bs4'
    export default {
        data(){
            return {
                form: new Form({
                    id:'',
                    product_name: '',
                    regular_price: '',
                    sale_price: '',
                    stock_status: '',
                    category_id: '',
                    images:[],
                    description: '',
                    details: '',
                    onsale: '',
                    new: false,
                    promo: false,
                    sale: false,
                }),
                on_sale: '',
                on_sale_check: false,
                editmode: false,
                loading: true,
                products: {},
                categories: {},
                category: '',
                isDragging: false,
                dragCount: 0,
                files: [],
                images: [],
                editmodeImage: true,
                customToolbar: [
                    ["bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [
                        { align: "" },
                        { align: "center" },
                        { align: "right" },
                        { align: "justify" }
                    ],
                    [{ color: [] }]
                ]
            }
        },
        mounted() {
            // this.loadData()
            this.loadProducts();
            this.loadCategory();
            this.loadOnSale();
            $('.model').hide();

            
        },

        methods: {
            updateOnSale(){
                 this.form.post('api/settings')
                .then(response => {
                    $('#add-onsale').modal('hide');
                    toast.fire({
                      icon: 'success',
                      title: 'On Sale Successfully Created'
                    })
                    this.form.onsale = [];
                    // this.on_sale_check = true;
                    this.loadOnSale();
                })
            },
            updateOnsaleData(on_sale){
                this.editmode = true;
                this.form.onsale = moment(on_sale.onsale).format('YYYY-MM-DDThh:mm')
                $('#add-onsale').modal('show');
            },
            loadOnSaleModal(){
                this.editmode = false;
                this.form.reset();
                $('#add-onsale').modal('show');
            },
            loadModal(){
                this.editmode = false;
                this.form.reset();
                $('#add-product').modal('show');
            },
            loadProducts()
            {
                setTimeout(() => {
                    axios.get("api/products")
                    .then(response => {
                        this.products = response.data;
                            this.loading = false;
                        });
                    }, 0)
            },
            loadOnSale()
            {
                axios.get("api/settings")
                .then(response => {
                    this.on_sale = response.data;
                    if(this.on_sale.onsale !== null)
                    {
                        this.on_sale_check = true;
                    }
                });
            },
            loadCategory()
            {
                axios.get("api/category/list/cat")
                .then(response => {
                    console.log(response);
                    this.categories = response.data;
                });
            },
            OnDragEnter(e) {
            e.preventDefault();
            
            this.dragCount++;
            this.isDragging = true;
            return false;
            },
            OnDragLeave(e) {
                e.preventDefault();
                this.dragCount--;
                if (this.dragCount <= 0)
                    this.isDragging = false;
            },
            onInputChange(e) {
            const files = e.target.files;
            Array.from(files).forEach(file => this.addImage(file));
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            this.isDragging = false;
            const files = e.dataTransfer.files;
            Array.from(files).forEach(file => this.addImage(file));
        },
        addImage(file) {
            let vm = this;
            if (!file.type.match('image.*')) {
                this.$toastr.e(`${file.name} is not an image`);
                return;
            }
            this.files.push(file);
            const img = new Image();
            let reader = new FileReader();
            //
            reader.onloadend = (file) => {

                // this.images.push(reader.result);
                this.images.push(reader.result);

            }
            //
            reader.onload = (e) => this.form.images.push(e.target.result);
            // reader.onload = (e) => this.form.image.push(e.target.result);
            
            reader.readAsDataURL(file);
        },
        newImage()
        {
            this.editmodeImage = false;
            this.images = [];
            this.form.images = [];
            this.files = [];
            this.dragCount = 0;
        },
        getFileSize(size) {
            const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
            let i = 0;
            
            while(size > 900) {
                size /= 1024;
                i++;
            }
            return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
        },
        clearImage() {
            this.images = [];
            this.form.images = [];
            this.files = [];
            this.dragCount = 0;
        },
        getResults(page = 1) {
            this.loading = true;
            axios.get('api/products?page=' + page)
                .then(response => {
                    this.products = response.data;
                    this.loading = false;
                });
        },
        productImage(image)
        {
            let photos 
            if(image)
            {
                photos = 'images/products/'+image;
            }else{
                // photos = 'default.png';
            }
                return photos;
             // product.preview_image ? product.preview_image.image_name : 'images/products/default.png'
        },
        editProduct(product)
        {
             this.editmode = true;
             this.editmodeImage = true;
            this.form.reset();
            $('#add-product').modal('show');
            this.form.fill(product);
            console.log(product);
            this.form.new = parseInt(product.new);
            this.form.promo = parseInt(product.promo);
            this.form.sale = parseInt(product.sale);
            this.form.images = product.images ? product.images : '';
        },
        deleteProduct(id)
        {
            swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/products/'+id).then(()=>{
                                        swal.fire(
                                        'Deleted!',
                                        'Product has been deleted.',
                                        'success'
                                        )
                                    this.loadProducts();
                                }).catch(()=> {
                                    swal("Failed!", "There was something wronge.", "warning");
                                });
                         }
                    })
        },
        updateProduct()
        {
            this.form.put('api/products/'+this.form.id)
                .then(() => {
                    // success
                    $('#add-product').modal('hide');
                     toast.fire(
                        'Updated!',
                        'Product has been updated.',
                        'success'
                        )
                     this.loadProducts();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        createOnSale() {
            this.form.post('api/settings')
            .then(response => {
                $('#add-onsale').modal('hide');
                toast.fire({
                  icon: 'success',
                  title: 'On Sale Successfully Created'
                })
                this.form.onsale = [];
                // this.on_sale_check = true;
                this.loadOnSale();
            })
        },
        createProduct() {
                this.form.post('api/products')
                .then(response => {
                    $('#add-product').modal('hide');
                    this.loadProducts();
                    toast.fire({
                      icon: 'success',
                      title: 'Product Successfully Added'
                    })
                   this.images = [];
                    this.form.images = [];
                    this.files = [];
                    this.dragCount = 0;
                })
            },
        }
    }
</script>
