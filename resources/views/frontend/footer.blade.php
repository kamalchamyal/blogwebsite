<footer class="footer_section section_wrapper section_wrapper" >
	<div class="footer_top_section">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="text_widget footer_widget">
					<div class="footer_widget_title"><h2>About Sports Mag</h2></div>

		         	<div class="footer_widget_content">Collaborativelyadministrate empowered marketsplug-and-play networks. Dynamic procrastinate after.marketsplug-and-play networks. Dynamic procrastinate users after. Dynamic procrastinateafter. marketsplug-and-play networks. Dynamic procrastinate users after...
					</div>
					</div><!--text_widget-->
				</div><!--col-xs-3-->

				<div class="col-md-6">
					<div class="footer_widget">
                        <div class="footer_widget_title"><h2>Discover</h2></div>
					    <div class="footer_menu_item ">
						<div class="row">
							<div class="col-sm-4">
								<ul class="nav navbar-nav ">
                                    @foreach ($category as $c)
									<li><a href="{{URL::to($c->c_slug)}}">{{$c->c_name}}</a></li>
                                    @endforeach
								</ul>
						    </div><!--col-sm-4-->
					        <div class="col-sm-4 ">
								<ul class="nav navbar-nav  ">
									<li><a href="{{route('Contactus')}}">Contact Us</a></li>
									<li><a href="../navbar-static-top/">MembershipContact us</a></li>
									<li><a href="./">Newsletter Alerts</a></li>
									<li><a href="../navbar/">Podcast</a></li>
									<li><a href="../navbar/">Blog</a></li>
									<li><a href="../navbar-static-top/">SMS Subscription</a></li>
									<li><a href="./">Advertisement Policy</a></li>
									<li><a href="../navbar/">Jobs</a></li>
								</ul>
					        </div><!--col-sm-4-->
					        <div class="col-sm-4">
								<ul class="nav navbar-nav ">
									<li><a href="../navbar/">Report technical issue</a></li>
									<li><a href="../navbar-static-top/">Complaints & Corrections</a></li>
									<li><a href="./">Terms & Conditions</a></li>
									<li><a href="../navbar-static-top/">Privacy Policy</a></li>
									<li><a href="./">Cookie Policy</a></li>
									<li><a href="../navbar/">Securedrop</a></li>
									<li><a href="../navbar/">Archives</a></li>
								</ul>
					        </div><!--col-sm-4-->
				      	</div><!--row-->
			      	</div><!--footer_menu_item-->
                    </div><!--footer_widget-->
				</div><!--col-xs-6-->

				<div class="col-md-3">
 					<div class="text_widget footer_widget">
						<div class="footer_widget_title"><h2>Editor’s Message</h2></div>
						<img src="assets/img/img-author.jpg" />
						<div class="footer_widget_content">Collaborativelyadministrate empowered marketsplug-and-play networks. Dynamic procrastinate after.marketsplug-and-play networks. Dynamic procrastinate users after. Dynamic procrastinateafter. marketsplug-and-play networks. Dynamic procrastinate users after...</div>
					</div>
				</div><!--col-xs-3-->
			</div><!--row-->
		</div><!--container-->
	</div><!--footer_top_section-->
	<a href="#" class="crunchify-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>

	<div class="copyright-section">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
							Editor: Joshep guinter Grunt
					</div><!--col-xs-3-->
					<div class="col-md-6">
						<div class="copyright">
						© Copyright 2015 - Sports News Mag.com. Design by: <a href="https://uiCookies.com" title="uiCookies">uiCookies</a>
						</div>
					</div><!--col-xs-6-->
					<div class="col-md-3">
						Sports News Magazine
					</div><!--col-xs-3-->
				</div><!--row-->
			</div><!--container-->
		</div><!--copyright-section-->
</footer>
