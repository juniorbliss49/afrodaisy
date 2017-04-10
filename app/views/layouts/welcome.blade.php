<!DOCTYPE html>
<html>
<head>
  <title>Afrodaisy Models</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{ HTML::style('css/bootstrap.min.css') }}
  {{ HTML::style('css/custom.css') }}
  {{ HTML::style('assets/libs/font-awesome/css/font-awesome.min.css') }}
  {{ HTML::style('css/select2.min.css') }}

  {{ HTML::script('js/jquery.min.js') }}
  {{ HTML::script('js/bootstrap.min.js') }}
  {{ HTML::script('js/dropdown.js') }}
    {{ HTML::script('js/spin.min.js') }}
    {{ HTML::script('js/jquery.spin.js') }}
  {{ HTML::script('js/bootstrap-hover-dropdown.min.js') }}
{{ HTML::script('js/modelNotify.js') }}
</head>
<body>
<div class="wrapper">
  <div class="top_bar">
    <div class="container">
     <div class="row" style="border-bottom: 1px #f47735 solid; padding-bottom: 1.4%;">
        
            <nav class="navbar navscolor">
  <div class="container-fluid" style="height: 5%">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <div class="row">
      <div class="col-lg-6 col-xs-6 text-left">
    <a href="/" class="navbar-brand" style="color: #fff"><img src="/img/afro daisy2 C-01-01.png" style="margin-top: -33px; padding-bottom: 1.4%;" width="180px" height="180px"></a>
      </div>
      <div class="col-lg-6 col-xs-6">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar" style="color: #f47735; background: #f47735;"></span>
        <span class="icon-bar" style="color: #f47735; background: #f47735;"></span>
        <span class="icon-bar" style="color: #f47735; background: #f47735;"></span>
      </button> 
      </div>
    </div>
     <br>     
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <br>
        <li><a href="#" class="dropdown-toggle nav-color" data-hover="dropdown" data-toggle="dropdown" data-delay="250" data-close-others="false" role="button" aria-haspopup="true" aria-expanded="false">SEARCH <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" href="/modelsearch">Models</a></li>
            <li><a tabindex="-1" href="/users/agency">Agencies</a></li>
            <li><a tabindex="-1" href="/users/photographers">Photographers</a></li>
            <li><a tabindex="-1" href="/users/fashion">Fashion stylists</a></li>
            <li><a tabindex="-1" href="/users/artist">Hair and Makeup Artists</a></li>
            <li><a tabindex="-1" href="/users/others">Other Professionals</a></li>
          </ul>
        </li>
        <li><a href="#" class="dropdown-toggle nav-color" data-hover="dropdown" data-toggle="dropdown" data-delay="250" data-close-others="false" role="button" aria-haspopup="true" aria-expanded="false">CAST/JOB <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" href="/post-a-cast">How to Post a Cast</a></li>
            <li><a tabindex="-1" href="/casting">View cast/job</a></li>
            <li><a tabindex="-1" href="/job">View Contracts</a></li>
            <li><a tabindex="-1" href="/modelsearch">Book a Model</a></li>
          </ul>
        </li>
        <li><a href="#" class="dropdown-toggle nav-color" data-hover="dropdown" data-toggle="dropdown" data-delay="250" data-close-others="false" role="button" aria-haspopup="true" aria-expanded="false">MARKETPLACE <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" href="/photosession">Professional Photos</a></li>
            <li><a tabindex="-1" href="/courses">Courses and Offers</a></li>
            <li><a tabindex="-1" href="/services">Services</a></li>
          </ul>
        </li>
        <li><a href="/poll" class="nav-color">POLL</a></li>
        <li><a href="#" class="dropdown-toggle nav-color" data-hover="dropdown" data-toggle="dropdown" data-delay="250" data-close-others="false" role="button" aria-haspopup="true" aria-expanded="false">NEWS/MODEL STYLE<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" href="http://blog.afrodaisy.com/" target="_">Blog</a></li>
            <li><a tabindex="-1" href="/modelling-advice">Modeling Advice</a></li>
            <li><a tabindex="-1" href="/plans">Plans</a></li>
            <li><a tabindex="-1" href="/faq">FAQ</a></li>
          </ul>
          </li>
      </ul>
  </div>
