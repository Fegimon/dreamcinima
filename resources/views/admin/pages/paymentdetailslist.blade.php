@extends('admin.default')
@section('content')
<section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Payment History List</h3>
                <div class="box-tools pull-right">
                  <!-- <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal" ><b>ADD</b><i class="fa fa-user-plus"></i></button> -->
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
                           <th>Amount</th>
                           <th>Payment Method</th>
                           <th>Trasaction Id</th>
                           <th>Payment Status</th>
                           <th>View </th>
                           <!-- <th>Delete</th> -->
                </tr>
                </thead>
                <tbody>
                <?php
                           $i=0;
                    ?>
                     @foreach ($paymentrs as $val)
                    
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{ $val->name}}</td>
                           <td>{{ $val->payment_amount}}</td>
                           <td>{{ $val->payment_method}}</td>
                           <td>{{ $val->transaction_id}}</td>
                           <td>{{ $val->payment_status}}</td>
                        
                           <td><a href="{{ url('admin/viewpayment/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>
                      
                           <!-- <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td> -->
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

<!-- <script>
 $(document).on('click','.delete',function(){
   alert('alert');
    var $this = $(this);
    var id = $this.attr('data-id');
    var url = "{{ url('admin/deletpayment') }}"+"/"+id;
    //alert(url);
    window.location.href = url;
  });
</script> -->


@stop