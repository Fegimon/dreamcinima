@extends('admin.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add Gift</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('admin/addgift')}}" id="mediaForm" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
                       <div class="flash-message">
                              @include('admin.pages.notification')
                        </div>

                        <div id="validation-errors" class="alert alert-error" style="display: none;color:blue;">
						</div>
               <div class="form-group">
                  <label>User Id</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="user_id" name="user_id" data-mask placeholder="User Id" required>

                     </div>
               </div>
               <!-- /.form group -->
               <!-- Date mm/dd/yyyy -->
               <div class="form-group">
               <label>Email</label>

                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="text" class="form-control" id="email" name="email" placeholder="Email" data-mask required>

                     </div>
               </div>
               <div class="form-group">
                  <label>Transaction Id</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Transaction Id" data-mask required>
                  </div>
               </div>
               
               <div class="form-group">
                  <label>Address:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" class="form-control" id="address" name="address" placeholder="Address" data-mask required>

                  </div>
               </div>
               <div class="form-group">
                  <label>User Preference:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" class="form-control" id="user_preference" name="user_preference" data-mask placeholder=" User Preference" required>

                  </div>
               </div>
               <div class="form-group">
                  <label>Subscription:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" class="form-control" id="subscription" name="subscription" data-mask placeholder=" Subscription" required>

                  </div>
               </div>
               <div class="form-group">
                  <label>Delivery Status:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" class="form-control" id="delivery_status" name="delivery_status" data-mask placeholder=" Delivery Status" required>

                  </div>
               </div>
               <div class="form-group">
                  <label>Delivery Comments:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" class="form-control" id="delivery_comments" name="delivery_comments" data-mask placeholder=" Delivery Comments" required>

                  </div>
               </div>
               <div class="form-group">
                  <label>Shipping Info:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" class="form-control" id="shipping_info" name="shipping_info" data-mask placeholder=" Shipping Info" required>

                  </div>
               </div>
               <!-- <div class="form-group">
                  <label>Show in Home:</label>
                 
                     <input type="checkbox" name="showin_home"   value="1"> <br>
               </div> -->
           
            </div>
          
            <button type="submit"  class="btn btn-block btn-primary">Submit</button>

         </div>
         <!-- /.box-body -->
      </div>
    </form>
      <!-- /.box -->
   </div>
  
</section>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<!-- <script>

$(document).on('click', '#btnSubmit', function () {
    alert('click');
       //var data  = $('#addstudent').serializeArray();
       var data = new FormData($('#payForm')[0]);
       var url = "{{url('backend/addpaymentdetails')}}";
     $.ajax({
           type:'POST',
           url:url,
           data:data,
           dataType: "json",
           processData: false,
           contentType: false,
           async:true,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           beforeSend: function () {
                $("#validation-errors").hide().empty();
            },
           success:function(response){
               // console.log(response);
               if(response.status='1')
               
               {
                   console.log(response);
                   window.location.href = "{{ url('backend/paymentdetaillist') }}";
                 
               }if(response.status='0')
               {
                $("#validation-errors").show();
               }
        }
     });
   });

</script> -->
@stop