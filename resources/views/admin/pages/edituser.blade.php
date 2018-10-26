@extends('admin.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add User</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('admin/edituser')}}" id="payForm" method="post" onsubmit="return ValidationEvent()">
               {{ csrf_field() }}
               <div class="flash-message">
                              @include('admin.pages.notification')
                        </div>

                        <div id="validation-errors" class="alert alert-error" style="display: none;color:blue;">
						</div>
                        <input type="hidden" name="id" class="form-control"  value="{{$userrs->id}}" />

               <div class="form-group">
                  <label> Name</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="name" value="{{$userrs->name}}" name="name" data-mask placeholder="Name" required>

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
                     <input type="text" class="form-control" id="email" name="email" value="{{$userrs->email}}" placeholder="Email" data-mask required>

                     </div>
                     <!-- <br>
                     <div class="form-group" id="othercat" style="display: none;">
                            <input type="text" class="form-control" name="othercat" data-mask placeholder="Other User Category">
                           <br> <input type="text" class="form-control" name="newuser" data-mask placeholder="New User Name">

                    </div> -->
                  
                  <!-- /.input group -->
               </div>
               <!-- /.form group -->
               <!-- phone mask -->
               <div class="form-group">
                  <label>Phone</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" class="form-control" id="phone" name="phone" value="{{$userrs->phone}}" placeholder="Phone" data-mask required>
                  </div>
                  <!-- /.input group -->
               </div>
               <!-- /.form group -->
               <!-- phone mask -->
               <div class="form-group">
                  <label>DOB:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="date" class="form-control" id="dob" name="dob" value="{{$userrs->dob}}" data-mask placeholder=" Date" required>

                     </div>
                  <!-- /.input group -->
               </div>
               <!-- /.form group -->
               <!-- IP mask -->
               <div class="form-group">
                  <label>Gender:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <select class="form-control select2 accordion--form__text required" value="{{$userrs->gender}}" id="gender" name="gender" required>
                        <option selected="selected">Select </option>
                        <option value="<?php echo $userrs->gender;?>" <?php echo ($userrs->gender) ? ' selected="selected"' : '';?>><?php echo $userrs->gender;?></option>

                        <option value="male">Male</option>
                        <option value="female">Female</option>
                     </select>
                  </div>
                  <!-- /.input group -->
               </div>
               <!-- /.form group -->
               <div class="form-group">
                  <label>Address:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" class="form-control" id="address" name="address"value="{{$userrs->address}}"  data-mask placeholder=" Address" required>

                  </div>
                  <!-- /.input group -->
               </div>
               <div class="form-group">
                  <label>Subscription:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="date" class="form-control" id="subscription"value="{{$userrs->subscription}}"  name="subscription" required>
                  </div>
                  <!-- /.input group -->
               </div>
            
           
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