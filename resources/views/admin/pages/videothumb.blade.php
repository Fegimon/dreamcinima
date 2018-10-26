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
          
            @foreach($images as $val)
            <div class="col-lg-3 col-sm-3 col-xs-6">
                 <a title="Image 1" href="#">
                    <img class="thumbnail img-responsive" src="{{ asset('public/upload/gallery/'.$val->gallery) }}" width="150px">
                 </a>
            </div>
            @endforeach
            <!-- <div class="col-lg-3 col-sm-3 col-xs-6"><a title="Image 2" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350/2255EE"></a></div>
            <div class="col-lg-3 col-sm-3 col-xs-6"><a title="Image 3" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350/449955/FFF"></a></div>
            <div class="col-lg-3 col-sm-3 col-xs-6"><a title="Image 4" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350/992233"></a></div>
            <div class="col-lg-3 col-sm-3 col-xs-6"><a title="Image 5" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350/2255EE"></a></div>
            <div class="col-lg-3 col-sm-3 col-xs-6"><a title="Image 6" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350/449955/FFF"></a></div>
            <div class="col-lg-3 col-sm-3 col-xs-6"><a title="Image 8" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350/777"></a></div>
            <div class="col-lg-3 col-sm-3 col-xs-6"><a title="Image 9" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350/992233"></a></div> -->
            
           
        
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