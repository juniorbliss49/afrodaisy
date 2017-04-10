@extends('layouts.main')
@section('content')
<div  style="width:100%">
	<div class="row">
<style type="text/css">
	table {
    border-collapse: collapse;
}
.payHT{
    height: 500px;
}
.line{
    line-height: 150%;
}
.col1{
    background: orange;
    color: #fff;
}
.col2{
    background: #17B6EB;
    color: #fff;
}
.col3{
    background: #EB4C17;
    color: #fff;
}
.col4{
    background: #ddd;
    line-height: 150%;

}
</style>

<div class="container text-center">
    <div class="row">
        <div class="col-lg-3 payHT">
            
        </div>
        <div class="col-lg-3 payHT col1">
               <h2>Free</h2>
               <br>
               <hr>
               <h4 class="line">Sign up for free and have an experience on what it takes to be a model. </h4><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title=" It really doesn’t take much to be required in the modeling industry. Yes!  The modeling industries are looking for you and what you can offer. Apply for jobs and receive your reward for your services"></span>
            

        </div>
        <div class="col-lg-3 payHT col2">
                <h2>Afro Plus</h2>
               <br>
               <hr>
                <h4 class="line">Increase your chances to be seen by agencies and industry professionals around the whole of Africa and the world.</h4><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title=" Have your chances to contact and receive updates on jobs and casts in your area. Be an Afro Plus member to apply more cast categories and receive more reward for your services."></span>


            
        </div>
        <div class="col-lg-3 payHT col3">
                <h2>Afro Unlimited</h2>
               <br>
               <hr>
                <h4 class="line">for models who knows what it takes to be successful and create a lasting impression in the modeling industry.</h4><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title=" get access to our unlimited offers and opportunities as your listing is prioritized. Be part of all aspects of castings and listings as you are allowed to select unlimited categories of the modeling industry"></span>
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col4" style="padding-top: 15px">
            <h4>Category selection</h4>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <br>
            <p> times a month</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
        <br>
            <p>8 times a month</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
        <br>
            <p>Unlimited</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col4">
            <h4>Cast/Job application</h4>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Twice a month</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>4 times a month</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Unlimited</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col4">
            <h4>Featured on our IG and FB page</h4>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Not applicable</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Once a month without displaying details</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>3 times a month with Social network details</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col4" style="padding-bottom: 31px;">
            <h4>Recognition</h4>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Not offered</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Get seen by Agencies, photographers and industry professionals</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Get seen by Agencies, photographers and industry progessionals</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col4">
            <h4>Listing</h4>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Basic Listing</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Basic Listing</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Prioritized Listing</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col4">
            <h4>Contact Agencies and Photographers</h4>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Not applicable</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Not applicable</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Unlimited</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col4">
            <h4>Receive email alerts on castings in your area</h4>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Not applicable</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Not applicable</p>
        </div>
        <div class="col-lg-3" style="border-right: 1px solid #ddd">
            <p>Unlimited</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-3">
            <a href="/user/plan/1" class="btn btn-lg btn-block" id="dash"><span class="glyphicon glyphicon-download"></span> GET IT</a>
        </div>
        <div class="col-lg-3">
            <a href="/user/plan/2" class="btn btn-lg btn-block" id="dash"><span class="glyphicon glyphicon-download"></span> GET IT</a>
        </div>
        <div class="col-lg-3">
            <a href="/user/plan/3" class="btn btn-lg btn-block" id="dash"><span class="glyphicon glyphicon-download"></span> GET IT</a>
        </div>
    </div>

<br>

@stop
@section('script')
{{ HTML::script('js/message.js') }}
@stop