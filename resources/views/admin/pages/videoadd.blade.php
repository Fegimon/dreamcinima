@extends('admin.default')
@section('content')
<style>
   .loader {
   border: 16px solid #f3f3f3;
   border-radius: 50%;
   border-top: 16px solid #3498db;
   width: 120px;
   height: 120px;
   -webkit-animation: spin 2s linear infinite; /* Safari */
   animation: spin 2s linear infinite;
   }
   /* Safari */
   @-webkit-keyframes spin {
   0% { -webkit-transform: rotate(0deg); }
   100% { -webkit-transform: rotate(360deg); }
   }
   @keyframes spin {
   0% { transform: rotate(0deg); }
   100% { transform: rotate(360deg); }
   }
</style>
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add Video </h3>
            </div>
            <div class="box-body" id="drag">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('admin/addvideo')}}" id="video" method="post" enctype="multipart/form-data"  onsubmit="return ValidationEvent()">
                  {{ csrf_field() }}
                  <div class="flash-message">
                     @include('admin.pages.notification')
                  </div>
                  <input type="text" class="form-control"  name="parent_id" value="{{ Request::segment(3) }}">
                  <div class="form-group">
                     <label> Video Url</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control" id="title" name="video_url" data-mask placeholder="Title" required>
                     </div>
                  </div>
                  <center>
                     <h3>OR</h3>
                  </center>
                  <!-- /.form group -->
                  <!-- Date mm/dd/yyyy -->
                  <div class="form-group">
                     <label>Upload Video</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="file" class="form-control" id="video" name="video" placeholder="Description" data-mask required>
                     </div>
                  </div>
            </div>
            <center>
                <div  id="loadingmessage" style="display:none;height:300px">
                           Please wait... 
                            <img src="{{asset('public/images/loading.gif')}}" />
            
               </div> 
            </center>

            <button type="button" id="btnSubmit" class="btn btn-block btn-primary">Submit</button>
         </div>
         <!-- /.box-body -->
      </div>
      </form>
      <!-- /.box -->
   </div>
</section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script>
   $(document).on('click', '#btnSubmit', function () {
       // alert('click');
          //var data  = $('#addstudent').serializeArray();
          var data = new FormData($('#video')[0]);
          var url = "{{url('admin/videoadd')}}";
          $('#drag').hide(); 
           $('#loadingmessage').show(); 
        $.ajax({
              type:'POST',
              url:url,
              data:data,
              dataType: "json",
              processData: false,
              contentType: false,
              async:true,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           //    beforeSend: function () {
           //         $("#validation-errors").hide().empty();
           //     },
              success:function(response){
                  // console.log(response);
                  if(response.status='1')
                  
                  {
                      console.log(response);
                      var id="{{ Request::segment(3)  }}";
                      $('#loadingmessage').hide();
                      alert("Successfully Added");
                      window.location.href = "{{ url('admin/videogallery') }}"+"/"+id;
                     // window.location.href = "{{ url('admin/videolist') }}";
                  }if(response.status='0')
                  {
                   $("#validation-errors").show();
                  }
           }
        });
      });
   
</script>
@stop