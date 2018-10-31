@extends('admin.default')
@section('content')
<section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Media Details List</h3>
              <div class="box-tools pull-right">
              <a href="{{url('admin/addmedia')}}"><button type="button" class="btn btn-info btn-md" ><b>ADD</b><i class="fa fa-user-plus"></i></button></a>
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
                           <th>Description</th>
                           <th>Url</th>
                           <th>Thumb Image</th>
                           <th>Media Type</th>
                           <th>View</th>
                           <th>Edit </th>
                           <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                           $i=0;
                    ?>
                @foreach ($mediars as $val)
                    
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{ $val->media_title}}</td>
                           <td>{{ $val->media_desc}}</td>
                           <td>{{$val->media_url}}</td>
                           <td><img src="{{ asset('public/upload/media/thumbnail/'.$val->media_thumb) }}" width="40px"></td>
                           <td>{{ $val->media_type}}</td>
                           <td><a href="{{ url('admin/viewmedia/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>
                           <td><a href="{{ url('admin/editmedia/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>Edit</span></a></td>
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
    var url = "{{ url('admin/deletemedia') }}"+"/"+id;
    //alert(url);
    window.location.href = url;
  });
</script>
@stop