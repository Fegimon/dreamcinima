@extends('admin.default')
@section('content')

<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
               <h3 class="box-title">Media Details List</h3>
              <center>
                @if(@$_GET['sterm']!='')
                @if($_GET['sterm']=='audio')
                <h4><b>You Are Selected  Audio List</b></h4>
                @endif
                @if($_GET['sterm']=='video')
                <h4><b>You Are Selected  Video List</b></h4>
                @endif
                @if($_GET['sterm']=='trailler')
                <h4><b>You Are Selected  Trailler List</b></h4>
                @endif
                @if($_GET['sterm']=='latest')
                <h4><b>You Are Selected  Latest List</b></h4>
                @endif
                @endif
               <div class="msg" style="display:none">
               <h4>Successfully Added Order</h4>
               </div>
               <div class="status" style="display:none">
               <h4>Successfully Change Status</h4>
               </div>
               </center>
               <div class="box-tools pull-right">
               <label>Category</label>
               <select id="media_type" name="media_type">
                    <option selected="selected">Select </option>
                    <option value="">ALL</option>
                    <option value="audio">Audio</option>
                    <option value="video">Video</option>
                    <option value="trailler">Trailler</option>
                    <option value="latest">Latest</option>
               </select>
                  <a href="{{url('admin/addmedia')}}"><button type="button" class="btn btn-info btn-md" ><b>ADD</b><i class="fa fa-user-plus"></i></button></a>
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
                           <th>Title</th>
                           <th>Description</th>
                           <th>Url</th>
                           <th>Thumb Image</th>
                           <th>Media Type</th>
                           <th>Order</th>
                           <th>Active</th>
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
                           <td><img src="{{$val->media_thumb}}" width="40px"></td>
                           <td>{{ $val->media_type}}</td>
                          
                           <td><input type="text" id="showin_order" name="showin_order" value="{{$val->showby_order}}" placeholder="Order No" data-id="{{$val->id}}" style="width:50px"></td>
                           <td><input type="checkbox" id="status" name="status"  data-id="{{$val->id}}"    <?php echo ($val->status==1 ? 'checked' : '');?>></td>
                           <td><a href="{{ url('admin/viewmedia/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>View</span></a></td>
                           <td><a href="{{ url('admin/editmedia/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> <span>Edit</span></a></td>
                           <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i> <span>Delete</span> </button></td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                </div>
               </div>

               <div class="filter">
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
     $('.onload').show();
     $('.filter').hide();
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
<script>
   $('#media_type').on('change', function()
   {
     select = $('#media_type option:selected').val(); 
     var url = "{{ url('admin/medialist') }}"+"/?sterm="+select;
     window.location.href = url;
   });
</script>
<script>
$(document).ready(function(){
  $("input[type=text]").change(function()
   {
       var value = $(this).val();
       var id = $(this).attr('data-id');
       var url = "{{ url('admin/addorder') }}"+"/"+value+"/"+id;
       //alert(url);
       $.ajax({
           type :'get',
           dataType:'json',
           data : value,
           url :url,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success : function(response)
           {
               //location.reload();
               //alert('Added');
               $('.msg').show();
           
           }
       });
   });

});
</script>

<script>
$(document).ready(function(){
  $("input[type=checkbox]").click(function()
   {
     
     
      var value= $(this).is(':checked') ? 1 : 0;
     // alert(value);
      var id = $(this).attr('data-id');
      var url = "{{ url('admin/updatestatus') }}"+"/"+value+"/"+id;
      
       $.ajax({
           type :'get',
           dataType:'json',
           data : value,
           url :url,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success : function(response)
           {
               //location.reload();
               //alert('Added');
               $('.status').show();
           
           }
       });
   });

});
</script>
@stop