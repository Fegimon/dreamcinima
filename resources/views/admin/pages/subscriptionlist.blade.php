@extends('admin.default')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
               <h3 class="box-title">Subscription List</h3>
               <form action="#" id="searchform"  method="post" name="form" class="form-inline">
               {{ csrf_field() }}
               <div class="input-group input-daterange">
                <span class="input-group-addon">Start Date</span>
                <input type="text" name="start" class="form-control" value="">
                <span class="input-group-addon">End Date</span>
                <input type="text" name="finish" class="form-control" value="">
              </div>
              <button type="button" class="btn btn-info btn-md" id="search"><i class="fa fa-search"></i><b>Search</b></button>

              </form>
               <div class="box-tools pull-right">
                  <!-- <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal" ><b>ADD</b><i class="fa fa-user-plus"></i></button> -->
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
              <div class="onload">
               <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Subscription Date</th>
                           <th>Amount</th>
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
                           <td>{{ $val->email}}</td>
                           <td>{{ $val->subscribe_date}}</td>
                           <td>{{ $val->payment_amount}}</td>
                           <td><a href="{{ url('admin/viewsubscription/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>
                           <!-- <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td> -->
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
              </div>

              <div class="search">
               <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Subscription Date</th>
                           <th>Amount</th>
                           <th>View </th>
                           <!-- <th>Delete</th> -->
                        </tr>
                     </thead>
                     <tbody id="list">
                     
                       
                     </tbody>
                  </table>
               </div>
              </div>


            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
      </div>
   </div>
</section>


<script type="text/javascript">
   $(document).ready(function() {
     $('.onload').show();
     $('.search').hide();
   });
</script>
<script>

$(document).on('click', '#search', function () {
    //alert('click');
       //var data  = $('#searchform').serializeArray();
       var data = new FormData($('#searchform')[0]);
       var url = "{{url('admin/searchsubscription')}}";
     $.ajax({
           type:'POST',
           url:url,
           data:data,
           dataType: "json",
           processData: false,
           contentType: false,
           async:true,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success:function(response){
               // console.log(response);
               if(response.status='1')
               
               {
                   console.log(response);
                   $('.onload').hide();
                   $('.search').show();
                   <?php
                      $i=1;
                      ?>

                   var len=response.data.length;
                   var s= "";
                    for(i=0; i<len; i++){
                        s+='<tr><td>'+response.data[i].id+'</td><td>'+response.data[i].name+'</td><td>'+response.data[i].email+'</td>\
                        <td>'+response.data[i].subscribe_date+'</td><td>'+response.data[i].payment_amount+'</td><td><a href="{{ url('admin/viewsubscription/'.'+response.data[i].id+') }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>'
                    }
                    document.getElementById("list").innerHTML=s;

                 
               }if(response.status='0')
               {
                $("#validation-errors").show();
               }
        }
     });
   });

</script>


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
     $('#example2').DataTable();
   } );
</script>



<script>
var userTarget = "";
var exit = false;
$('.input-daterange').datepicker({
  format: "yyyy-mm-dd",
  weekStart: 1,
  language: "en",
  daysOfWeekHighlighted: "0,6",
  //startDate: "01/01/2017",
  orientation: "bottom auto",
  autoclose: true,
  showOnFocus: true,
  maxViewMode: 'days',
  keepEmptyValues: true,
  templates: {
    leftArrow: '&lt;',
    rightArrow: '&gt;'
  }
});
$('.input-daterange').focusin(function(e) {
  userTarget = e.target.name;
});
$('.input-daterange').on('changeDate', function(e) {
  if (exit) return;
  if (e.target.name != userTarget) {
    exit = true;
    $(e.target).datepicker('clearDates');
  }
  exit = false;
});
</script>
@stop