@extends('admin.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add Video Details</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('admin/addvideo')}}" id="payForm" method="post" onsubmit="return ValidationEvent()" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="flash-message">
                              @include('admin.pages.notification')
                        </div>

                        <div id="validation-errors" class="alert alert-error" style="display: none;color:blue;">
						</div>
               <div class="form-group">
                  <label> Title</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="title" name="title" data-mask placeholder="Title" required>

                     </div>
               </div>
               <div class="form-group">
               <label>Category</label>

                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <select class="form-control select2 accordion--form__text required" id="category" name="category" required>
                        <option value="parent" selected="selected">Select </option>
                        @foreach ($category as $val)
                        <option value="{{$val->category_name}}">{{$val->category_name}}</option>
                        @endforeach
                     </select>
                     </div>
               </div>
               <div class="form-group">
               <label>Description</label>

                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="text" class="form-control" id="video_description" name="video_description" placeholder="Description" data-mask required>

                     </div>
               </div>
               <div class="form-group">
                  <label> Thumb Image</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="file" class="form-control" id="thumb_image" name="thumb_image" data-mask placeholder="Name" required>

                     </div>
               </div>
               <div class="form-group">
                  <label>Cast Name</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" class="form-control" id="cast_name" name="cast_name" placeholder="Cast Name" data-mask required>
                  </div>
               </div>
               <div class="form-group">
                  <label>Director Name:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="director_name" name="director_name" data-mask placeholder=" Director Name" required>

                     </div>
               </div>
               <div class="form-group">
                  <label>Music Director:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" class="form-control" id="musicdirector" name="musicdirector" data-mask placeholder="Music Director" required>

                  </div>
               </div>
               <div class="form-group">
                  <label>Producer Name:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="text" class="form-control" id="producer" name="producer" data-mask placeholder=" Producer Name" required>

                  </div>
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