<header>
    <div class="container">
         <div class="top_ber">
            <div class="row">
                <div class="col-md-6">
                    <div class="top_ber_left">
                        {{ $currentDateTime }}
                    </div><!--top_ber_left-->
                </div><!--col-md-6-->
                {{-- <div class="col-md-6">
                    <div class="top_ber_right">
                        <div class="top-menu">
                            <ul class="nav navbar-nav">
                                <li><a href="#">Login</a></li>
                                <li><a href="#">Register</a></li>
                            </ul>
                        </div><!--top-menu-->
                    </div><!--top_ber_left-->
                </div><!--col-md-6--> --}}
            </div><!--row-->
         </div><!--top_ber-->

         <div class="header-section">
            <div class="row">
                 <div class="col-md-3">
                    <div class="logo">
                    <a  href="{{route('show')}}"><img class="img-responsive" src="{{url('frontend/assets/img/baa.png')}}" alt=""></a>
                    </div><!--logo-->
                 </div><!--col-md-3-->

                 <div class="col-md-6">
                    <div class="header_ad_banner">
                    <a  href="#"><img class="img-responsive" src="{{url('frontend/assets/img/img_ad.jpg')}}" alt=""></a>
                    </div>
                 </div><!--col-md-6-->

                 <div class="col-md-3">
                    <div class="social_icon1">
                            <a class="icons-sm fb-ic"><i class="fa fa-facebook"></i></a>
                            <!--Twitter-->
                            <a class="icons-sm tw-ic"><i class="fa fa-twitter"></i></a>
                            <!--Google +-->
                            <a class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a>
                            <!--Linkedin-->
                            <a class="icons-sm li-ic"><i class="fa fa-linkedin"> </i></a>
                            <!--Pinterest-->
                            <a class="icons-sm pin-ic"><i class="fa fa-pinterest"> </i></a>
                    </div> <!--social_icon1-->
                 </div><!--col-md-3-->
            </div> <!--row-->
         </div><!--header-section-->
    </div><!-- /.container -->

    <nav class="navbar main-menu navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="offcanvas">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse sidebar-offcanvas">
            <ul class="nav navbar-nav">
                <li class="hidden"><a href="#page-top"></a></li>

{{-- @php


                $categori = DB::table('categories')->orderByDESC('id')

                ->get();@endphp --}}
                    @foreach ($category as  $c)




                <li><a class="page-scroll" href="{{URL::to($c->c_slug)}}">{{$c->c_name}}</a></li>
                {{-- <li><a class="page-scroll" href="category.html">Football</a></li>
                <li><a class="page-scroll" href="category.html">Hockey</a></li>
                <li><a class="page-scroll" href="category.html">Basketball</a></li>
                <li><a class="page-scroll" href="category.html">Boxing</a></li>
                <li><a class="page-scroll" href="category.html">Golf</a></li>
                <li><a class="page-scroll" href="category.html">Tennis</a></li>
                <li><a class="page-scroll" href="category.html">Horse racing</a></li>
                <li><a class="page-scroll" href="category.html">Track & Field</a></li> --}}
                @endforeach

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <div class="pull-right">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input class="form-control" placeholder="Search" name="q" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </nav>
    <!-- .navbar -->
</header>
