@extends('admin.default')
@section('content')
<section class="content">

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Gift  Details
            <!-- <small class="pull-right">Date: 2/10/2014</small> -->
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        <strong> User Name</strong><br><br>
        <strong>Email</strong><br><br>
        <strong> Transaction Id</strong><br><br>
        <strong> Address</strong><br><br>
        <strong> User Preference</strong><br><br>
        <strong> Subscription</strong><br><br>
        <strong> Delivery Status</strong><br><br>
        <strong> Delivery Comments</strong><br><br>
        <strong> Shipping Info</strong><br><br>
        
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        {{$giftrs->name}}  <br><br>
        {{$giftrs->email}}   <br><br>
        {{$giftrs->transaction_id}}   <br><br>
        {{$giftrs->address}}<br><br>
        {{$giftrs->user_preference}}<br><br>
        {{$giftrs->subcription}}<br><br>
        {{$giftrs->delivery_status}}<br><br>
        {{$giftrs->delivery_comments}}<br><br>
        {{$giftrs->shipping_info}}<br><br>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            

        </div>
        
      </div>
      <!-- /.row -->

      
<br>
     
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{url('admin/giftlist')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
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