<!DOCTYPE html>
<html>
<head>
  <title>Afrodaisy Models</title>
	<link rel="stylesheet" type="text/css" href="">
	<link rel="stylesheet" type="text/css" href="">
  <link rel="apple-touch-icon" sizes="57x57" href="icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
<link rel="manifest" href="icon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="icon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/custom.css') }}
  {{ HTML::style('assets/libs/font-awesome/css/font-awesome.min.css') }}

	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/dropdown.js') }}
	{{ HTML::script('js/bootstrap-hover-dropdown.min.js') }}
</head>
<body>
<div class="wrapper">
	<div class="top_bar">
		<div class="container">
			<div class="row">
				
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
        <li><a href="#" class="dropdown-toggle nav-color" data-hover="dropdown" data-toggle="dropdown" data-delay="250" data-close-others="false" role="button" aria-haspopup="true" aria-expanded="false">CASTING <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" href="/post-a-cast">How to Post a Cast</a></li>
            <li><a tabindex="-1" href="/casting">View casting</a></li>
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
			    <br>
			    	<?php
          if(Auth::check()){
          ?>
              <div class="text-right bd-login">
              <div class="col-lg-6 col-xs-6">
              <?php
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
              }elseif (Session::has('photoupload')) {
                ?>
                <a href="/models/photoupload" class="btn btn-sm" id="dash">My Dashboard</a>
                <?php
              }elseif (Session::has('subscribe')) {
                ?>
                <a href="/models/changesubscription" class="btn btn-sm" id="dash">My Dashboard</a>
                <?php
              }else{
                ?>
              <a href="dashboard" class="btn btn-sm" id="dash">My Dashboard</a>
              <?php
              }
              ?>
              </div>
              <div class="col-lg-6 col-xs-6">
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
	<div class="top_slide">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <div class="item active">
    <br>
  <br>
  <br>
  <br>
  <br>
    	{{ HTML::image('bannerpics/01.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
    	{{ HTML::image('bannerpics/00002.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
    	{{ HTML::image('bannerpics/003.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
      {{ HTML::image('bannerpics/07.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
      {{ HTML::image('bannerpics/008.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
      {{ HTML::image('bannerpics/11.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
      {{ HTML::image('bannerpics/12.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
      {{ HTML::image('bannerpics/17.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
      {{ HTML::image('bannerpics/250.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
    <br>
  <br>
  <br>
  <br>
  <br>
      {{ HTML::image('bannerpics/HP03.jpg', '', array('class' => 'img-responsive')) }}
      <div class="carousel-caption">
      </div>
    </div>
  </div>

<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
 
</div>
	</div>
	<div class="top_img container">
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-md-6">
					{{ HTML::image('bodypic/011.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6">
					{{ HTML::image('bodypic/015.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
		</div>
		<div class="row">
			<div class="row top_img_text">
				<div class="col-lg-12">
					<p class="text-center">FASHION, MODELING AND SHOWBIZ</p>
				</div>
			</div>
		</div>
	</div>
	<div class="top_main">
		<div class="container">
			<div class="row">
				<br>
				<br>
				<br>
				<br>
				<br>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<img src="img/foot/004_filtered.jpg" width="370px" height="210px" class="img-thumbnail img-responsive">
					<div class="caption text-justify" style="font-family: 'Hobo'; color: #f47735;">
						<p>Afrodaisy.com is not a modeling or entertainment agency. We provide numerous opportunities for models, individuals and industry professionals no matter the category or discipline to connect with each other. Our booking system is secure and guarantees payment as long as terms are agreed between both parties.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<img src="img/foot/008.jpg" width="370px" height="210px" class="img-thumbnail img-responsive">
					<div class="caption text-justify" style="font-family: 'Hobo'; color: #f47735;">
						<p>Afrodaisy.com is a platform where models can create, update and present their profiles (portfolio) for booking whilst arranging of contracts between them and industry professionals. Casts (jobs) are created by industry professionals and approved by the afrodaisy.com team. Models who meet the requirements can apply for the job, get booked and eventually get paid</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<img src="img/foot/016.jpg" width="370px" height="210px" class="img-thumbnail img-responsive">
					<div class="caption text-justify" style="font-family: 'Hobo'; color: #f47735;">
						<p>Afrodaisy.com provides channels for professional photographers, agencies, fashion stylist, make-up artist, tattoo artist and other industry professionals to promote their services, gain visibility and bookings. Payment is also guaranteed as long as terms are agreed between parties.</p>
					</div>
					<br>
				<br>
				</div>
				<br>
				<br>
				<br>
				<br>
				<br>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row top_img_text text-center">
			<p>Models</p>
		</div>
		<div class="row">
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB1.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB2.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/IMG_0036.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB4.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB5.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB3.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB9.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB14.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB11.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/FB15.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
			<div class="col-lg-2 col-sm-6">
				{{ HTML::image('img/footer/real life.jpg', '', array('class' => 'img-responsive img-thumbnail')) }}
			</div>
		</div>
		<br>
		<br>
		<br>
	</div>
	<div class="top_footer">
    <br>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-sm-5 col-xs-12">
        <ul style="list-style-type: none; font-size: 12px">
          <li>© 2017 Afrodaisy.</li>
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
            <li><a href="http://blog.afrodaisy.com/" style="color: #000">Blog</a></li>
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