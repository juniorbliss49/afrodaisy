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
            <h1><b>Select a Subscription Plan from the three(3) available options;</b></h1>
            <br>
            <br>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
                <div class="col-lg-12 payHT col1">
                    <h2><b>Free</b></h2>
                   <h3><b>Free</b></h3>
                   <hr> 
                   <h4 class="line">Sign up for free and have an experience on what it takes to be a model. </h4><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title=" It really doesn’t take much to be required in the modeling industry. Yes!  The modeling industries are looking for you and what you can offer. Apply for jobs and receive your reward for your services"></span>
                    <a href="/users/changeplan/1" class="btn btn-lg btn-block" id="dash"><span class="glyphicon glyphicon-download"></span> GET IT</a>   
                </div>
                <div class="col-lg-12" style="border: 1px solid #000; font-weight: bold;">
                    <br>
                    <p>4 Category/Discipline Selections</p>
                    <hr>
                    <p>Select or apply for 2 Casts/jobs a month</p>
                    <hr>
                    <p>Not eligible for Afrodaisy sponsored Photo-sessions</p>
                    <hr>
                    <p>Not Eligible to be featured and on social media handle (Instagram, Facebook etc)</p>
                    <hr>
                    <p>Get seen by Agencies, photographers and industry professionals</p>
                    <hr>
                    <p>Not eligible for Afrodaisy Awards, Casts and Rewards</p>
                    <hr>
                    <p>Basic Listing</p>
                    <hr>
                    <p>Not eligible to Contact Agencies and Photographers</p>
                    <hr>
                    <p>Receive email alerts or notifications castings in your area</p>
                
        <div class="col-lg-12">
            <a href="/users/changeplan/1" class="btn btn-lg btn-block" id="dash"><span class="glyphicon glyphicon-download"></span> GET IT</a>
        </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
                <div class="col-lg-12 payHT col2">
                <h2><b>Afro Plus</b></h2>
                        <h3><b>12 Months</b></h3>
                        <h4><b><s>₦3500</s></b></h4>
                   <h3><b>₦2,850</b></h3>
               <hr>
                <h4 class="line">Increase your chances to be seen by agencies and industry professionals around the whole of Africa and the world.</h4><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title=" Have your chances to contact and receive updates on jobs and casts in your area. Be an Afro Plus member to apply more cast categories and receive more reward for your services."></span>
            <button class="btn btn-lg btn-block changeplan" data-toggle='modal' data-target='#exampleModal' style="background: #54d7e3; color: #fff;" id="2"><span class="glyphicon glyphicon-download"></span> GET IT</button>  
                </div>
                <div class="col-lg-12" style="border: 1px solid #000; font-weight: bold;">
                <br>
                    <p>8 Category/Discipline Selections</p>
                    <hr>
                    <p>Select or apply for 4 Casts/jobs a month</p>
                    <hr>
                    <p>Eligible for Afrodaisy Sponsored Photo-Sessions</p>
                    <hr>
                    <p>Eligible to be featured on social media handle (Instagram, Facebook etc) without details</p>
                    <hr>
                    <p>Get seen by Agencies, photographers and industry professionals through our prioritized listing</p>
                    <hr>
                    <p>Automatic Qualification for 2 casts a year for Afrodaisy Awards, Casts and Rewards</p>
                    <hr>
                    <p>Basic Listing</p>
                    <hr>
                    <p>Eligible to Contact Agencies and Photographers</p>
                    <hr>
                    <p>Receive email alerts or notifications castings in your area</p>
                    <div class="col-lg-12">
            <button class="btn btn-lg btn-block changeplan" data-toggle='modal' data-target='#exampleModal' style="background: #54d7e3; color: #fff;" id="2"><span class="glyphicon glyphicon-download"></span> GET IT</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
                <div class="col-lg-12 payHT col3">
                  <h2><b>Afro Unlimited</b></h2>
                        <h3><b>12 Months</b></h3>
                        <h4><b><s>₦5500</s></b></h4>
                   <h3><b>₦3,500</b></h3>
               <hr>
                <h4 class="line">for models who knows what it takes to be successful and create a lasting impression in the modeling industry.</h4><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title=" get access to our unlimited offers and opportunities as your listing is prioritized. Be part of all aspects of castings and listings as you are allowed to select unlimited categories of the modeling industry"></span>
            <button class="btn btn-lg btn-block changeplan" data-toggle='modal' data-target='#exampleModal' style="background: #54d7e3; color: #fff;" id="3"><span class="glyphicon glyphicon-download"></span> GET IT</button>  
                </div>
                <div class="col-lg-12" style="border: 1px solid #000; font-weight: bold;">
                <br>
                    <p>Unlimited  Category/Discipline Selections</p>
                    <hr>
                    <p>Select or Apply for all casts/jobs monthly</p>
                    <hr>
                    <p>Eligible for Afrodaisy Sponsored Photo-Sessions</p>
                    <hr>
                    <p>Eligible to be featured on social media handle (Instagram, Facebook etc) with details</p>
                    <hr>
                    <p>Get seen by Agencies, photographers and industry professionals through our prioritized listing</p>
                    <hr>
                    <p>Unlimited Qualifications for Afrodaisy Awards, Casts and Rewards</p>
                    <hr>
                    <p>Prioritized Listing</p>
                    <hr>
                    <p>Eligible to Contact Agencies and Photographers</p>
                    <hr>
                    <p>Receive email alerts or notifications castings in your area</p>
                    <div class="col-lg-12">
            <button class="btn btn-lg btn-block changeplan" data-toggle='modal' data-target='#exampleModal' style="background: #54d7e3; color: #fff;" id="3"><span class="glyphicon glyphicon-download"></span> GET IT</button>
        </div>
                </div>
            </div> 
        </div>
    </div>
<br>
</div>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Change Subscription</h4>
      </div>
      <div class="subshow"> 
      </div>
    </div>
  </div>
</div>

@stop
@section('script')
{{ HTML::script('js/message.js') }}
@stop