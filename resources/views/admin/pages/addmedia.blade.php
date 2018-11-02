@extends('admin.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add Media</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('admin/addmedia')}}" id="mediaForm" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
                       <div class="flash-message">
                              @include('admin.pages.notification')
                        </div>

                        <div id="validation-errors" class="alert alert-error" style="display: none;color:blue;">
						</div>
               <div class="form-group">
                  <label> Media Title</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="media_title" name="media_title" data-mask placeholder="Media Title" required>

                     </div>
               </div>
               <!-- /.form group -->
               <!-- Date mm/dd/yyyy -->
               <div class="form-group">
               <label>Media Description</label>

                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input type="text" class="form-control" id="media_desc" name="media_desc" placeholder="Media Description" data-mask required>

                     </div>
               </div>
               <div class="form-group">
                  <label>Media Url</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" class="form-control" id="media_url" name="media_url" placeholder="Media Url" data-mask required>
                  </div>
               </div>
               
               <div class="form-group">
                  <label>Media Type:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <select class="form-control select2 accordion--form__text required" id="media_type" name="media_type" required>
                        <option selected="selected">Select </option>
                        <option value="audio">Audio</option>
                        <option value="video">Video</option>
                        <option value="trailler">Trailler</option>
                        <option value="latest">Latest</option>

                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label>Movie Name:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <select class="form-control select2 accordion--form__text required" id="movie_id" name="movie_id" required>
                        <option selected="selected">Select </option>
                        @foreach ($movies as $val)
                        <option value="{{$val->id}}">{{$val->title}}</option>
                        @endforeach

                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label>Media Thumb:</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                     </div>
                     <input type="file" class="form-control" id="media_thumb" name="media_thumb" data-mask placeholder=" Address" required>

                  </div>
               </div>
               <div class="form-group">
                  <label>Show in Home:</label>
                 
                     <input type="checkbox" name="showin_home"   value="1"> <br>
               </div>
           
            </div>
            
            <div class="form-group">
                  <label>Status:</label>
                 
                     <input type="checkbox" name="status"  value="1"  > <br>
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