</div>
</nav>
</div>
          
        <div class="row">
          <br>
          <?php
            if(Auth::check()){
                ?>
                <div class="row text-right bd-login">
            <div class="col-lg-4 col-xs-5 text-right">
            <?php
            if (isset($btnpay)) {
               ?>
                  <a href="/models/photoupload" class="btn btn-sm" id="dash">My Dashboard</a>
              <?php
                }else{
              if (Session::has('models')){
              ?>
                  <a href="/models/welcome" class="btn btn-sm" id="dash">My Dashboard</a>
              <?php
             }elseif (Session::has('others')){
                ?>
                  <a href="/others/welcome" class="btn btn-sm" id="dash">My Dashboard</a>
              <?php
              }elseif (Session::has('modelspage')){
                ?>
                  <a href="/models/dashboard" class="btn btn-sm" id="dash">My Dashboard</a>
                <?php
                }elseif (Session::has('otherspage')){
              ?>
                  <a href="/others/dashboard" class="btn btn-sm" id="dash">My Dashboard</a>
              <?php
              }elseif (Session::has('category')) {
                ?>
                <a href="/models/photoupload" class="btn btn-sm" id="dash">My Dashboard</a>
                <?php
              }elseif (Session::has('subscribe')) {
                ?>
                <a href="/models/changesubscription" class="btn btn-sm" id="dash">My Dashboard</a>
                <?php
              }elseif (Session::has('photoupload')) {
                ?>
                <a href="/models/photoupload" class="btn btn-sm" id="dash">My Dashboard</a>
                <?php
              }
              else{
                ?>
              <a href="dashboard" class="btn btn-sm" id="dash">My Dashboard</a>
              <?php
              }
            }
              
              ?>
              </div> 
              @if(!empty(Auth::user()->id))
            <div class="col-lg-4 col-xs-3 text-center">
            <a href="#" alt="notifications" id="dLabel" class="btn btn-sm btn-default notify" style="margin-right: -40%; color: orange; border:none" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-globe" data-toggle="tooltip" data-placement="bottom" title="Notifications" trigger='hover' style="font-size: 200%;">{{$getnotifyunseen}}</span>        
            </a>
            <ul class="dropdown-menu text-left" aria-labelledby="dLabel" style="width: 300%; height: 800%; overflow-y: scroll; overflow-x: hidden; margin-left: -120%">
              <div class="castId">
              </div>
            </ul>
            </div>
            @endif
            <div class='col-lg-4 col-xs-4 text-left'>
            <a href="/signout" class="btn btn-default btn-sm">Signout</a>
            </div>
          </div>
                <?php
            }else{
            ?>
            <div class="row bd-login">
            <div class='col-lg-12 col-xs-12'>
            <div class='row'>
              <div class='col-lg-6 col-xs-6'>
                <a href='/signin' class="btn btn-sm" id="dash">
                 <strong>SIGN IN</strong>
                </a>
              </div>
              <div class='col-lg-6 col-xs-6'>
                <a href='/signup' class="btn btn-sm" id="dash">
                  <strong>REGISTER</strong>
                </a>
              </div>
            </div>
            </div>
          </div>
          <?php
          }
          ?>
          </div>    
          
      </div>
    </div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="row">
		
    <br>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <br>
			@yield('content')

		</div>
	</div>
  <br>
<br>
<br>
<br>
<br>
<br>
<br>
	<div class="top_footer">
    <br>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-sm-5 col-xs-12">
        <ul style="list-style-type: none; font-size: 12px">
          <li>© 2016 Afrodaisy Models.</li>
          <li>Powered by <a href="http://www.Kajandi.com/" target="_">Kajandi LTD</a></li>  
          <li>To advertise with us contact: info@afrodaisy.com</li>  
        </ul>
          
          <ul style="list-style-type: none; float: left; color: #fff;">
            <li style="float: left; margin-right: 5px"><a href="https://web.facebook.com/afrodaisymodels/" target="_"><i class="fa fa-facebook-square fa-lg" style="display: block;"></i></a></li>
            <li style="float: left; margin-right: 5px"><a href="https://twitter.com/Afrodaisymodels" target="_"><i class="fa fa-twitter-square fa-lg" style="display: block;"></i></a></li>
            <li style="float: left;"><a href="https://www.instagram.com/afrodaisymodels/" target="_"><i class="fa fa-instagram fa-lg" style="display: block;"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <ul style="list-style-type: none; font-size: 12px">
            <li><a href="/about" style="color: #000">About Us</a></li>
            <li><a href="/contact-us" style="color: #000">Contact Us</a></li>
            <li><a href="http://blog.afrodaisy.com/" target="_" style="color: #000">Blog</a></li>
            <li><a href="/terms-and-conditions" style="color: #000">Terms and condition</a></li>
            <li><a href="/privacy" style="color: #000">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12">
          <img src="/img/afro daisy2 C-01-01.png" width="165px" height="165px">
        </div>
      </div>
    </div>
  </div>
</div>
@yield('script')
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58c184df5b8fe5150eee98f6/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>