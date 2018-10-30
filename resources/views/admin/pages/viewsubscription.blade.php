@extends('admin.default')
@section('content')
<section class="content">

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Subscription Details
            <!-- <small class="pull-right">Date: 2/10/2014</small> -->
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        <strong> Name</strong><br><br>
        <strong>Email</strong><br><br>
        <strong>Subscription Date</strong><br><br>
        <strong>Amount</strong><br><br>
        <!-- <strong> Payment Status</strong><br><br> -->
        <!-- <strong> Subscriptio</strong><br><br> -->
        
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        {{$paymentrs->name}}  <br><br>
        {{$paymentrs->email}}   <br><br>
        {{$paymentrs->subscribe_date}}   <br><br>
        {{$paymentrs->payment_amount}}   <br><br>
       
       
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      

     
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{url('admin/subscriptionlist')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
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