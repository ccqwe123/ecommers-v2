<template>
    <div class="container-fluid">
        <div class="invoice p-3 m-3">
          <div class="row">
            <div class="col-md-12">
              <h4>
                <i class="fas fa-boxes nav-icon"></i> Category List
                <small class="float-right"  :class="{'loading': loading}">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add-product" @click="loadModal"><i class="fas fa-plus"></i> New Category</button>
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
                  <th>Category Name</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                    
                <tr v-for="category in categories.data" :key="category.id">
                  <td class="tableheaderProduct">{{category.category_name}}</td>
                  </td>
                  <td style="max-width: 20px; min-width: 160px;">
                    <button class="btn btn-primary" title="edit" @click="editProduct(category)"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" @click="deleteCategory(category.id)"><i class="fas fa-trash-alt"></i></button>
                  </td>
                </tr>
                </tbody>
              </table>
            <pagination :data="categories" @pagination-change-page="getResults" class="float-right"></pagination>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <div class="modal fade" id="add-category">
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">New Category</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                <div class="modal-body">
                        <div class="form-group">
                                <input v-model="form.category_name" type="text" name="category_name" placeholder="Category Name" 
                            class="form-control" :class="{ 'is-invalid': form.errors.has('category_name') }">
                                <has-error :form="form" field="category_name"></has-error>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
              </div>
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
                    name: '',
                }),
                categories: {},
                editmode: false,
                loading: true,
            }
        },
        mounted() {
            // this.loadData()
            this.loadCategory();
            $('.model').hide();

            
        },

        methods: {
            loadModal(){
                this.editmode = false;
                this.form.reset();
                $('#add-category').modal('show');
            },
            loadCategory()
            {
              axios.get("api/category")
                .then(response => {
                  // console.log(response.data);
                    this.categories = response.data;
                    this.loading = false;
                });
            },
        getResults(page = 1) {
            this.loading = true;
            axios.get('api/category?page=' + page)
                .then(response => {
                    this.categories = response.data;
                    this.loading = false;
                });
        },
        editProduct(product)
        {
             this.editmode = true;
             this.editmodeImage = true;
            this.form.reset();
            $('#add-category').modal('show');
            this.form.fill(product);
            this.form.images = product.images ? product.images : '';
        },
        deleteCategory(id)
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
                                this.form.delete('api/category/'+id).then(()=>{
                                        swal.fire(
                                        'Deleted!',
                                        'Category has been deleted.',
                                        'success'
                                        )
                                    this.loadCategory();
                                }).catch(()=> {
                                    swal("Failed!", "There was something wronge.", "warning");
                                });
                         }
                    })
        },
        updateCategory()
        {
            this.form.put('api/category/'+this.form.id)
                .then(() => {
                    // success
                    $('#add-category').modal('hide');
                     toast.fire(
                        'Updated!',
                        'Category has been updated.',
                        'success'
                        )
                     this.loadCategory();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        createCategory() {
                this.form.post('api/category')
                .then(response => {
                    $('#add-category').modal('hide');
                    this.loadCategory();
                    toast.fire({
                      icon: 'success',
                      title: 'Category Successfully Added'
                    })
                })
            },
        }
    }
</script>
