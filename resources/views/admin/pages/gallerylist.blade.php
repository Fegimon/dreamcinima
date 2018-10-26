@extends('admin.default')
@section('content')
<style>
.modal-dialog {width:600px;}
.thumbnail {margin-bottom:6px;}
</style>
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
            </form>
        </div>
        </div>
            <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h4> Are You Sure Confirm to Delete?</h4>
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

<!-- <script>
   $(document).on('click', '#delete', function () {
       // alert('click');
          var data  = $('#galleryForm').serializeArray();
          //var data = new FormData($('#galleryForm')[0]);
          var url = "{{url('admin/deleteimages')}}";
          $.ajax({
                url: url,
                type: "POST",
                datatype: 'json',
                contentType: "application/json",
                data: JSON.stringify(data),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if(response.status='1')
                  
                  {
                      console.log(response);
                    //   var id="{{ Request::segment(3)  }}";
                     
                    //   alert("Successfully Deleted");
                    //   window.location.href = "{{ url('admin/gallerylist') }}"+"/"+id;
                  }
                }
            });
      });
   
</script> -->
<script>
 $(document).on('click','#delete',function(){
    $('#myModal').modal({show:true});
   var data  = $('#galleryForm').serializeArray();
   var url = "{{url('admin/deleteimages')}}";
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
                      window.location.href = "{{ url('admin/gallerylist') }}"+"/"+id;
                  }
           
        }
    });
  });
</script>

@stop