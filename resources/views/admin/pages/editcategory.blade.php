@extends('admin.default')
@section('content')
<section class="content">
   <div class="row">
      <div class="col-md-6">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Add Category</h3>
            </div>
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <form action="{{url('admin/addcategory')}}" id="payForm" method="post" onsubmit="return ValidationEvent()">
               {{ csrf_field() }}
               <div class="flash-message">
                              @include('admin.pages.notification')
                        </div>
                        <input type="hidden" name="id" class="form-control"  value="{{$category->id}}" />

                        <div id="validation-errors" class="alert alert-error" style="display: none;color:blue;">
						</div>
               <div class="form-group">
                  <label> Category Name</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                     </div>
                     <input type="text" class="form-control" id="category_name" value="{{$category->category_name}}" name="category_name" data-mask placeholder="Category Name" required>

                     </div>
               </div>
               <!-- /.form group -->
               <!-- Date mm/dd/yyyy -->
               <div class="form-group">
               <label>Parent Category</label>

                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <select class="form-control select2 accordion--form__text required" id="sub_category"  value="{{$category->sub_category}}" name="sub_category" required>
                     <option value="<?php echo $category->sub_category;?>" <?php echo ($category->sub_category) ? ' selected="selected"' : '';?>><?php echo $category->sub_category;?></option>
                        @foreach ($category_val as $val)
                        <option value="{{$val->category_name}}">{{$val->category_name}}</option>
                        @endforeach
                     </select>
                     </div>
                     <!-- <br>
                     <div class="form-group" id="othercat" style="display: none;">
                            <input type="text" class="form-control" name="othercat" data-mask placeholder="Other User Category">
                           <br> <input type="text" class="form-control" name="newuser" data-mask placeholder="New User Name">

                    </div> -->
                  
                  <!-- /.input group -->
               </div>
               <!-- /.form group -->
               <!-- phone mask -->
               <div class="form-group">
                  <label>Description</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="text" class="form-control" id="description" name="description" value="{{$category->description}}" placeholder="Description" data-mask required>
                  </div>
                  <!-- /.input group -->
               </div>
               <div class="form-group">
               
                  <label>Category Image</label><br>
                  <img src="{{ asset('public/upload/category/'.$category->category_image) }}" width="90px">

                  <div class="input-group">
                     <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                     </div>
                     <input type="file" class="form-control" id="category_image" name="category_image" placeholder="Description" data-mask >
                  </div>

               </div>
               <div class="form-group">
                  <label>Active:</label>
                  <!-- <div class="input-group">
                     <div class="input-group-addon"> -->
                        <!-- <i class="fa fa-user"></i> -->
                     <!-- </div> -->
                     <!-- <input type="checkbox" class="form-control" id="status" name="status" data-mask placeholder=" Date" required> -->
                     <input type="checkbox" name="status"   value="1"> <br>
                     <!-- </div> -->
               </div>
              
               
               
           
            </div>
          
            <button type="submit"  class="btn btn-block btn-primary">Submit</button>

         </div>
         <!-- /.box-body -->
      </div>
    </form>
      <!-- /.box -->
   </div>
  
</section>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<!-- <script>

$(document).on('click', '#btnSubmit', function () {
    alert('click');
       //var data  = $('#addstudent').serializeArray();
       var data = new FormData($('#payForm')[0]);
       var url = "{{url('backend/addpaymentdetails')}}";
     $.ajax({
           type:'POST',
           url:url,
           data:data,
           dataType: "json",
           processData: false,
           contentType: false,
           async:true,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           beforeSend: function () {
                $("#validation-errors").hide().empty();
            },
           success:function(response){
               // console.log(response);
               if(response.status='1')
               
               {
                   console.log(response);
                   window.location.href = "{{ url('backend/paymentdetaillist') }}";
                 
               }if(response.status='0')
               {
                $("#validation-errors").show();
               }
        }
     });
   });

</script> -->
@stop