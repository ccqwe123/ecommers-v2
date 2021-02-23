<template>
    <div class="container-fluid" :class="{'loading': loading}">
        <div class="invoice p-3 m-3">
          <div class="row">
            <div class="col-md-12">
              <h4>
                <i class="fas fa-store"></i> Product List
                <small class="float-right">
                    <button class="btn btn-success"><i class="fas fa-plus"></i> Add Product</button>
                </small>
              </h4>
            </div>
          </div>

          <!-- Table row -->
          <div class="row mt-2">
            <div class="col-md-12 table-responsive">
              <table id="productdt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="tableheaderProduct">TrNameNameNameNameNa meNameNameNameNameNameNameNameNameNameNameNameNameNameNameidentTrNameNameNameNameNameNameNameNameNameNameNameNameNameNameNameNameNameNameNameident</td>
                  <td class="tableheaderCategory">InteNameNameNameNameNameNameNameNameNamernet
                    Explorer 4.0
                  </td>
                  <td class="tableheaderPrice">WiNameNameNameNameNameNamen 95+</td>
                  <td class="tableheaderStatus"> 4</td>
                  <td style="min-width: 170px;">
                    <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-secondary"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
    </div>
</template>
<style type="text/css" scoped>
    .dataTables_filter, .dataTables_paginate{
        float:right!important;
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
</style>
<script>
    import datatable from 'datatables.net-bs4'
    export default {
        mounted() {
            this.loadData()
            
            
        },
        methods: {
            loadData(){
                this.$nextTick(()=>{
                    $('#productdt').DataTable();
                })
            }
        }
    }
</script>
