@extends('layouts.main')
@section('content')
    <script src="/js/jssor.slider-22.0.15.mini.js" type="text/javascript" data-library="jssor.slider.mini" data-version="22.0.15"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
              $AutoPlay: true,
              $AutoPlaySteps: 4,
              $SlideDuration: 160,
              $SlideWidth: 200,
              $SlideSpacing: 3,
              $Cols: 4,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 4
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 1,
                $SpacingY: 1
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 809);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*responsive code end*/
        });
    </script>
    <style>
        /* jssor slider bullet navigator skin 03 css */
        /*
        .jssorb03 div           (normal)
        .jssorb03 div:hover     (normal mouseover)
        .jssorb03 .av           (active)
        .jssorb03 .av:hover     (active mouseover)
        .jssorb03 .dn           (mousedown)
        */
        .jssorb03 {
            position: absolute;
        }
        .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
            position: absolute;
            /* size of bullet elment */
            width: 21px;
            height: 21px;
            text-align: center;
            line-height: 21px;
            color: white;
            font-size: 12px;
            background: url('img/b03.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }

        /* jssor slider arrow navigator skin 03 css */
        /*
        .jssora03l                  (normal)
        .jssora03r                  (normal)
        .jssora03l:hover            (normal mouseover)
        .jssora03r:hover            (normal mouseover)
        .jssora03l.jssora03ldn      (mousedown)
        .jssora03r.jssora03rdn      (mousedown)
        .jssora03l.jssora03ldn      (disabled)
        .jssora03r.jssora03rdn      (disabled)
        */
        .jssora03l, .jssora03r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('img/a03.png') no-repeat;
            overflow: hidden;
        }
        .jssora03l { background-position: -3px -33px; }
        .jssora03r { background-position: -63px -33px; }
        .jssora03l:hover { background-position: -123px -33px; }
        .jssora03r:hover { background-position: -183px -33px; }
        .jssora03l.jssora03ldn { background-position: -243px -33px; }
        .jssora03r.jssora03rdn { background-position: -303px -33px; }
        .jssora03l.jssora03lds { background-position: -3px -33px; opacity: .3; pointer-events: none; }
        .jssora03r.jssora03rds { background-position: -63px -33px; opacity: .3; pointer-events: none; }
    </style>
