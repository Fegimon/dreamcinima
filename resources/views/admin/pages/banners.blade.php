@extends('admin.default')
@section('content')

<style>
img {
    vertical-align: middle;
    width: 90px;
}
</style>
<section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Movies</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal" ><b>ADD</b><i class="fa fa-user-plus"></i></button>
                </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                          <th>S.No</th>
                           <th>Title</th>
                           <th>Category</th>
                           <th>Movie Url</th>
                           <th>Image</th>
                           <!-- <th>View</th> -->
                           <th>Edit </th>
                           <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                           $i=0;
                    ?>
                  @foreach ($banners as $val)
                    
                    <tr>
                       <td>{{++$i}}</td>
                       <td>{{ $val->title}}</td>
                       <td>{{ $val->category}}</td>
                       @if($val->movie_url!='')
                       <td>{{ $val->movie_url}}</td>
                       @endif
                       @if($val->movie_url=='')
                       <td></td>
                       @endif
                       
                       <td><img src="{{ $val->image }}" width="40px"></td>
                     
                      
                       <!-- <td><a href="{{ url('admin/viewuser/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td> -->
                       <td><a href="#"  id="edit" data-id="{{$val->id}}" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" data-toggle="modal" data-target="#myModal1" > <i class="fa fa-edit"></i> <span>Edit</span></a></td>
                       <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td>
                    </tr>
                    @endforeach
                
                </tbody>
              
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
          <h4 class="modal-title">Add Movies Category</h4>
        </div>
        <div class="modal-body">
        <form action="{{url('admin/addbanners')}}" method="post" id="register" enctype="multipart/form-data">
        {{csrf_field() }}
              <div class="form-group">
                  <label> Title</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" name="title" data-mask placeholder="Movie Title" required>

                     </div>
               </div>
               <div class="form-group">
                  <label> Category</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <select class="form-control select2 accordion--form__text required"  name="category" required>
                        <option selected="selected">Select </option>
                        @foreach ($category as $val)
                        <option value="{{$val->name}}">{{$val->name}}</option>
                        @endforeach
                     </select>

                     </div>
               </div>
               <div class="form-group">
                  <label>Movie Url</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" name="movie_url" data-mask placeholder="Movie Title">

                     </div>
               </div>
               <div class="form-group">
                  <label> Image</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     
                     <input type="file" class="form-control"  name="image" data-mask placeholder="Movie Title" required>

                     </div>
               </div>
               <div class="form-group">
                  <label>Release Info</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control"  name="release_info"  placeholder="Release Info">

                     </div>
               </div>
               <div class="form-group">
                  <label>Release Status:</label>
                 
                     <input type="checkbox" name="release_status"  value="1"> <br>
               </div>
               <div class="form-group">
                  <label>Active:</label>
                 
                     <input type="checkbox" name="status"  value="1"> <br>
               </div>
       
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-primary" >Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Movies Category</h4>
        </div>
        <div class="modal-body">
        <form action="{{url('admin/addbanners')}}" method="post" id="register" enctype="multipart/form-data">
        {{csrf_field() }}
        <input type="hidden" class="form-control" name="id" id="id" >

           <div class="form-group">
                  <label> Title</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="title" name="title"  >
                    </div>
            </div>
            <div class="form-group">
                  <label> Category</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <select class="form-control " id="category" name="category" >
                        <option selected="selected">Select </option>
                        @foreach ($category as $val)
                        <option value="{{$val->name}}">{{$val->name}}</option>
                        @endforeach
                     </select>                    </div>
            </div>
            <div class="form-group">
                  <label>Movie Url</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" name="movie_url" id="movie_url" data-mask placeholder="Movie Title" >

                     </div>
               </div>
            <div class="form-group">
                  <label> Image</label>
                  <div id="image"></div> 
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                   
                     <input type="file" class="form-control"  id="image" name="image" data-mask placeholder="Banner Title" >
                    </div>
            </div>
            <div class="form-group">
                  <label>Release Info</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" name="release_info" id="release_info"  >
                      
                     </div>
               </div>
               <div class="form-group">
                  <label>Release Status:</label>
                 
                     <input type="checkbox" id="release_status" name="release_status"  value="1"> <br>
               </div>
               <div class="form-group">
                  <label>Active:</label>
                 
                     <input type="checkbox" id="status" name="status"  value="1"> <br>
               </div>
        </div>
        
               
        <div class="modal-footer">
         <button type="submit" class="btn btn-primary" >Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

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
 $(document).on('click','.delete',function(){
   //alert('alert');
    var $this = $(this);
    var id = $this.attr('data-id');
    var url = "{{ url('admin/bannerdelete') }}"+"/"+id;
    //alert(url);
    window.location.href = url;
  });
</script>

<script>
 $(document).on('click','#edit',function(){
   //alert('alert');
    var $this = $(this);
    var id = $this.attr('data-id');
    var url = "{{ url('admin/banneredit') }}"+"/"+id;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
            $('#id').val(res.data.id);
            $('#title').val(res.data.title);
            $('#category').val(res.data.category);
            $('#movie_url').val(res.data.movie_url);
            $('#image').val(res.data.image);
            $('#release_info').val(res.data.release_info);
            //$('#image').attr('src',res.data.image);
            $("#image").html("<img src='"+res.data.image+"' width:20px />")
            if(res.data.release_status==1){
              $('#release_status').prop('checked', true);
            }else{
              $('#release_status').prop('checked', false);
            }
            if(res.data.status==1){
              $('#status').prop('checked', true);
            }else{
              $('#status').prop('checked', false);
            }
            $('#mymodal1').modal('show');
        }
    });
  });
</script>
@stop