@extends('layouts.frontend')
@section('title', 'My Account | Address')
<style type="text/css">
   .error
   {
      color:#ff0000;
      font-weight: 600;
   }
</style>
@section('body')

<main id="main" class="main-site left-sidebar pt-5 pb-60">
  <div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="dropdown sidebar sidebar-md pb-10">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    My Account
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="dropdown-header">Hello User</li>
                    <li><a href="{{ route('user.myaccount') }}">Account Info</a></li>
                    <li class="active"><a href="#">Saved Address</a></li>
                    <li><a href="{{ route('user.review') }}">Product Reviews</a></li>
                    <li><a href="{{ route('user.order') }}">My Orders</a></li>
                    <li><a href="{{ route('user.wishlist') }}">My Wishlist</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
               <form action="{{ route('address.store') }}" method="POST" id="submit-form">
                 {{ csrf_field() }}
                <div class="col-md-6">

                     <div class="form-group">
                        <label>Full Name: </label>
                         <input name="fullname" type="text" placeholder="ex. Juan Dela Cruz" class="form-control" value="{{old('fullname')}}" autocomplete="disabled">
                     </div>
                     <div class="form-group">
                        <label>Contact No.:</label>
                         <input type="text" name="telephone" class="form-control" placeholder="ex. 09876543210" value="{{old('telephone')}}" autocomplete="disabled">
                     </div>
                     <div class="form-group">
                        <label>Address Description (Note).:</label>
                        <textarea class="form-control textarea-data" name="address_description" placeholder="Please Enter your address description (optional)"></textarea>
                     </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                           <label>House/Block/Lot No./Street/Purok/Subd.:</label>
                           <input type="text" name="house_info" class="form-control" placeholder="ex. #03 Coolidge St., Village, Phase 2" value="{{old('house_info')}}" autocomplete="disabled">
                     </div>
                     <div class="form-group">
                        <label>Province:</label>
                           <select class="form-control" name="province_id"  id="province_id">
                              <option selected disabled>Select Province</option>
                              @foreach($province as $x)
                              <option value="{{ $x->province_id }}">{!! $x->name !!}</option>
                              @endforeach
                           </select>
                     </div>
                     <div class="form-group">
                        <label>City/Municipality:</label>
                          <select class="form-control" name="city_id" id="city_id">
                               <option selected disabled>Select City</option>
                          </select>
                     </div>
                     <div class="form-group">
                        <label>Barangay:</label>
                           <select class="form-control" name="barangay_id" id="barangay_id">
                              <option selected disabled>Select Barangay</option>
                           </select>
                     </div>
                     <button type="submit" class="btn btn-success pull-right">Submit</button>
                     <a href="{{ route('address.index') }}" class="btn btn-info pull-right mr-1">Cancel</a>
                </div>
               </form>
              </div>
            </div>
        </div>
    </div>
  </div><!--end container-->

</main>

@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script type="text/javascript">
    $(function() { 
      var address = {
             province: "{{old('province_id')}}",
             city: "{{old('city_id')}}",
             barangay: "{{old('barangay_id')}}",
         };
      $('#province_id').on('change', function () {
            $.getJSON('/api/city/' + this.value, function (data) {
                var options = '<option selected disabled>Select City</option>';
                $.each(data, function (index, data) {
                    var selected = '';
                        options += '<option value="' + data.city_id + '"' + selected + '>' + data.name + '</option>';
                });
                $('#city_id').html(options);
                $('#city_id').change();
                $('#barangay_id').html('<option selected disabled>Select Barangay</option>');
            });
        }).change();
      $('#city_id').on('change', function () {
         $.getJSON('/api/barangay/' + this.value, function (data) {
              var options = '<option selected disabled>Select Barangay</option>';
              $.each(data, function (index, data) {
                  var selected = '';
                  if (data.city_id == address.city) {
                      selected = ' selected ';
                  }
                  options += '<option value="' + data.code + '"' + selected + '>' + data.name + '</option>';
              });
              $('#barangay_id').html(options);
              $('#barangay_id').change();
          });
      }).change();
    });
$(document).ready(function(){

 if($("#submit-form").length > 0)
  {
    $('#submit-form').validate({
      rules:{
        fullname : {
          required : true,
          maxlength : 30
        },
        telephone : {
          required : true,
          maxlength : 12, 
          minlength : 10, 
          number : true
        },
        house_info : {
          required : true,
          maxlength : 60, 
          minlength : 6
        },
        province_id : {
          required : true,
        },
        city_id : {
          required : true,
        },
        barangay_id : {
          required : true,
        },
      },
      messages : {
        fullname : {
          required : 'The Full Name field is required',
          maxlength : 'Full Name should not be more than 30 character'
        },
        telephone : {
          required : 'The Contact Number field is required',
          number : 'The Contact Number must be a number',
          maxlength : 'Contact Number should not be less than 10 character',
          minlength : 'Contact Number should not be more than 12 character'
        },
        house_info : {
          required : 'The House/Block/Lot No. field is required',
          maxlength : 'House/Block/Lot No. should not be less than 60 character',
          minlength : 'House/Block/Lot No. should not be more than 6 character'
        },
        province_id : {
          required : 'The Province field is required',
        },
        city_id : {
          required : 'The City field is required',
        },
        barangay_id : {
          required : 'The Barangay field is required',
        },
      }
    });
  }

});
</script>
@endsection