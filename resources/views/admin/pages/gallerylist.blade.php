@extends('admin.default')
@section('content')
<style>
   .modal-dialog {width:600px;}
   .thumbnail {margin-bottom:6px;}
</style>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <form action="#" method="post" id="galleryForm">
            {{ csrf_field() }}
            <div class="box box-danger">
               <div class="box-header">
                  <h3 class="box-title">Gallery Images</h3>
                  <div class="box-tools pull-right">
                     <a href="#"><button type="button" id="delete" class="btn btn-info btn-md" ><i class="fa fa-trash"></i></button></a>
                  </div>
               </div>
               <div class="box-body">
                  <div class="container">
                     <div class="row">
                        @if ($gallery != "")
                        @foreach($gallery as $val) 
                        <div class="col-lg-3 col-sm-3 col-xs-6">
                           <a title="Image 1" href="#">
                           <img class="thumbnail img-responsive" src="{{ asset('public/upload/gallery/'.$val->gallery) }}" width="150px">
                           </a>
                           <input type="checkbox" name="dltimg"   value="{{$val->id}}"> <br>
                        </div>
                        @endforeach
                        @endif
                     </div>
                  </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
        <h4> Are You Sure Confirm to Delete?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="yes">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
   $('.thumbnail').click(function(){
         $('.modal-body').empty();
     	var title = $(this).parent('a').attr("title");
     	$('.modal-title').html(title);
     	$($(this).parents('div').html()).appendTo('.modal-body');
     	$('#myModal').modal({show:true});
   });
   });
</script>
<script>
   $(document).on('click','#delete',function(){
      $('#myModal').modal({show:true});
   });
   $(document).on('click','#yes',function(){
     var data  = $('#galleryForm').serializeArray();
      var id="{{ Request::segment(3)  }}";
      console.log(data);
     var url = "{{url('admin/deleteimages')}}"+"/"+id;
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
                        window.location.href = "{{ url('admin/gallerylist') }}"+"/"+id;
                    }
             
          }
      });
    });
</script>
@stop