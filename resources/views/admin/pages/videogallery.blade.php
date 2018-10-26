@extends('admin.default')
@section('content')
<style>
   iframe[src*=vimeo] {
   width: 100%;
   max-height: 300px;
   height: 100%;
   }
</style>
<section class="content">
   <div class="row">
      <div class="col-xs-12">
      <form action="#" method="post" id="galleryForm"> 
         <div class="box">
            <div class="box-header">
               <h3 class="box-title">Video Details List</h3>
               <div class="box-tools pull-right">
                  <a href="{{url('admin/addvideo')}}"><button type="button" class="btn btn-info btn-md" ><b>ADD</b><i class="fa fa-user-plus"></i></button></a>
                  <a href="#"><button type="button" id="delete" class="btn btn-info btn-md" ><i class="fa fa-trash"></i></button></a>
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <section id="gallery">
                  <div class="container-fluid">
                     <div class="row">
                        @foreach($video as $val) 
                        <div class="col-md-3 col-sm-3 col-xs-12 gallery">
                           <div class="embed-responsive embed-responsive-16by9">
                              <iframe class="embed-responsive-item" src="{{$val->video_url }}" allowfullscreen></iframe>
                           </div>
                           <input type="checkbox" name="dltvideo"   value="{{$val->id}}"> <br>
                        </div>
                        @endforeach
                        @foreach($video as $val) 
                        <div class="col-md-3 col-sm-3 col-xs-12 gallery">
                           <div class="embed-responsive embed-responsive-16by9">
                           <video width="400" controls>
                                <source src="{{ asset('public/upload/videos/'.$val->video) }}" type="video/mp4">
                              </video>
                           </div>
                           <input type="checkbox" name="dltvideo"   value="{{$val->id}}"> <br>

                        </div>
                        @endforeach
                        <div class="col-md-3 col-sm-3 col-xs-12 gallery">
                           <div class="embed-responsive embed-responsive-16by9">
                            <video width="400" controls>
                                <source src="mov_bbb.mp4" type="video/mp4">
                                <source src="mov_bbb.ogg" type="video/ogg">
                                Your browser does not support HTML5 video.
                              </video>
                           </div>
                           <input type="checkbox" name="dltvideo"   value="{{$val->id}}"> <br>

                        </div>
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12 gallery">
                           <div class="embed-responsive embed-responsive-16by9">
                             <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/152162621" allowfullscreen></iframe>
                           </div>
                           </div>
                           <div class="col-md-6 col-sm-6 col-xs-12 gallery">
                           <div class="embed-responsive embed-responsive-16by9">
                             <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/150922044" allowfullscreen></iframe>
                           </div>
                           </div>
                           <div class="col-md-6 col-sm-6 col-xs-12 gallery">
                           <div class="embed-responsive embed-responsive-16by9">
                             <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/209398590" allowfullscreen></iframe>
                           </div>
                           </div> -->
                     </div>
                  </div>
               </section>
            </div>
            <!-- /.box-body -->
            </form>
         </div>
         <!-- /.box -->
      </div>
   </div>
</section>
<script>
   $(function () {
     $('#example1').DataTable()
     $('#example2').DataTable({
       'paging'      : true,
       'lengthChange': false,
       'searching'   : false,
       'ordering'    : true,
       'info'        : true,
       'autoWidth'   : false
     })
   })
</script>
<script type="text/javascript">
   $(document).ready(function() {
     $('#admission').DataTable();
   } );
</script>
<script>
 $(document).on('click','#delete',function(){
   //alert('alert');
   var data  = $('#galleryForm').serializeArray();
   var url = "{{url('admin/deletevideolist')}}";
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json', // added data type
        data:JSON.stringify(data),
        contentType: "application/json",

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) 
        {
            if(response.status='1')
                  
                  {
                      console.log(response);
                      var id="{{ Request::segment(3)  }}";
                     
                      alert("Successfully Deleted");
                      window.location.href = "{{ url('admin/videogallery') }}"+"/"+id;
                  }
           
        }
    });
  });
</script>
@stop