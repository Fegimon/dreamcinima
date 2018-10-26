@extends('admin.default')
@section('content')
<style>
.modal-dialog {width:600px;}
.thumbnail {margin-bottom:6px;}
</style>
<section class="content">
   <div class="row">
      <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                     <h3 class="box-title">Add Images</h3>
                </div>
                <div class="box-body">
                        <div class="container">
            <div class="row">
            @if ($gallery != "")
                @foreach(explode(',', $gallery) as $info) 
           
                <div class="col-lg-3 col-sm-3 col-xs-6">
                 <a title="Image 1" href="#">
                    <img class="thumbnail img-responsive" src="{{ asset('public/upload/gallery/'.$info) }}" width="150px">
                 </a>
               </div>
                @endforeach
                @endif
            
            
           
        
            <hr>
            
            <hr>
        </div>
        </div>
        <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title">Heading</h3>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
        </div>

                </div>  
            </div>
        </div>  
   </div>
</section>

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
@stop