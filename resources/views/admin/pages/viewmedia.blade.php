@extends('admin.default')
@section('content')
<section class="content">

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Media Details
            <!-- <small class="pull-right">Date: 2/10/2014</small> -->
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        <strong> Title</strong><br><br>
        <strong>Description</strong><br><br>
        <strong> Media Type</strong><br><br>
        <!-- <strong> Gender</strong><br><br>
        <strong> Address</strong><br><br>
        <strong> Subscriptio</strong><br><br> -->
        
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        {{$mediars->media_title}}  <br><br>
        {{$mediars->media_desc}}   <br><br>
        {{$mediars->media_type}}   <br><br>
       
       
       
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <h5>Thumb Image</h5>
            <img src="{{$mediars->media_thumb}}" width="90px">

        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 gallery">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="{{$mediars->media_url}}" allowfullscreen></iframe>
            </div>
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      
<br>
     
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{url('admin/medialist')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
          <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </section>
<section>
@stop