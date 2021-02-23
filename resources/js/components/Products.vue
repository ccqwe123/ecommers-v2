<template>
    <div class="container-fluid">
        <div class="invoice p-3 m-3">
          <div class="row">
            <div class="col-md-12">
              <h4>
                <i class="fas fa-store"></i> Product List
                <small class="float-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add-product" @click="loadModal"><i class="fas fa-plus"></i> Add Product</button>
                </small>
              </h4>
            </div>
          </div>

          <!-- Table row -->
          <div class="row mt-2">
            <div class="col-md-12 table-responsive">
              <table id="" class="table table-bordered table-striped"  :class="{'loading': loading}">
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
                  <td class="tableheaderProduct"><img class="product-height" :src="productImage(product.preview_image ? product.preview_image.image_name : 'default.png')"></td>
                  <td class="tableheaderProduct">{{product.name}}</td>
                  <td class="tableheaderCategory">{{product.category_name}}
                  </td>
                  <td class="tableheaderPrice">{{product.regular_price}}</td>
                  <td class="tableheaderStatus" v-if="product.stock_status !== 'instock'"><span class="badge bg-danger">Out of Stock</span></td>
                  <td class="tableheaderStatus" v-else> <span class="badge bg-success">In Stock</span></td>
                  <td style="min-width: 170px;">
                    <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-secondary"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
        <div class="modal fade" id="add-product">
            <div class="modal-dialog modal-xl modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Product</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="createProduct">
                <div class="modal-body">
                        <div class="form-group">
                            <div class="uploader"
                                @dragenter="OnDragEnter"
                                @dragleave="OnDragLeave"
                                @dragover.prevent
                                @drop="onDrop"
                                :class="{ dragging: isDragging }">
                                
                                <div class="upload-control" v-show="images.length">
                                    <label for="file">Select a file</label>
                                    <button @click.prevent="clearImage">Clear</button>
                                </div>


                                <div v-show="!images.length">
                                    <i class="fa fa-cloud-upload"></i>
                                    <p>Drag your images here</p>
                                    <div>OR</div>
                                    <div class="file-input">
                                        <label for="file">Select a file</label>
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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input v-model="form.name" type="text" name="name" placeholder="Product Name" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="product_name"></has-error>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id">
                                    <option value="" disabled>Select Category</option>
                                    <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                 </select>
                                  <has-error :form="form" field="category_id"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input v-model="form.regular_price" type="number" name="regular_price" placeholder="Regular Price" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('regular_price') }">
                                    <has-error :form="form" field="regular_price"></has-error>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.sale_price" type="number" name="sale_price" placeholder="Sale Price (0 if not Sale/Promo)" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('sale_price') }">
                                  <has-error :form="form" field="sale_price"></has-error>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                          
                        </div>
                        <div class="form-group">
                            <vue-editor v-model="form.details" placeholder="Produt Details" :editorToolbar="customToolbar"></vue-editor>
                        </div>
                        <div class="form-group">
                         
                        </div>
                        <div class="form-group">
                            <vue-editor v-model="form.content" placeholder="Item Description" :editorToolbar="customToolbar"></vue-editor>
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
<style type="text/css">
    .tableheaderStatus {
        max-width: 250px;
        height: 40px;
        white-space: nowrap;
        overflow-wrap: break-word;
        overflow: hidden;
        width: 250px;
    }
    .tableheaderPrice {
        max-width: 150px;
        height: 40px;
        white-space: nowrap;
        overflow-wrap: break-word;
        overflow: hidden;
        width: 100px;
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
        height: 75px;
    }
    
</style>
<script>
    import datatable from 'datatables.net-bs4'
    export default {
        data(){
            return {
                form: new Form({
                    name: '',
                    regular_price: '',
                    sale_price: '',
                    stock_status: '',
                    category_id: '',
                    images:[],
                    content: '',
                    details: '',
                }),
                editmode: false,
                loading: true,
                products: {},
                categories: {},
                category: '',
                isDragging: false,
                dragCount: 0,
                files: [],
                images: [],
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
            $('.model').hide();

            
        },

        methods: {
            loadModal(){
                this.editmode = false;
                this.form.reset();
                $('#add-product').modal('show');
            },
            loadProducts()
            {
                axios.get("api/products")
                .then(response => {
                    this.products = response.data;
                    this.loading = false;
                    console.log(response.data.data)
                });
                // axios.get("api/products").then(({ data }) => (this.products = data));
                //     this.loading = false;
            },
            loadCategory()
            {
                axios.get("api/categories")
                .then(response => {
                    this.categories = response.data;
                    console.log(response.data);
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
            console.log(file);
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
            //
            // const formData = new FormData();
            
            // this.files.forEach(file => {
            //     formData.append('images[]', file, file.name);
            // });
            // axios.post('/images-upload', formData)
            //     .then(response => {
            //         this.$toastr.s('All images uplaoded successfully');
            //         this.images = [];
            //         this.files = [];
            //     })
        },
        getResults(page = 1) {
                axios.get('api/products?page=' + page)
                    .then(response => {
                        this.products = response.data;
                    });
        },
        productImage(image)
        {
            if(image)
            {
                let photo = 'images/products/'+image;
               return photo;
            }else{
                let photos = 'default.png';
               return photos;
            }
             let photo = image ? image : image;
             // product.preview_image ? product.preview_image.image_name : 'images/products/default.png'
        },
        createProduct() {
            //  const formData = new FormData();
            // let vm = this.form;
            // this.files.forEach(file => {
            //     formData.append('images[]', file, file.name);
            //     console.log(this.files);
            // });
            // formData.append('name', this.form.name);
            // formData.append('regular_price', this.form.regular_price);
            // formData.append('sale_price', this.form.sale_price);
            // formData.append('stock_status', this.form.stock_status);
            // formData.append('category_id', this.form.category_id);
            // axios.post('/api/products', formData)
            //     .then(response => {
            //         // this.images = [];
            //         this.form.images = [];
            //         this.files = [];
            //         this.dragCount = 0;
            //     })
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
            // loadData(){
            //     this.$nextTick(()=>{
            //         $('#productdt').DataTable();
                        // $('.modal').modal('hide');
            //     })
            // }
        }
    }
</script>
