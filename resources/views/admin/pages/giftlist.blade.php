@extends('admin.default')
@section('content')
<section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Gift Details List</h3>
                <div class="box-tools pull-right">
                <a href="{{url('admin/addgift')}}"><button type="button" class="btn btn-info btn-md" ><b>ADD</b><i class="fa fa-user-plus"></i></button></a>
                </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                          <th>S.No</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Trasaction Id</th>
                           <th>Address</th>
                           <th>User Preference</th>
                           <th>Subscription</th>
                           <th>Delivery Status</th>
                           <th>Delivery Comments</th>
                           <th>Shipping Info</th>
                           <th>View </th>
                           <th>Edit </th>
                           <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                           $i=0;
                    ?>
                     @foreach ($giftrs as $val)
                    
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{ $val->name}}</td>
                           <td>{{ $val->email}}</td>
                           <td>{{ $val->transaction_id}}</td>
                           <td>{{ $val->address}}</td>
                           <td>{{ $val->user_preference}}</td>
                           <td>{{ $val->subcription}}</td>
                           <td>{{ $val->delivery_status}}</td>
                           <td>{{ $val->delivery_comments}}</td>
                           <td>{{ $val->shipping_info}}</td>
                        
                           <td><a href="{{ url('admin/viewgift/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>
                           <td><a href="{{ url('admin/editgift/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>Edit</span></a></td>
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
   alert('alert');
    var $this = $(this);
    var id = $this.attr('data-id');
    var url = "{{ url('admin/deletegift') }}"+"/"+id;
    //alert(url);
    window.location.href = url;
  });
</script>


@stop