<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-12">
			<h3>Models Search</h3>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
		
			<div class="well">
				<form id="form">
				<div class="row">			
					<div class="col-lg-2 col-sm-2 col-xs-12">
						<select class="form-control" style="width: 100%" name="gender">
							<option value="">all gender</option>
							<option value="male">male</option>
							<option value="female">female</option>
						</select>
					</div>
					<div class="col-lg-2 col-sm-2 col-xs-12">
						<select name="getcountry" class="form-control" style="width: 100%">
								<option value="">all countries</option>
							@foreach($getCountry as $country)
								<option value="{{$country->country}}">{{$country->country}}</option>
							@endforeach	
						</select>
					</div>
					<div class="col-lg-3 col-sm-3 col-xs-12">
						<select class="form-control" name="getstates" style="width: 100%;">
							<option value="">all states</option>
							@foreach($location as $state)
								<option value="{{$state->location}}">{{$state->location}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-lg-2 col-sm-2 col-xs-12">
						<select class="form-control" style="width: 100%" name="categories">
							<option value="">all categories</option>
							@foreach($categories as $cat)
								<option value="{{$cat->id}}">{{$cat->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-lg-2 col-sm-2 col-xs-12">
						<select class="form-control" style="width: 100%" name="types">
							<option value="">all types</option>
							@foreach($modelType as $type)
								<option value="{{$type->id}}">{{$type->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2 col-sm-2 col-xs-12">
                                    <br>
                                    <select class="form-control" style="width: 100%" name="modelType">
                                          <option value="">Model Type</option>
                                          <option value="newface">New Faces</option>
                                          <option value="promodel">Professional Models</option>
                                    </select>
					</div>
					<div class="col-lg-2 col-sm-2 col-xs-12">
						<h5><b>Age</b></h5>
						<select name="agemin">
    			<option value="" selected="selected">
        age    </option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
            <option value="53">53</option>
            <option value="54">54</option>
            <option value="55">55</option>
            <option value="56">56</option>
            <option value="57">57</option>
            <option value="58">58</option>
            <option value="59">59</option>
            <option value="60">60</option>
            <option value="61">61</option>
            <option value="62">62</option>
            <option value="63">63</option>
            <option value="64">64</option>
            <option value="65">65</option>
            <option value="66">66</option>
            <option value="67">67</option>
            <option value="68">68</option>
            <option value="69">69</option>
            <option value="70">70</option>
    </select> to 
						<select name="agemax">
    <option value="" selected="selected">
        age    </option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
            <option value="53">53</option>
            <option value="54">54</option>
            <option value="55">55</option>
            <option value="56">56</option>
            <option value="57">57</option>
            <option value="58">58</option>
            <option value="59">59</option>
            <option value="60">60</option>
            <option value="61">61</option>
            <option value="62">62</option>
            <option value="63">63</option>
            <option value="64">64</option>
            <option value="65">65</option>
            <option value="66">66</option>
            <option value="67">67</option>
            <option value="68">68</option>
            <option value="69">69</option>
            <option value="70">70</option>
    </select>
					</div>
					<div class="col-lg-4 col-sm-4 col-xs-12">
						<h5><b>Height</b></h5>
						<select class="search_selector" name="height-min">
    <option value="" selected="selected">
        height    </option>
            <option value="120">120cm / 3.94ft"</option>
            <option value="121">121cm / 3.97ft"</option>
            <option value="122">122cm / 4.00ft"</option>
            <option value="123">123cm / 4.04ft"</option>
            <option value="124">124cm / 4.07ft"</option>
            <option value="125">125cm / 4.10ft"</option>
            <option value="126">126cm / 4.13ft"</option>
            <option value="127">127cm / 4.17ft"</option>
            <option value="128">128cm / 4.20ft"</option>
            <option value="129">129cm / 4.23ft"</option>
            <option value="130">130cm / 4.27ft"</option>
            <option value="131">131cm / 4.30ft"</option>
            <option value="132">132cm / 4.33ft"</option>
            <option value="133">133cm / 4.36ft"</option>
            <option value="134">134cm / 4.40ft"</option>
            <option value="135">135cm / 4.43ft"</option>
            <option value="136">136cm / 4.46ft"</option>
            <option value="137">137cm / 4.49ft"</option>
            <option value="138">138cm / 4.53ft"</option>
            <option value="139">139cm / 4.56ft"</option>
            <option value="140">140cm / 4.59ft"</option>
            <option value="141">141cm / 4.63ft"</option>
            <option value="142">142cm / 4.66ft"</option>
            <option value="143">143cm / 4.69ft"</option>
            <option value="144">144cm / 4.72ft"</option>
            <option value="145">145cm / 4.76ft"</option>
            <option value="146">146cm / 4.79ft"</option>
            <option value="147">147cm / 4.82ft"</option>
            <option value="148">148cm / 4.86ft"</option>
            <option value="149">149cm / 4.89ft"</option>
            <option value="150">150cm / 4.92ft"</option>
            <option value="151">151cm / 4.95ft"</option>
            <option value="152">152cm / 4.99ft"</option>
            <option value="153">153cm / 5.02ft"</option>
            <option value="154">154cm / 5.05ft"</option>
            <option value="155">155cm / 5.09ft"</option>
            <option value="156">156cm / 5.12ft"</option>
            <option value="157">157cm / 5.15ft"</option>
            <option value="158">158cm / 5.18ft"</option>
            <option value="159">159cm / 5.22ft"</option>
            <option value="160">160cm / 5.25ft"</option>
            <option value="161">161cm / 5.28ft"</option>
            <option value="162">162cm / 5.31ft"</option>
            <option value="163">163cm / 5.35ft"</option>
            <option value="164">164cm / 5.38ft"</option>
            <option value="165">165cm / 5.41ft"</option>
            <option value="166">166cm / 5.45ft"</option>
            <option value="167">167cm / 5.48ft"</option>
            <option value="168">168cm / 5.51ft"</option>
            <option value="169">169cm / 5.54ft"</option>
            <option value="170">170cm / 5.58ft"</option>
            <option value="171">171cm / 5.61ft"</option>
            <option value="172">172cm / 5.64ft"</option>
            <option value="173">173cm / 5.68ft"</option>
            <option value="174">174cm / 5.71ft"</option>
            <option value="175">175cm / 5.74ft"</option>
            <option value="176">176cm / 5.77ft"</option>
            <option value="177">177cm / 5.81ft"</option>
            <option value="178">178cm / 5.84ft"</option>
            <option value="179">179cm / 5.87ft"</option>
            <option value="180">180cm / 5.91ft"</option>
            <option value="181">181cm / 5.94ft"</option>
            <option value="182">182cm / 5.97ft"</option>
            <option value="183">183cm / 6.00ft"</option>
            <option value="184">184cm / 6.04ft"</option>
            <option value="185">185cm / 6.07ft"</option>
            <option value="186">186cm / 6.10ft"</option>
            <option value="187">187cm / 6.14ft"</option>
            <option value="188">188cm / 6.17ft"</option>
            <option value="189">189cm / 6.20ft"</option>
            <option value="190">190cm / 6.23ft"</option>
            <option value="191">191cm / 6.27ft"</option>
            <option value="192">192cm / 6.30ft"</option>
            <option value="193">193cm / 6.33ft"</option>
            <option value="194">194cm / 6.36ft"</option>
            <option value="195">195cm / 6.40ft"</option>
            <option value="196">196cm / 6.43ft"</option>
            <option value="197">197cm / 6.46ft"</option>
            <option value="198">198cm / 6.50ft"</option>
            <option value="199">199cm / 6.53ft"</option>
            <option value="200">200cm / 6.56ft"</option>
            <option value="201">201cm / 6.59ft"</option>
            <option value="202">202cm / 6.63ft"</option>
            <option value="203">203cm / 6.66ft"</option>
            <option value="204">204cm / 6.69ft"</option>
            <option value="205">205cm / 6.73ft"</option>
            <option value="206">206cm / 6.76ft"</option>
            <option value="207">207cm / 6.79ft"</option>
            <option value="208">208cm / 6.82ft"</option>
            <option value="209">209cm / 6.86ft"</option>
            <option value="210">210cm / 6.89ft"</option>
    </select> to 
						<select class="search_selector" name="height-max">
    <option value="" selected="selected">
        height    </option>
            <option value="120">120cm / 3.94ft"</option>
            <option value="121">121cm / 3.97ft"</option>
            <option value="122">122cm / 4.00ft"</option>
            <option value="123">123cm / 4.04ft"</option>
            <option value="124">124cm / 4.07ft"</option>
            <option value="125">125cm / 4.10ft"</option>
            <option value="126">126cm / 4.13ft"</option>
            <option value="127">127cm / 4.17ft"</option>
            <option value="128">128cm / 4.20ft"</option>
            <option value="129">129cm / 4.23ft"</option>
            <option value="130">130cm / 4.27ft"</option>
            <option value="131">131cm / 4.30ft"</option>
            <option value="132">132cm / 4.33ft"</option>
            <option value="133">133cm / 4.36ft"</option>
            <option value="134">134cm / 4.40ft"</option>
            <option value="135">135cm / 4.43ft"</option>
            <option value="136">136cm / 4.46ft"</option>
            <option value="137">137cm / 4.49ft"</option>
            <option value="138">138cm / 4.53ft"</option>
            <option value="139">139cm / 4.56ft"</option>
            <option value="140">140cm / 4.59ft"</option>
            <option value="141">141cm / 4.63ft"</option>
            <option value="142">142cm / 4.66ft"</option>
            <option value="143">143cm / 4.69ft"</option>
            <option value="144">144cm / 4.72ft"</option>
            <option value="145">145cm / 4.76ft"</option>
            <option value="146">146cm / 4.79ft"</option>
            <option value="147">147cm / 4.82ft"</option>
            <option value="148">148cm / 4.86ft"</option>
            <option value="149">149cm / 4.89ft"</option>
            <option value="150">150cm / 4.92ft"</option>
            <option value="151">151cm / 4.95ft"</option>
            <option value="152">152cm / 4.99ft"</option>
            <option value="153">153cm / 5.02ft"</option>
            <option value="154">154cm / 5.05ft"</option>
            <option value="155">155cm / 5.09ft"</option>
            <option value="156">156cm / 5.12ft"</option>
            <option value="157">157cm / 5.15ft"</option>
            <option value="158">158cm / 5.18ft"</option>
            <option value="159">159cm / 5.22ft"</option>
            <option value="160">160cm / 5.25ft"</option>
            <option value="161">161cm / 5.28ft"</option>
            <option value="162">162cm / 5.31ft"</option>
            <option value="163">163cm / 5.35ft"</option>
            <option value="164">164cm / 5.38ft"</option>
            <option value="165">165cm / 5.41ft"</option>
            <option value="166">166cm / 5.45ft"</option>
            <option value="167">167cm / 5.48ft"</option>
            <option value="168">168cm / 5.51ft"</option>
            <option value="169">169cm / 5.54ft"</option>
            <option value="170">170cm / 5.58ft"</option>
            <option value="171">171cm / 5.61ft"</option>
            <option value="172">172cm / 5.64ft"</option>
            <option value="173">173cm / 5.68ft"</option>
            <option value="174">174cm / 5.71ft"</option>
            <option value="175">175cm / 5.74ft"</option>
            <option value="176">176cm / 5.77ft"</option>
            <option value="177">177cm / 5.81ft"</option>
            <option value="178">178cm / 5.84ft"</option>
            <option value="179">179cm / 5.87ft"</option>
            <option value="180">180cm / 5.91ft"</option>
            <option value="181">181cm / 5.94ft"</option>
            <option value="182">182cm / 5.97ft"</option>
            <option value="183">183cm / 6.00ft"</option>
            <option value="184">184cm / 6.04ft"</option>
            <option value="185">185cm / 6.07ft"</option>
            <option value="186">186cm / 6.10ft"</option>
            <option value="187">187cm / 6.14ft"</option>
            <option value="188">188cm / 6.17ft"</option>
            <option value="189">189cm / 6.20ft"</option>
            <option value="190">190cm / 6.23ft"</option>
            <option value="191">191cm / 6.27ft"</option>
            <option value="192">192cm / 6.30ft"</option>
            <option value="193">193cm / 6.33ft"</option>
            <option value="194">194cm / 6.36ft"</option>
            <option value="195">195cm / 6.40ft"</option>
            <option value="196">196cm / 6.43ft"</option>
            <option value="197">197cm / 6.46ft"</option>
            <option value="198">198cm / 6.50ft"</option>
            <option value="199">199cm / 6.53ft"</option>
            <option value="200">200cm / 6.56ft"</option>
            <option value="201">201cm / 6.59ft"</option>
            <option value="202">202cm / 6.63ft"</option>
            <option value="203">203cm / 6.66ft"</option>
            <option value="204">204cm / 6.69ft"</option>
            <option value="205">205cm / 6.73ft"</option>
            <option value="206">206cm / 6.76ft"</option>
            <option value="207">207cm / 6.79ft"</option>
            <option value="208">208cm / 6.82ft"</option>
            <option value="209">209cm / 6.86ft"</option>
            <option value="210">210cm / 6.89ft"</option>
    </select>
					</div>
					<div class="col-lg-3 col-sm-3 col-xs-12">
					<br>
						<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-12">
						<input type="text" class="form-control" class="search" name="search" style="border-radius: 3px; border: none; border: 1px solid #999; padding: 5px">								
							</div>
							<div class="col-lg-2 col-sm-2  col-xs-3 text-left">
						<button class="btn btn-default">Search</button>								
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12">
				<br>
						<a href="#click" id="show">click to see more options</a>
						<hr style="background-color: #000">
					</div>
				</div>
				<div class="row" id="showit" style="display: none">
					<div class="col-lg-4 col-sm-4">
						<div class="row">
							<div class="col-lg-12 col-sm-12">
								<div class="col-lg-12 col-sm-12">
									<label style="color: #000">
										Chest/Burst
									</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-sm-12">
									<select class="search_selector" name="bust-min" style="width: 100%">
    <option value="" selected="selected">
        chest / bust    </option>
            <option value="65">65cm / 25.6"</option>
            <option value="66">66cm / 26.0"</option>
            <option value="67">67cm / 26.4"</option>
            <option value="68">68cm / 26.8"</option>
            <option value="69">69cm / 27.2"</option>
            <option value="70">70cm / 27.6"</option>
            <option value="71">71cm / 28.0"</option>
            <option value="72">72cm / 28.3"</option>
            <option value="73">73cm / 28.7"</option>
            <option value="74">74cm / 29.1"</option>
            <option value="75">75cm / 29.5"</option>
            <option value="76">76cm / 29.9"</option>
            <option value="77">77cm / 30.3"</option>
            <option value="78">78cm / 30.7"</option>
            <option value="79">79cm / 31.1"</option>
            <option value="80">80cm / 31.5"</option>
            <option value="81">81cm / 31.9"</option>
            <option value="82">82cm / 32.3"</option>
            <option value="83">83cm / 32.7"</option>
            <option value="84">84cm / 33.1"</option>
            <option value="85">85cm / 33.5"</option>
            <option value="86">86cm / 33.9"</option>
            <option value="87">87cm / 34.3"</option>
            <option value="88">88cm / 34.6"</option>
            <option value="89">89cm / 35.0"</option>
            <option value="90">90cm / 35.4"</option>
            <option value="91">91cm / 35.8"</option>
            <option value="92">92cm / 36.2"</option>
            <option value="93">93cm / 36.6"</option>
            <option value="94">94cm / 37.0"</option>
            <option value="95">95cm / 37.4"</option>
            <option value="96">96cm / 37.8"</option>
            <option value="97">97cm / 38.2"</option>
            <option value="98">98cm / 38.6"</option>
            <option value="99">99cm / 39.0"</option>
            <option value="100">100cm / 39.4"</option>
            <option value="101">101cm / 39.8"</option>
            <option value="102">102cm / 40.2"</option>
            <option value="103">103cm / 40.6"</option>
            <option value="104">104cm / 40.9"</option>
            <option value="105">105cm / 41.3"</option>
            <option value="106">106cm / 41.7"</option>
            <option value="107">107cm / 42.1"</option>
            <option value="108">108cm / 42.5"</option>
            <option value="109">109cm / 42.9"</option>
            <option value="110">110cm / 43.3"</option>
            <option value="111">111cm / 43.7"</option>
            <option value="112">112cm / 44.1"</option>
            <option value="113">113cm / 44.5"</option>
            <option value="114">114cm / 44.9"</option>
            <option value="115">115cm / 45.3"</option>
            <option value="116">116cm / 45.7"</option>
            <option value="117">117cm / 46.1"</option>
            <option value="118">118cm / 46.5"</option>
            <option value="119">119cm / 46.9"</option>
            <option value="120">120cm / 47.2"</option>
            <option value="121">121cm / 47.6"</option>
            <option value="122">122cm / 48.0"</option>
            <option value="123">123cm / 48.4"</option>
            <option value="124">124cm / 48.8"</option>
            <option value="125">125cm / 49.2"</option>
            <option value="126">126cm / 49.6"</option>
            <option value="127">127cm / 50.0"</option>
            <option value="128">128cm / 50.4"</option>
            <option value="129">129cm / 50.8"</option>
            <option value="130">130cm / 51.2"</option>
            <option value="131">131cm / 51.6"</option>
            <option value="132">132cm / 52.0"</option>
            <option value="133">133cm / 52.4"</option>
            <option value="134">134cm / 52.8"</option>
            <option value="135">135cm / 53.1"</option>
            <option value="136">136cm / 53.5"</option>
            <option value="137">137cm / 53.9"</option>
            <option value="138">138cm / 54.3"</option>
            <option value="139">139cm / 54.7"</option>
            <option value="140">140cm / 55.1"</option>
            <option value="141">141cm / 55.5"</option>
            <option value="142">142cm / 55.9"</option>
            <option value="143">143cm / 56.3"</option>
            <option value="144">144cm / 56.7"</option>
            <option value="145">145cm / 57.1"</option>
            <option value="146">146cm / 57.5"</option>
            <option value="147">147cm / 57.9"</option>
            <option value="148">148cm / 58.3"</option>
            <option value="149">149cm / 58.7"</option>
            <option value="150">150cm / 59.1"</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-sm-12">
								 	to 
								 </div>
								 <div class="col-lg-5 col-sm-5 col-xs-12">
									<select class="search_selector" name="bust-max" style="width: 100%">
    <option value="" selected="selected">
        chest / bust    </option>
            <option value="65">65cm / 25.6"</option>
            <option value="66">66cm / 26.0"</option>
            <option value="67">67cm / 26.4"</option>
            <option value="68">68cm / 26.8"</option>
            <option value="69">69cm / 27.2"</option>
            <option value="70">70cm / 27.6"</option>
            <option value="71">71cm / 28.0"</option>
            <option value="72">72cm / 28.3"</option>
            <option value="73">73cm / 28.7"</option>
            <option value="74">74cm / 29.1"</option>
            <option value="75">75cm / 29.5"</option>
            <option value="76">76cm / 29.9"</option>
            <option value="77">77cm / 30.3"</option>
            <option value="78">78cm / 30.7"</option>
            <option value="79">79cm / 31.1"</option>
            <option value="80">80cm / 31.5"</option>
            <option value="81">81cm / 31.9"</option>
            <option value="82">82cm / 32.3"</option>
            <option value="83">83cm / 32.7"</option>
            <option value="84">84cm / 33.1"</option>
            <option value="85">85cm / 33.5"</option>
            <option value="86">86cm / 33.9"</option>
            <option value="87">87cm / 34.3"</option>
            <option value="88">88cm / 34.6"</option>
            <option value="89">89cm / 35.0"</option>
            <option value="90">90cm / 35.4"</option>
            <option value="91">91cm / 35.8"</option>
            <option value="92">92cm / 36.2"</option>
            <option value="93">93cm / 36.6"</option>
            <option value="94">94cm / 37.0"</option>
            <option value="95">95cm / 37.4"</option>
            <option value="96">96cm / 37.8"</option>
            <option value="97">97cm / 38.2"</option>
            <option value="98">98cm / 38.6"</option>
            <option value="99">99cm / 39.0"</option>
            <option value="100">100cm / 39.4"</option>
            <option value="101">101cm / 39.8"</option>
            <option value="102">102cm / 40.2"</option>
            <option value="103">103cm / 40.6"</option>
            <option value="104">104cm / 40.9"</option>
            <option value="105">105cm / 41.3"</option>
            <option value="106">106cm / 41.7"</option>
            <option value="107">107cm / 42.1"</option>
            <option value="108">108cm / 42.5"</option>
            <option value="109">109cm / 42.9"</option>
            <option value="110">110cm / 43.3"</option>
            <option value="111">111cm / 43.7"</option>
            <option value="112">112cm / 44.1"</option>
            <option value="113">113cm / 44.5"</option>
            <option value="114">114cm / 44.9"</option>
            <option value="115">115cm / 45.3"</option>
            <option value="116">116cm / 45.7"</option>
            <option value="117">117cm / 46.1"</option>
            <option value="118">118cm / 46.5"</option>
            <option value="119">119cm / 46.9"</option>
            <option value="120">120cm / 47.2"</option>
            <option value="121">121cm / 47.6"</option>
            <option value="122">122cm / 48.0"</option>
            <option value="123">123cm / 48.4"</option>
            <option value="124">124cm / 48.8"</option>
            <option value="125">125cm / 49.2"</option>
            <option value="126">126cm / 49.6"</option>
            <option value="127">127cm / 50.0"</option>
            <option value="128">128cm / 50.4"</option>
            <option value="129">129cm / 50.8"</option>
            <option value="130">130cm / 51.2"</option>
            <option value="131">131cm / 51.6"</option>
            <option value="132">132cm / 52.0"</option>
            <option value="133">133cm / 52.4"</option>
            <option value="134">134cm / 52.8"</option>
            <option value="135">135cm / 53.1"</option>
            <option value="136">136cm / 53.5"</option>
            <option value="137">137cm / 53.9"</option>
            <option value="138">138cm / 54.3"</option>
            <option value="139">139cm / 54.7"</option>
            <option value="140">140cm / 55.1"</option>
            <option value="141">141cm / 55.5"</option>
            <option value="142">142cm / 55.9"</option>
            <option value="143">143cm / 56.3"</option>
            <option value="144">144cm / 56.7"</option>
            <option value="145">145cm / 57.1"</option>
            <option value="146">146cm / 57.5"</option>
            <option value="147">147cm / 57.9"</option>
            <option value="148">148cm / 58.3"</option>
            <option value="149">149cm / 58.7"</option>
            <option value="150">150cm / 59.1"</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
									<label style="color: #000">
										Collar
									</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
									<select class="search_selector" name="collar-min">
    <option value="" selected="selected">
        collar    </option>
            <option value="18">18cm / 7"</option>
            <option value="19">19cm / 7"</option>
            <option value="20">20cm / 8"</option>
            <option value="21">21cm / 8"</option>
            <option value="22">22cm / 9"</option>
            <option value="23">23cm / 9"</option>
            <option value="24">24cm / 9"</option>
            <option value="25">25cm / 10"</option>
            <option value="26">26cm / 10"</option>
            <option value="27">27cm / 11"</option>
            <option value="28">28cm / 11"</option>
            <option value="29">29cm / 11"</option>
            <option value="30">30cm / 12"</option>
            <option value="31">31cm / 12"</option>
            <option value="32">32cm / 13"</option>
            <option value="33">33cm / 13"</option>
            <option value="34">34cm / 13"</option>
            <option value="35">35cm / 14"</option>
            <option value="36">36cm / 14"</option>
            <option value="37">37cm / 15"</option>
            <option value="38">38cm / 15"</option>
            <option value="39">39cm / 15"</option>
            <option value="40">40cm / 16"</option>
            <option value="41">41cm / 16"</option>
            <option value="42">42cm / 17"</option>
            <option value="43">43cm / 17"</option>
            <option value="44">44cm / 17"</option>
            <option value="45">45cm / 18"</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-xs-12">
								 	to 
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
									<select class="search_selector" name="collar-max">
    <option value="" selected="selected">
        collar    </option>
            <option value="18">18cm / 7"</option>
            <option value="19">19cm / 7"</option>
            <option value="20">20cm / 8"</option>
            <option value="21">21cm / 8"</option>
            <option value="22">22cm / 9"</option>
            <option value="23">23cm / 9"</option>
            <option value="24">24cm / 9"</option>
            <option value="25">25cm / 10"</option>
            <option value="26">26cm / 10"</option>
            <option value="27">27cm / 11"</option>
            <option value="28">28cm / 11"</option>
            <option value="29">29cm / 11"</option>
            <option value="30">30cm / 12"</option>
            <option value="31">31cm / 12"</option>
            <option value="32">32cm / 13"</option>
            <option value="33">33cm / 13"</option>
            <option value="34">34cm / 13"</option>
            <option value="35">35cm / 14"</option>
            <option value="36">36cm / 14"</option>
            <option value="37">37cm / 15"</option>
            <option value="38">38cm / 15"</option>
            <option value="39">39cm / 15"</option>
            <option value="40">40cm / 16"</option>
            <option value="41">41cm / 16"</option>
            <option value="42">42cm / 17"</option>
            <option value="43">43cm / 17"</option>
            <option value="44">44cm / 17"</option>
            <option value="45">45cm / 18"</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
									<label style="color: #000">
										Dress
									</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
									<select class="search_selector" name="dress-min" style="width: 100px">
    <option value="" selected="selected">
        dress    </option>
            <option value="32">32 EU, 4 UK,  2  US</option>
            <option value="34">34 EU, 6 UK,  4  US</option>
            <option value="36">36 EU, 8 UK,  6  US</option>
            <option value="38">38 EU, 10 UK, 8, US</option>
            <option value="40">40 EU, 12 UK, 10 US</option>
            <option value="42">42 EU, 14 UK, 12 US</option>
            <option value="44">44 EU, 16 UK, 14 US</option>
            <option value="46">46 EU, 18 UK, 16 US</option>
            <option value="48">48 EU, 20 UK, 18 US</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-xs-12">
								 	to 
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
									<select class="search_selector" name="dress-max" style="width:100px">
    <option value="" selected="selected">
        dress    </option>
            <option value="32">32 EU, 4 UK,  2  US</option>
            <option value="34">34 EU, 6 UK,  4  US</option>
            <option value="36">36 EU, 8 UK,  6  US</option>
            <option value="38">38 EU, 10 UK, 8, US</option>
            <option value="40">40 EU, 12 UK, 10 US</option>
            <option value="42">42 EU, 14 UK, 12 US</option>
            <option value="44">44 EU, 16 UK, 14 US</option>
            <option value="46">46 EU, 18 UK, 16 US</option>
            <option value="48">48 EU, 20 UK, 18 US</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-6 col-sm-6 col-xs-12">
									<label style="color: #000">
										Hair color
									</label>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
									<label style="color: #000">
										Languages
									</label>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<select style="width: 100px" name="haircolor">
									<option value=''>Hair color</option>
									<option value='aubrum'>Aubrum</option>
									<option value='black'>Black</option>
									<option value='blonde'>Blonde</option>
									<option value='brown'>Brown</option>
									<option value='cendre'>Cendre</option>
									<option value='chestnut'>Chestnut</option>
									<option value='dark'>Dark</option>
									<option value='darkblonde'>Dark Blonde</option>
									<option value='darkbrown'>Dark Brown</option>
									<option value='grey'>Grey</option>
									<option value='hazel'>Hazel</option>
									<option value='lightblue'>Light Blue</option>
									<option value='redblonde'>Red Blonde</option>
									<option value='salt-pepper'>Salt and Pepper</option>
									<option value='lightblonde'>Light Blonde</option>
									<option value='strawberryblonde'>Strawberry Blonde</option>
								</select>	
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12">

								<select style="width: 100px" name="languages">
									<option value=''>languages</option>
									<option value='English'>English</option>
									<option value='Igbo'>Igbo</option>
									<option value='Hausa'>Hausa</option>
									<option value='Yoruba'>Yoruba</option>
									<option value='Pidgin'>Pidgin</option>
									<option value='Edo'>Edo</option>
									<option value='Tiv'>Tiv</option>
									<option value='Idoma'>Idoma</option>
									<option value='Edo'>Edo</option>
									<option value='Ijaw'>Ijaw</option>
									<option value='Kanuri'>Kanuri</option>
								</select>
							</div>
						</div>
					</div>
					<br>


					<div class="row">
							<div class="col-lg-12">
									<div class="col-lg-12 col-sm-12 col-xs-12">
									<label style="color: #000">
										Academic qualification
									</label>
								</div>
									<div class="col-lg-6 col-sm-6 col-xs-12">
										<select style="width: 100px" name="qualification">
											<option value=''>qualification</option>
											<option value='olevel'>O’level</option>
											<option value='diploma'>Diploma</option>
											<option value='bachelordegree'>Bachelor’s degree</option>
											<option value='masterdegree'>Masters degree</option>
											<option value='phd'>Ph.D</option>
											<option value='None'>None</option>
										</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-4 col-xs-12">
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
								<label style="color: #000">
									Waist
								</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
									<select class="search_selector" name="waist-min" style="width: 100px">
    <option value="" selected="selected">
        waist    </option>
            <option value="50">50cm / 19.7"</option>
            <option value="51">51cm / 20.1"</option>
            <option value="52">52cm / 20.5"</option>
            <option value="53">53cm / 20.9"</option>
            <option value="54">54cm / 21.3"</option>
            <option value="55">55cm / 21.7"</option>
            <option value="56">56cm / 22.0"</option>
            <option value="57">57cm / 22.4"</option>
            <option value="58">58cm / 22.8"</option>
            <option value="59">59cm / 23.2"</option>
            <option value="60">60cm / 23.6"</option>
            <option value="61">61cm / 24.0"</option>
            <option value="62">62cm / 24.4"</option>
            <option value="63">63cm / 24.8"</option>
            <option value="64">64cm / 25.2"</option>
            <option value="65">65cm / 25.6"</option>
            <option value="66">66cm / 26.0"</option>
            <option value="67">67cm / 26.4"</option>
            <option value="68">68cm / 26.8"</option>
            <option value="69">69cm / 27.2"</option>
            <option value="70">70cm / 27.6"</option>
            <option value="71">71cm / 28.0"</option>
            <option value="72">72cm / 28.3"</option>
            <option value="73">73cm / 28.7"</option>
            <option value="74">74cm / 29.1"</option>
            <option value="75">75cm / 29.5"</option>
            <option value="76">76cm / 29.9"</option>
            <option value="77">77cm / 30.3"</option>
            <option value="78">78cm / 30.7"</option>
            <option value="79">79cm / 31.1"</option>
            <option value="80">80cm / 31.5"</option>
            <option value="81">81cm / 31.9"</option>
            <option value="82">82cm / 32.3"</option>
            <option value="83">83cm / 32.7"</option>
            <option value="84">84cm / 33.1"</option>
            <option value="85">85cm / 33.5"</option>
            <option value="86">86cm / 33.9"</option>
            <option value="87">87cm / 34.3"</option>
            <option value="88">88cm / 34.6"</option>
            <option value="89">89cm / 35.0"</option>
            <option value="90">90cm / 35.4"</option>
            <option value="91">91cm / 35.8"</option>
            <option value="92">92cm / 36.2"</option>
            <option value="93">93cm / 36.6"</option>
            <option value="94">94cm / 37.0"</option>
            <option value="95">95cm / 37.4"</option>
            <option value="96">96cm / 37.8"</option>
            <option value="97">97cm / 38.2"</option>
            <option value="98">98cm / 38.6"</option>
            <option value="99">99cm / 39.0"</option>
            <option value="100">100cm / 39.4"</option>
            <option value="101">101cm / 39.8"</option>
            <option value="102">102cm / 40.2"</option>
            <option value="103">103cm / 40.6"</option>
            <option value="104">104cm / 40.9"</option>
            <option value="105">105cm / 41.3"</option>
            <option value="106">106cm / 41.7"</option>
            <option value="107">107cm / 42.1"</option>
            <option value="108">108cm / 42.5"</option>
            <option value="109">109cm / 42.9"</option>
            <option value="110">110cm / 43.3"</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-xs-12">
								 	to 
								 </div>
								 <div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="waist-max" style="width: 100px">
    <option value="" selected="selected">
        waist    </option>
            <option value="50">50cm / 19.7"</option>
            <option value="51">51cm / 20.1"</option>
            <option value="52">52cm / 20.5"</option>
            <option value="53">53cm / 20.9"</option>
            <option value="54">54cm / 21.3"</option>
            <option value="55">55cm / 21.7"</option>
            <option value="56">56cm / 22.0"</option>
            <option value="57">57cm / 22.4"</option>
            <option value="58">58cm / 22.8"</option>
            <option value="59">59cm / 23.2"</option>
            <option value="60">60cm / 23.6"</option>
            <option value="61">61cm / 24.0"</option>
            <option value="62">62cm / 24.4"</option>
            <option value="63">63cm / 24.8"</option>
            <option value="64">64cm / 25.2"</option>
            <option value="65">65cm / 25.6"</option>
            <option value="66">66cm / 26.0"</option>
            <option value="67">67cm / 26.4"</option>
            <option value="68">68cm / 26.8"</option>
            <option value="69">69cm / 27.2"</option>
            <option value="70">70cm / 27.6"</option>
            <option value="71">71cm / 28.0"</option>
            <option value="72">72cm / 28.3"</option>
            <option value="73">73cm / 28.7"</option>
            <option value="74">74cm / 29.1"</option>
            <option value="75">75cm / 29.5"</option>
            <option value="76">76cm / 29.9"</option>
            <option value="77">77cm / 30.3"</option>
            <option value="78">78cm / 30.7"</option>
            <option value="79">79cm / 31.1"</option>
            <option value="80">80cm / 31.5"</option>
            <option value="81">81cm / 31.9"</option>
            <option value="82">82cm / 32.3"</option>
            <option value="83">83cm / 32.7"</option>
            <option value="84">84cm / 33.1"</option>
            <option value="85">85cm / 33.5"</option>
            <option value="86">86cm / 33.9"</option>
            <option value="87">87cm / 34.3"</option>
            <option value="88">88cm / 34.6"</option>
            <option value="89">89cm / 35.0"</option>
            <option value="90">90cm / 35.4"</option>
            <option value="91">91cm / 35.8"</option>
            <option value="92">92cm / 36.2"</option>
            <option value="93">93cm / 36.6"</option>
            <option value="94">94cm / 37.0"</option>
            <option value="95">95cm / 37.4"</option>
            <option value="96">96cm / 37.8"</option>
            <option value="97">97cm / 38.2"</option>
            <option value="98">98cm / 38.6"</option>
            <option value="99">99cm / 39.0"</option>
            <option value="100">100cm / 39.4"</option>
            <option value="101">101cm / 39.8"</option>
            <option value="102">102cm / 40.2"</option>
            <option value="103">103cm / 40.6"</option>
            <option value="104">104cm / 40.9"</option>
            <option value="105">105cm / 41.3"</option>
            <option value="106">106cm / 41.7"</option>
            <option value="107">107cm / 42.1"</option>
            <option value="108">108cm / 42.5"</option>
            <option value="109">109cm / 42.9"</option>
            <option value="110">110cm / 43.3"</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
								<label style="color: #000">
									Jacket
								</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="jacket-min" style="width: 100px">
    <option value="" selected="selected">
        jacket    </option>
            <option value="42">42 EU, 34 UK, 28 US</option>
            <option value="44">44 EU, 35 UK, 30 US</option>
            <option value="46">46 EU, 36 UK, 32 US</option>
            <option value="48">48 EU, 38 UK, 34 US</option>
            <option value="50">50 EU, 40 UK, 36 US</option>
            <option value="52">52 EU, 42 UK, 38 US</option>
            <option value="54">54 EU, 44 UK, 40 US</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-xs-12">
								 to 
								 </div>
								 <div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="jacket-max" style="width: 100px">
    <option value="" selected="selected">
        jacket    </option>
            <option value="42">42 EU, 34 UK, 28 US</option>
            <option value="44">44 EU, 35 UK, 30 US</option>
            <option value="46">46 EU, 36 UK, 32 US</option>
            <option value="48">48 EU, 38 UK, 34 US</option>
            <option value="50">50 EU, 40 UK, 36 US</option>
            <option value="52">52 EU, 42 UK, 38 US</option>
            <option value="54">54 EU, 44 UK, 40 US</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
								<label style="color: #000">
									Shoes
								</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="shoes-min" style="width: 100px">
    <option value="" selected="selected">
        shoes    </option>
            <option value="225">36 EU,  3 UK, 3 US</option>
            <option value="232">37 EU,  4 UK, 4 US</option>
            <option value="240">38 EU,  5 UK, 5 US</option>
            <option value="247">39 EU,  6 UK, 6 US</option>
            <option value="255">40 EU, 6½ UK, 7 US</option>
            <option value="262">41 EU,  7 UK, 7½ US</option>
            <option value="270">42 EU,  8 UK, 8 US</option>
            <option value="277">43 EU,  9 UK, 9 US</option>
            <option value="285">44 EU, 9½ UK, 10 US</option>
            <option value="292">45 EU, 10 UK, 11 US</option>
            <option value="300">46 EU, 11 UK, 12 US</option>
            <option value="307">47 EU, 12 UK, 13 US</option>
            <option value="315">48 EU, 13 UK, 14 US</option>
            <option value="322">49 EU, 14 UK, 15 US</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-xs-12">
								 to 
								 </div>
								 <div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="shoes-max" style="width: 100%">
    <option value="" selected="selected">
        shoes    </option>
            <option value="225">36 EU,  3 UK, 3 US</option>
            <option value="232">37 EU,  4 UK, 4 US</option>
            <option value="240">38 EU,  5 UK, 5 US</option>
            <option value="247">39 EU,  6 UK, 6 US</option>
            <option value="255">40 EU, 6½ UK, 7 US</option>
            <option value="262">41 EU,  7 UK, 7½ US</option>
            <option value="270">42 EU,  8 UK, 8 US</option>
            <option value="277">43 EU,  9 UK, 9 US</option>
            <option value="285">44 EU, 9½ UK, 10 US</option>
            <option value="292">45 EU, 10 UK, 11 US</option>
            <option value="300">46 EU, 11 UK, 12 US</option>
            <option value="307">47 EU, 12 UK, 13 US</option>
            <option value="315">48 EU, 13 UK, 14 US</option>
            <option value="322">49 EU, 14 UK, 15 US</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<label style="color: #000">
									Ethnicity
								</label>
								</div>

								<div class="col-lg-6 col-sm-6 col-xs-12">
								<label style="color: #000">
									Hair type
								</label>
								</div>

								<div class="col-lg-6 col-sm-6 col-xs-12">
								<select style="width: 100%" name="ethnicity">
									<option value=''>ethnicity</option>
									<option value='Abraka'>Abraka</option>
									<option value='v'>Afemai</option>
									<option value='Afusari'>Afusari</option>
									<option value='Agbassa'>Agbassa</option>
									<option value='AgbonKingdom'>Agbon Kingdom</option>
									<option value='Akunakuna'>Akunakuna</option>
									<option value='Anaang'>Anaang</option>
									<option value='Anga'>Anga</option>
									<option value='AnloEwe'>Anlo Ewe</option>
									<option value='Anwain'>Anwain</option>
									<option value='Aro'>Aro</option>
									<option value='AsianNigerian'>Asian Nigerian</option>
									<option value='Atyap'>Atyap</option>
									<option value='Bali'>Bali</option>
									<option value='Bariba'>Bariba</option>
									<option value='Berom'>Berom</option>
									<option value='Bete'>Bete</option>
									<option value='Buduma'>Buduma</option>
									<option value='Chamba'>Chamba</option>
									<option value='Dendi'>Dendi</option>
									<option value='Ebira'>Ebira</option>
									<option value='Edda'>Edda</option>
									<option value='Efik'>Efik</option>
									<option value='Eket'>Eket</option>
									<option value='Ekoi'>Ekoi</option>
									<option value='Emai'>Emai</option>
									<option value='Esan'>Esan</option>
									<option value='Etsakor'>Etsakor</option>
									<option value='Ewe'>Ewe</option>
									<option value='Fali'>Fali</option>
									<option value='Fon'>Fon</option>
									<option value='Fula'>Fula</option>
									<option value='Gbagyi'>Gbagyi</option>
									<option value='Gokana'>Gokana kingdom</option>
									<option value='Hausa'>Hausa</option>
									<option value='Hausa–Fulani'>Hausa–Fulani</option>
									<option value='Ibibio'>Ibibio</option>
									<option value='Idoma'>Idoma</option>
									<option value='Igala'>Igala</option>
									<option value='Igbo'>Igbo</option>
									<option value='Igede'>Igede</option>
									<option value='Igue'>Igue</option>
									<option value='Ijigban'>Ijigban</option>
									<option value='Ijaw'>Ijaw</option>
									<option value='Ikpide'>Ikpide</option>
									<option value='Isoko'>Isoko</option>
									<option value='Isu'>Isu</option>
									<option value='Itsekiri'>Itsekiri</option>
									<option value='Iwellemmedan'>Iwellemmedan</option>
									<option value='Jobawa'>Jobawa</option>
									<option value='Jukun'>Jukun</option>
									<option value='Kamuku'>Kamuku</option>
									<option value='Kanuri'>Kanuri</option>
									<option value='kalabari'>kalabari</option>
									<option value='Kele'>Kele</option>
									<option value='Kilba'>Kilba</option>
									<option value='Kirdi'>Kirdi</option>
									<option value='Kofyar'>Kofyar</option>
									<option value='Koma'>Koma</option>
									<option value='Kotoko'>Kotoko</option>
									<option value='Kurtey'>Kurtey</option>
									<option value='Kuteb'>Kuteb</option>
									<option value='Longuda'>Longuda</option>
									<option value='Mafa'>Mafa</option>
									<option value='MaguzawaHausa'>Maguzawa Hausa</option>
									<option value='Mambila'>Mambila</option>
									<option value='Mumuye'>Mumuye</option>
									<option value='Ngizim'>Ngizim</option>
									<option value='Nupe'>Nupe</option>
									<option value='OfoinIgboland'>Ofo in Igboland</option>
									<option value='Ogoni'>Ogoni</option>
									<option value='Ogugu'>Ogugu</option>
									<option value='Oron'>Oron</option>
									<option value='Saro'>Saro</option>
									<option value='Tarok'>Tarok</option>
									<option value='Tiv'>Tiv</option>
									<option value='Tuareg'>Tuareg</option>
									<option value='Umuoji'>Umuoji</option>
									<option value='Urhobo'>Urhobo</option>
									<option value='Wodaabe'>Wodaabe</option>
									<option value='YerwaKanuri'>Yerwa Kanuri</option>
									<option value='Yoruba'>Yoruba</option>
									<option value='Zarma'>Zarma</option>
								</select>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
								<select style="width: 100%" name="Hair_type">
									<option value=''>Hair type</option>
									<option value='skincut'>skin cut</option>
									<option value='lowcut'>low cut</option>
									<option value='afro'>Afro (virgin hair)</option>
									<option value='relaxedshort'>Relaxed hair (short)</option>
									<option value='relaxedlong'>Relaxed hair (long)</option>
                                    <option value='dreadlocks'>Dreadlocks</option>
								</select>
								</div>

							</div>
						</div>
                                    <div class="row">
                                    <br>
                                          <div class="col-lg-12 col-sm-12 col-xs-12">
                                                      <div class="col-lg-12 col-sm-12 col-xs-12">
                                                      <label style="color: #000">
                                                            filter models image by categories
                                                      </label>
                                                </div>
                                                      <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <select class="form-control" style="width: 100%" name="imagecat">
                                                                  <option value="">all categories</option>
                                                                  @foreach($categories as $cat)
                                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                                  @endforeach
                                                            </select>
                                                </div>
                                          </div>
                                    </div>
					</div>
					<div class="col-lg-4 col-sm-4 col-xs-12">
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
								<label style="color: #000">
									Hips
								</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="hips-min" style="width: 100px">
    <option value="" selected="selected">
        hips    </option>
            <option value="65">65cm / 25.6"</option>
            <option value="66">66cm / 26.0"</option>
            <option value="67">67cm / 26.4"</option>
            <option value="68">68cm / 26.8"</option>
            <option value="69">69cm / 27.2"</option>
            <option value="70">70cm / 27.6"</option>
            <option value="71">71cm / 28.0"</option>
            <option value="72">72cm / 28.3"</option>
            <option value="73">73cm / 28.7"</option>
            <option value="74">74cm / 29.1"</option>
            <option value="75">75cm / 29.5"</option>
            <option value="76">76cm / 29.9"</option>
            <option value="77">77cm / 30.3"</option>
            <option value="78">78cm / 30.7"</option>
            <option value="79">79cm / 31.1"</option>
            <option value="80">80cm / 31.5"</option>
            <option value="81">81cm / 31.9"</option>
            <option value="82">82cm / 32.3"</option>
            <option value="83">83cm / 32.7"</option>
            <option value="84">84cm / 33.1"</option>
            <option value="85">85cm / 33.5"</option>
            <option value="86">86cm / 33.9"</option>
            <option value="87">87cm / 34.3"</option>
            <option value="88">88cm / 34.6"</option>
            <option value="89">89cm / 35.0"</option>
            <option value="90">90cm / 35.4"</option>
            <option value="91">91cm / 35.8"</option>
            <option value="92">92cm / 36.2"</option>
            <option value="93">93cm / 36.6"</option>
            <option value="94">94cm / 37.0"</option>
            <option value="95">95cm / 37.4"</option>
            <option value="96">96cm / 37.8"</option>
            <option value="97">97cm / 38.2"</option>
            <option value="98">98cm / 38.6"</option>
            <option value="99">99cm / 39.0"</option>
            <option value="100">100cm / 39.4"</option>
            <option value="101">101cm / 39.8"</option>
            <option value="102">102cm / 40.2"</option>
            <option value="103">103cm / 40.6"</option>
            <option value="104">104cm / 40.9"</option>
            <option value="105">105cm / 41.3"</option>
            <option value="106">106cm / 41.7"</option>
            <option value="107">107cm / 42.1"</option>
            <option value="108">108cm / 42.5"</option>
            <option value="109">109cm / 42.9"</option>
            <option value="110">110cm / 43.3"</option>
            <option value="111">111cm / 43.7"</option>
            <option value="112">112cm / 44.1"</option>
            <option value="113">113cm / 44.5"</option>
            <option value="114">114cm / 44.9"</option>
            <option value="115">115cm / 45.3"</option>
            <option value="116">116cm / 45.7"</option>
            <option value="117">117cm / 46.1"</option>
            <option value="118">118cm / 46.5"</option>
            <option value="119">119cm / 46.9"</option>
            <option value="120">120cm / 47.2"</option>
            <option value="121">121cm / 47.6"</option>
            <option value="122">122cm / 48.0"</option>
            <option value="123">123cm / 48.4"</option>
            <option value="124">124cm / 48.8"</option>
            <option value="125">125cm / 49.2"</option>
            <option value="126">126cm / 49.6"</option>
            <option value="127">127cm / 50.0"</option>
            <option value="128">128cm / 50.4"</option>
            <option value="129">129cm / 50.8"</option>
            <option value="130">130cm / 51.2"</option>
            <option value="131">131cm / 51.6"</option>
            <option value="132">132cm / 52.0"</option>
            <option value="133">133cm / 52.4"</option>
            <option value="134">134cm / 52.8"</option>
            <option value="135">135cm / 53.1"</option>
            <option value="136">136cm / 53.5"</option>
            <option value="137">137cm / 53.9"</option>
            <option value="138">138cm / 54.3"</option>
            <option value="139">139cm / 54.7"</option>
            <option value="140">140cm / 55.1"</option>
            <option value="141">141cm / 55.5"</option>
            <option value="142">142cm / 55.9"</option>
            <option value="143">143cm / 56.3"</option>
            <option value="144">144cm / 56.7"</option>
            <option value="145">145cm / 57.1"</option>
            <option value="146">146cm / 57.5"</option>
            <option value="147">147cm / 57.9"</option>
            <option value="148">148cm / 58.3"</option>
            <option value="149">149cm / 58.7"</option>
            <option value="150">150cm / 59.1"</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-xs-12">
								 to 
								 </div>
								 <div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="hips-max">
    <option value="" selected="selected">
        hips    </option>
            <option value="65">65cm / 25.6"</option>
            <option value="66">66cm / 26.0"</option>
            <option value="67">67cm / 26.4"</option>
            <option value="68">68cm / 26.8"</option>
            <option value="69">69cm / 27.2"</option>
            <option value="70">70cm / 27.6"</option>
            <option value="71">71cm / 28.0"</option>
            <option value="72">72cm / 28.3"</option>
            <option value="73">73cm / 28.7"</option>
            <option value="74">74cm / 29.1"</option>
            <option value="75">75cm / 29.5"</option>
            <option value="76">76cm / 29.9"</option>
            <option value="77">77cm / 30.3"</option>
            <option value="78">78cm / 30.7"</option>
            <option value="79">79cm / 31.1"</option>
            <option value="80">80cm / 31.5"</option>
            <option value="81">81cm / 31.9"</option>
            <option value="82">82cm / 32.3"</option>
            <option value="83">83cm / 32.7"</option>
            <option value="84">84cm / 33.1"</option>
            <option value="85">85cm / 33.5"</option>
            <option value="86">86cm / 33.9"</option>
            <option value="87">87cm / 34.3"</option>
            <option value="88">88cm / 34.6"</option>
            <option value="89">89cm / 35.0"</option>
            <option value="90">90cm / 35.4"</option>
            <option value="91">91cm / 35.8"</option>
            <option value="92">92cm / 36.2"</option>
            <option value="93">93cm / 36.6"</option>
            <option value="94">94cm / 37.0"</option>
            <option value="95">95cm / 37.4"</option>
            <option value="96">96cm / 37.8"</option>
            <option value="97">97cm / 38.2"</option>
            <option value="98">98cm / 38.6"</option>
            <option value="99">99cm / 39.0"</option>
            <option value="100">100cm / 39.4"</option>
            <option value="101">101cm / 39.8"</option>
            <option value="102">102cm / 40.2"</option>
            <option value="103">103cm / 40.6"</option>
            <option value="104">104cm / 40.9"</option>
            <option value="105">105cm / 41.3"</option>
            <option value="106">106cm / 41.7"</option>
            <option value="107">107cm / 42.1"</option>
            <option value="108">108cm / 42.5"</option>
            <option value="109">109cm / 42.9"</option>
            <option value="110">110cm / 43.3"</option>
            <option value="111">111cm / 43.7"</option>
            <option value="112">112cm / 44.1"</option>
            <option value="113">113cm / 44.5"</option>
            <option value="114">114cm / 44.9"</option>
            <option value="115">115cm / 45.3"</option>
            <option value="116">116cm / 45.7"</option>
            <option value="117">117cm / 46.1"</option>
            <option value="118">118cm / 46.5"</option>
            <option value="119">119cm / 46.9"</option>
            <option value="120">120cm / 47.2"</option>
            <option value="121">121cm / 47.6"</option>
            <option value="122">122cm / 48.0"</option>
            <option value="123">123cm / 48.4"</option>
            <option value="124">124cm / 48.8"</option>
            <option value="125">125cm / 49.2"</option>
            <option value="126">126cm / 49.6"</option>
            <option value="127">127cm / 50.0"</option>
            <option value="128">128cm / 50.4"</option>
            <option value="129">129cm / 50.8"</option>
            <option value="130">130cm / 51.2"</option>
            <option value="131">131cm / 51.6"</option>
            <option value="132">132cm / 52.0"</option>
            <option value="133">133cm / 52.4"</option>
            <option value="134">134cm / 52.8"</option>
            <option value="135">135cm / 53.1"</option>
            <option value="136">136cm / 53.5"</option>
            <option value="137">137cm / 53.9"</option>
            <option value="138">138cm / 54.3"</option>
            <option value="139">139cm / 54.7"</option>
            <option value="140">140cm / 55.1"</option>
            <option value="141">141cm / 55.5"</option>
            <option value="142">142cm / 55.9"</option>
            <option value="143">143cm / 56.3"</option>
            <option value="144">144cm / 56.7"</option>
            <option value="145">145cm / 57.1"</option>
            <option value="146">146cm / 57.5"</option>
            <option value="147">147cm / 57.9"</option>
            <option value="148">148cm / 58.3"</option>
            <option value="149">149cm / 58.7"</option>
            <option value="150">150cm / 59.1"</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
								<label style="color: #000">
									Trousers
								</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="trousers-min" style="width: 100%">
    <option value="" selected="selected">
        trousers    </option>
            <option value="38">38 EU, 38 UK, 28 US</option>
            <option value="40">40 EU, 40 UK, 30 US</option>
            <option value="42">42 EU, 42 UK, 32 US</option>
            <option value="44">44 EU, 44 UK, 34 US</option>
            <option value="46">46 EU, 46 UK, 36 US</option>
            <option value="48">48 EU, 48 UK, 38 US</option>
            <option value="50">50 EU, 52 UK, 40 US</option>
            <option value="52">52 EU, 54 UK, 42 US</option>
            <option value="54">54 EU, 56 UK, 44 US</option>
    </select>
								</div>
								<div class="col-lg-1 col-sm-1 col-xs-12">
								 to 
								 </div>
								 <div class="col-lg-5 col-sm-5 col-xs-12">
								<select class="search_selector" name="trousers-max" style="width: 100%">
    <option value="" selected="selected">
        trousers    </option>
            <option value="38">38 EU, 38 UK, 28 US</option>
            <option value="40">40 EU, 40 UK, 30 US</option>
            <option value="42">42 EU, 42 UK, 32 US</option>
            <option value="44">44 EU, 44 UK, 34 US</option>
            <option value="46">46 EU, 46 UK, 36 US</option>
            <option value="48">48 EU, 48 UK, 38 US</option>
            <option value="50">50 EU, 52 UK, 40 US</option>
            <option value="52">52 EU, 54 UK, 42 US</option>
            <option value="54">54 EU, 56 UK, 44 US</option>
    </select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<label style="color: #000">
									Eyes
								</label>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<label style="color: #000">
									Complexion
								</label>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<select style="width: 100%" name="eyes">
									<option value="">Eyes</option>
									<option value='black'>Black</option>
									<option value='blue'>Blue</option>
									<option value='brown'>Brown</option>
									<option value='darkbrown'>Dark Brown</option>
									<option value='green'>Green</option>
									<option value='gray'>Gray</option>
									<option value='hazel'>Hazel</option>
									<option value='lightblue'>Light Blue</option>
									<option value='lightbrown'>Light Brown</option>
								</select>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<select style="width: 100%" name="complexion">
									<option value=''>Complexion</option>
									<option value='lightskin'>Light skinned</option>
									<option value='lightbrown'>Light brown-skin</option>
									<option value='brown-skin'>Brown-skin</option>
									<option value='dark-brown'>Dark brown-skin</option>
									<option value='darkskin'>Dark skin</option>
								</select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="col-lg-12 col-sm-12 col-xs-12">
								<label style="color: #000">
									Butt type
								</label>
								</div>
								<div class="col-lg-5 col-sm-5 col-xs-12">
								<select style="width: 100%" name="butt">
									<option value=''>Butt type</option>
									<option value='inverted'>Inverted “V” shape</option>
									<option value='squared'>Square shape</option>
									<option value='round'>Round shape</option>
									<option value='heart'>Heart shape</option>
								</select>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
      <br>
      <div class="col-lg-12">
	<div id="data">
      <div class="col-lg-12">

            <div class="row">
                  <div class="col-lg-12">
                        <div class="row">
                              <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h5 style="border-bottom: 1px solid #000; padding-bottom: 3px; width: auto"><span style="background-color: #000; color: #fff; padding: 3px;">Afrodaisy Premium Models</span><span class="text-right dash-span"></span></h5>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
                                      <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                          <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                          <div style="position:absolute;display:block;background:url('/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                      </div>
                                      <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden;">
                                    {{$getpaidusers}}
                                    </div>
                                    </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <br>
            <div class="row">
                  <div class="col-lg-6">
                        <div class="row">
                              <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h5 style="border-bottom: 1px solid #000; padding-bottom: 3px; width: auto"><span style="background-color: #000; color: #fff; padding: 3px;">Model</span><span class="text-right dash-span"></span></h5>
                                    </div>
                                    </div>
                                    <div class="row">
                                          {{$viewfashion}}
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="col-lg-6">
                              <div class="row">
                              <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h5 style="border-bottom: 1px solid #000; padding-bottom: 3px; width: auto"><span style="background-color: #000; color: #fff; padding: 3px;">Face Model</span><span class="text-right dash-span"></span></h5>
                                    </div>
                                    </div>
                                    <div class="row">
                                          {{$viewhighfashion}}
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <br>
            <div class="row">
                  <div class="col-lg-6">
                              <div class="row">
                              <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h5 style="border-bottom: 1px solid #000; padding-bottom: 3px; width: auto"><span style="background-color: #000; color: #fff; padding: 3px;">Actors</span><span class="text-right dash-span"></span></h5>
                                    </div>
                                    </div>
                                    <div class="row">
                                          {{$actors}}
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="col-lg-6">
                        <div class="row">
                              <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h5 style="border-bottom: 1px solid #000; padding-bottom: 3px; width: auto"><span style="background-color: #000; color: #fff; padding: 3px;">Ushers</span><span class="text-right dash-span"></span></h5>
                                    </div>
                                    </div>
                                    <div class="row">
                                    {{$viewreallife}}
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <br>
            <div class="row">
                  <div class="col-lg-6">
                        <div class="row">
                              <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h5 style="border-bottom: 1px solid #000; padding-bottom: 3px; width: auto"><span style="background-color: #000; color: #fff; padding: 3px;">Runway</span><span class="text-right dash-span"></span></h5>
                                    </div>
                                    </div>
                                    <div class="row">
                                    {{$viewsenior}}
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="col-lg-6">
                              <div class="row">
                              <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h5 style="border-bottom: 1px solid #000; padding-bottom: 3px; width: auto"><span style="background-color: #000; color: #fff; padding: 3px;">Swimsuit/Bikini</span><span class="text-right dash-span"></span></h5>
                                    </div>
                                    </div>
                                    <div class="row">
                                          {{$viewplussized}}
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
	</div>
</div>
</div>
@stop
@section('script')
{{ HTML::script('js/user.js') }}
{{ HTML::script('js/modelNotify.js') }}
@stop