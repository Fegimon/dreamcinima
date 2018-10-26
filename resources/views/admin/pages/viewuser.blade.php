@extends('admin.default')
@section('content')
<section class="content">

 <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> User Details
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
        <strong> Phone</strong><br><br>
        <strong> Gender</strong><br><br>
        <strong> Address</strong><br><br>
        <strong> Subscriptio</strong><br><br>
        
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        {{$userrs->name}}  <br><br>
        {{$userrs->email}}   <br><br>
        {{$userrs->phone}}   <br><br>
        {{$userrs->gender}}   <br><br>
        {{$userrs->address}}   <br><br>
        {{$userrs->subscription}}   <br><br>
       
       
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
          <a href="{{url('admin/userlist')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
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