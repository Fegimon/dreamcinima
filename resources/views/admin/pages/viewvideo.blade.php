@extends('admin.default')
@section('content')
<section class="content">

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Video Details
            <!-- <small class="pull-right">Date: 2/10/2014</small> -->
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        <strong> Title</strong><br><br>
        <strong> Category</strong><br><br>
        <strong>Description</strong><br><br>
        <strong> Cast Name</strong><br><br>
        <strong> Director Name</strong><br><br>
        <strong> Music Director</strong><br><br>
        <strong> Producer</strong><br><br>
        
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        {{$video->title}}  <br><br>
        {{$video->category}}  <br><br>
        {{$video->video_description}}   <br><br>
        {{$video->cast_name}}   <br><br>
        {{$video->director_name}}   <br><br>
        {{$video->musicdirector}}   <br><br>
        {{$video->producer}}   <br><br>
       
       
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        <img src="{{ asset('public/upload/gallery/thumbnail/'.$video->thumb_image) }}" width="90px">

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      

     
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{url('admin/videolist')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
          <a href="{{url('admin/imagegallery/'.$video->id)}}"><button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Add Image
          </button></a>
          <a href="{{url('admin/videoadd/'.$video->id)}}"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-video-camera"></i> Add Video
          </button></a>
        </div>
      </div>
    </section>
<section>
@stop