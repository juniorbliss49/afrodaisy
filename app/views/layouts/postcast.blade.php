@extends('layouts.main')

@section('content')

<div class="col-lg-10">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>HOW TO POST A CAST/JOB</h2>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ol style="list-style-type: decimal;">
            <li><strong>REGISTER/ LOGIN</strong>
                <img src="/img/postcast/Slide1.JPG" class="img-responsive">
                <br>
            </li>
            <li><strong>Go to your dashboard and Select "Create New Cast" </strong>
                <img src="/img/postcast/Slide2.JPG" class="img-responsive">
                <br>
            </li>
            <li><strong>Fill out the cast information<br> <br>
                        Note: Describe your cast properly to enable afrodaisy team and the model to have a good knowledge of your cast 
                        Select your mode of payment
                        Select your city first, e.g Port-Hacourt, to enable you fill out the rest of your location</strong>
                        <br><br>
                        <img src="/img/postcast/Slide3.JPG" class="img-responsive">
                        <br><br>
            </li>
            <li><strong>Fill out your cast date accurately making sure the dates don’t interfere with each other</strong>

                        <img src="/img/postcast/Slide1 (2).JPG" class="img-responsive">
            </li>
            <li><strong>Upload an image that best describes your cast and save</strong>
            <br>
                        <img src="/img/postcast/Slide5.JPG" class="img-responsive">
            </li>
            <li><strong>Please Wait, while your cast is approved by afrodaisy models team</strong>
            <br>
                      <img src="/img/postcast/Slide6.JPG" class="img-responsive">  
            </li>
            <li><strong>MANAGE CAST</strong>
                <p>After ur cast is approved by Afrodaisy team go to "cast listing"and manage your cast thus:</p>
                <ul>
                    <li>Set your preferences to match your specifications (models are filtered by the parameters set in this section)</li>
                    <img src="/img/postcast/Slide7.JPG" class="img-responsive">
                </ul>
            </li>
            <li><strong>Invite Models</strong>
                <p>You can invite models for your cast with any of the following methods</p>
                <ul>
                    <li>Invite from list: Invite models from the list of models available on afrodaisy models platform
                    <img src="/img/postcast/Slide8.JPG" class="img-responsive">
                    </li>
                    <li>Direct Booking: Book model directly by clicking on “book model” on the model’s profile page, select from the available options (invite to apply to an existing cast, create new cast for invitation)
                    <img src="/img/postcast/Slide11.JPG" class="img-responsive">
                    </li>
                    <li>Select Models From Your Favourite or Contacted Models: click “”from the drop down menu select any of the options (All – favourite –contacted) and click on “Invite”
                    <img src="/img/postcast/Slide10.JPG" class="img-responsive">
                    </li>
                    <li>Manage Applicants: to select models who applied for the cast go to “Manage Applicants”  click on “New Applicant” and select the model(s) of your choice and then, click on “Confirm Applicant”.
                    <img src="/img/postcast/Slide12.JPG" class="img-responsive">
                    </li>
                </ul>
                <p>Model(s) selected will be saved in your “Confirmed” folder</p>
            </li>
            <li><strong>Invited models, you can view the list of models you invited here </strong>
                <br>
                <img src="/img/postcast/Slide9.JPG" class="img-responsive">
            </li>
            <li><strong>Manage applicants, this section allows you to manage all the applicants.</strong>
                <ul>
                    <li>Remove or discard applicant
                    <img src="/img/postcast/Slide13.JPG" class="img-responsive">
                    </li>
                    <li>Confirm applicant
                    <img src="/img/postcast/Slide14.JPG" class="img-responsive">
                    </li>
                </ul>
            </li>
            <li><strong>PAYMENT</strong>
                <ul>
                    <li>Proceed to check out after managing your cast
                    </li>
                    <li>Select “Check Out” to advance to the next stage of payment and click on “Proceed to Payment”
                        <img src="/img/postcast/Slide16.JPG" class="img-responsive">
                        <br>
                        <br>
                    </li>
                    <li>Choose between offline or online payment process for your payment
                        <img src="/img/postcast/Slide17.JPG" class="img-responsive">
                    </li>
                </ul>
            </li>
            </ol>
        </div>
    </div>
</div>

@stop()
@section('script')

{{ HTML::script('js/message.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop