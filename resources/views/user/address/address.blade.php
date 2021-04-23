@extends('layouts.frontend')
@section('title', 'My Account')
<style type="text/css">
	.modal {
    text-align: center;
    padding: 0!important;
  }

  .modal:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px; /* Adjusts for spacing */
  }

  .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
  }
  .modal-header {
     border-bottom: unset !important; 
  }
  .modal-footer {
      border-top: unset !important;
  }
  .modal-content
  {
    background-color: #fff;
    border-radius: 0px !important;
    border: unset !important;
  }
</style>
@section('preloader')
<div class="preloader" style="visibility: hidden;">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span><img src="{{asset('images/others/bdlogo.png')}}"></span>
            <span><img src="{{asset('images/others/bdlogo.png')}}"></span>
        </div>
    </div>
</div>
@endsection
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
              @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session()->get('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
                <div class="col-12 table-responsive">
                  <table class="table table-bordereds">
                    <thead>
                      <tr>
                        <th class="address-header">Name</th>
                        <th class="address-header">Contact #</th>
                        <th class="address-header">Province/City/Barangay</th>
                        <th class="address-header"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($address as $x)
                      <tr>
                        <td class="p5">{{ $x->fullname }} <small><p><i id="smalladdress">(Billing Address)</i></p></small></td>
                        <td class="p5">{{ $x->telephone }}</td>
                        <td class="p5">{{ ucfirst(strtolower($x->province_name))}}<br>{{ ucfirst($x->city_name)}}<br>{{ucfirst($x->barangay_name) }}</td>
                        <td class="p5">
                          <a href="{{ route('address.edit', $x->slug) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a href="#" title="Remove" data-toggle="modal" data-target="#remove" title="Delete Item" data-cartid="{{$x->slug}}" data-fname="{{ $x->fullname }}" data-house="{{ $x->house_info }}" data-province="{{ $x->province_name }}" data-city="{{ $x->city_name }}" data-barangay="{{ $x->barangay_name }}"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
                        <div class="modal-dialog modal-sm centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h6 class="modal-title">Delete Address</h6>
                            </div>
                             <form action="{{route('address.destroy',$x->slug)}}" method="post">
                              {{method_field('delete')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                              <p>Are you sure you want to delete this address?</p>
                              <label id="fname"></label>
                              <p id="house"></p>
                              <p id="province"></p>
                              <p id="city"></p>
                              <p id="barangay"></p>
                              <input type="hidden" name="cart_id" id="cart_id" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="removeCart" class="btn btn-danger">DELETE</button>
                            </div>
                              </form>
                          </div>
                        </div>
                      </div>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                    <a href="/address/create" class="button button-dark btn-sm pull-right"><i class="fa fa-plus"></i>  NEW ADDRESS</a>
              </div>
            </div>
        </div>
    </div>
	</div><!--end container-->

</main>

@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('li').not(".active, .dropdown-header").addClass('preload');
        $(".preload").on('click', function() {
            $(".preloader").removeAttr("style");
            $('.preloader').fadeIn('slow');
        })
        $('#remove').on('show.bs.modal', function (event) {
          function cap(str) {
              return str.replace(/([a-z])/, function (match, value) {
                  return value.toUpperCase();
              })
          }
          var button = $(event.relatedTarget);
          var cart_id = button.data('cartid');
          var fname = button.data('fname');
          var house = button.data('house');
          var province = button.data('province');
          var city = button.data('city');
          var barangay = button.data('barangay');
          var modal = $(this)
          modal.find('.modal-body #cart_id').val(cart_id);
          modal.find('.modal-body #fname').text(fname);
          modal.find('.modal-body #house').text(house);
          modal.find('.modal-body #province').text(province);
          $('#province').css('textTransform', 'capitalize');
          modal.find('.modal-body #city').text(city);
          modal.find('.modal-body #barangay').text(barangay);
      })
    });
</script>
@endsection