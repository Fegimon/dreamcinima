@extends('admin.default')
@section('content')
<style>
   .file_drag_div{
   width: 280px;
   height: 273px;
   border: 2px dashed #ccc;
   line-height: 250px;
   text-align: center;
   font-size: 30px;
   }
   .file_drag_div_over{
   color: #000;
   border-color: #000;
   }
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
               <h3 class="box-title">Add Images</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="#" id="gallery" enctype="multipart/form-data" method="post" onsubmit="return ValidationEvent()">
                  {{ csrf_field() }}

                  <div class="flash-message">
                     @include('admin.pages.notification')
                  </div>
                  <div id="validation-errors" class="alert alert-error" style="display: none;color:blue;">
                  </div>
                  
                  <div class="file_drag_div" id="drag">
                     Drop your files here
                     <input type="text" class="form-control"  name="parent_id" value="{{ Request::segment(3) }}">

                  </div>
                 
                  <center>
                        <div  id="loadingmessage" style="display:none;height:300px">
                                Please wait... 
                                    <img src="{{asset('public/images/loading.gif')}}" />
                    
                         </div> 
                    </center>
            </div>
            <div class="row">
            <div class="col-md-12" id="result_images"></div>
            </div>
            <button type="button"  id="btnSubmit" class="btn btn-block btn-primary">Submit</button>
         </div>
         <!-- /.box-body -->
      </div>
      </form>
      <!-- /.box -->
   </div>
</section>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script>
   $(document).ready(function() {
            $('.file_drag_div').on('dragover',function(){
                //alert('asda');
            $(this).addClass('file_drag_div_over');
            return false;
   });
        $('.file_drag_div').on('dragleave',function(){
                $(this).removeClass('file_drag_div_over');
                return false;
        });
   $('.file_drag_div').on('drop',function(e){
        e.preventDefault();
        $(this).removeClass('file_drag_div_over');
        var id="{{ Request::segment(3)  }}";
        var formdata = new FormData();
        var url = "{{url('admin/uploadgallery')}}"+"/"+id;
        //alert(url);
        var multiple_files = e.originalEvent.dataTransfer.files;
                for(var i=0;i<multiple_files.length; i++)
                {
                formdata.append('file[]',multiple_files[i]);
                }
                $('#drag').hide(); 
                $('#loadingmessage').show(); 
                $.ajax({
                    type:'POST',
                    url:url,
                    data:formdata,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    async:true,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend: function() {
                        $('#response').html("<img src='.public_path().'/upload/' />'");
                    },
                    success:function(res){
                        if(res.status='1')
                        {
                            $('#loadingmessage').hide();
                            var id="{{ Request::segment(3)  }}";
                            //alert("Successfully Added");
                            window.location.href = "{{ url('admin/gallerylist') }}"+"/"+id;
                        }
                }
                });
      });
    });
</script>
@stop