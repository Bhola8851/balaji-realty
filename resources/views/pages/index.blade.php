@extends('layouts.app')

@section('content')

       <div class="ro">
            <!--<div id="imageCarousel" class="carousel slide carousel-fade col-md-12" data-wrap="true" data-pause="false" data-interval="2000">
                <ol class="carousel-indicators">
                    <li data-target="#imageCarousal" data-slide-to="0" class="active"></li>
                    <li data-target="#imageCarousal" data-slide-to="1"></li>

                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="/images/img-1.jpg" class="img-responsive" />
                        <div class="carousel-caption fadeInDown">Winter Bungalow</div>
                    </div>
                    <div class="item">
                        <img src="/images/img-2.jpg" class="img-responsive" />
                        <div class="carousel-caption">

                        </div>
                    </div>
                </div>
                <a href="#imageCarousel" class="carousel-control left" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a href="#imageCarousel" class="carousel-control right" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>-->
            <div  class="carousel fade-carousel carousel-fade slide" data-ride="carousel" data-interval="3000" id="bs-carousel">

                    <div class="overly"></div>
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
                      <li data-target="#bs-carousel" data-slide-to="1"></li>
                      <li data-target="#bs-carousel" data-slide-to="2"></li>
                    </ol>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active item slides">
                            <div class="slide-1"></div>
                            <div class="hero">
                                <hgroup>
                                    <h1>We are creative</h1>
                                    <h3>Get start your next awesome project</h3>
                                </hgroup>
                                <a class="btn btn-hero btn-lg" href={{'/project'}}>See More</a>
                            </div>
                        </div>

                        <div class="carousel-item item slides">
                            <div class="slide-2"></div>
                            <div class="hero">
                                <hgroup>
                                    <h1>We are smart</h1>
                                    <h3>Get start your next awesome project</h3>
                                </hgroup>
                                <a class="btn btn-hero btn-lg" href={{'/project'}}>See More</a>
                            </div>
                        </div>
                        <div class="carousel-item item slides">
                            <div class="slide-3"></div>
                            <div class="hero">
                                <hgroup>
                                    <h1>We are amazing</h1>
                                    <h3>Get start your next awesome project</h3>
                                </hgroup>
                                <a class="btn btn-hero btn-lg" href={{'/project'}}>See More</a>
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#bs-carousel" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#bs-carousel" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
            </div>

        </div>

    <div class="container">
        <!-- Who we are -->
        <br />

            <div class="row">
                <div class="col-md-6">

                    <div class="hvrbox">
                        <img src="/images/img_bg_2.jpg" alt="Mountains" class="img hvrbox-layer_bottom img-responsive">
                        <div class="hvrbox-layer_top">
                            <div class="hvrbox-text">Click for more Projects<br/><a type="button" href="/project" class="btn btn-default" id="image_button">See More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="">
                    <div>
                        <span class="page-header">Welcome</span>
                        <h2 class="">Who we are</h2>
                        <p><b>BALAJI REALTY PRIVATE LIMITED </b> is a direct selling business that offers a comprehensive range of lifestyle products directly to the consumers. We are aiming fulfills the dream of every individual associated with us. Our network of registered distributors and consumers gets special benefits and opportunities due to our increasing dominance in the direct selling industry of our country.</p>
                        <p>We operate through a streamlined procedure where our registered distributors introduce new customers to the company and get them registered in the customer network. By doing so, they not only gain monetary benefits by selling products, but also become entitled to various other income opportunities </p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 no-gutters animate-box">
                            <a href="#" class="steps active">
                                <p class="glyphicon glyphicon-check"><span><i class=""></i></span></p>
                                <h4>We are <br>pasionate</h4>
                            </a>
                        </div>
                        <div class="col-md-4 no-gutters animate-box">
                            <a href="#" class="steps">
                                <p class="glyphicon glyphicon-check"><span><i class=""></i></span></p>
                                <h4>Honest <br>Dependable</h4>
                            </a>
                        </div>
                        <div class="col-md-4 no-gutters animate-box">
                            <a href="#" class="steps">
                                <p class="glyphicon glyphicon-check"><span><i class=""></i></span></p>
                                <h4>Always <br>Improving</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br />

            <!-- What I do -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header panel-title" id="panel-heading">
                            <span class="panel-heading">What We do?</span>
                            <h2 class="h2">Here are some of our expertise</h2>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div id="text-left">
                                            <h3><span><i class="fab fa-acquisitions-incorporated"></i></span> General Construction</h3>
                                            <p>we make a building that fits your desires </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="text-left">
                                            <h3><span><i class="fas fa-door-open"></i></span> Bunglows</h3>
                                            <p>we build bunglows that you desire </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="text-left">
                                            <h3><span class="glyphicon glyphicon-adjust"></span> Land Dealing</h3>
                                            <p>the land you want are available at best location or you</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="text-left">

                                            <h3><i class="fas fa-city"></i> Houses &amp; Gala </h3>
                                            <p>we make the houses and shop galas for you at decent ocation. </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="right-image1 " class="col-md-12">

                                                <div class="hvrbox modelImage">
                                                    <img src="/images/bg_3.jpg" alt="Construction"  class="img hvrbox-layer_bottom img-responsive img-fluid what">
                                                    <div class="hvrbox-layer_top">
                                                        <div class="hvrbox-text">View More<br/><a type="button" href="/about_us" class="btn btn-default" id="image_button">See More</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="right-image1" class="col-md-12">
                                                <div class="hvrbox modelImage">
                                                    <img src="/images/Bungalow.jpg"  alt="Bungalow" class="img hvrbox-layer_bottom img-responsive img-fluid what">
                                                    <div class="hvrbox-layer_top">
                                                        <div class="hvrbox-text">View More<br/><a type="button" href="/about_us" class="btn btn-default" id="image_button">See More</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div id="right-image1" class="col-md-12">
                                                <div class="hvrbox modelImage ">
                                                    <img src="/images/land.jpg" alt="land"  class="img hvrbox-layer_bottom img-responsive img-fluid what">
                                                    <div class="hvrbox-layer_top">
                                                        <div class="hvrbox-text">View More<br/><a type="button" class="btn btn-default" id="image_button">See More</a></div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>

                                        <div class="col-md-6">
                                            <div id="right-image2">
                                                <div class="hvrbox modelImage img-fluid">
                                                    <img src="/images/blog-1.jpg" alt="blog-1"  class="img hvrbox-layer_bottom img-responsive img-fluid what">
                                                    <div class="hvrbox-layer_top">
                                                        <div class="hvrbox-text">View More<br/><a type="button" href="/about_us" class="btn btn-default" id="image_button">See More</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="right-image1">
                                                <div class="hvrbox modelImage img-fluid">
                                                    <img src="/images/blog-2.jpg" alt="blog-2"  class="img hvrbox-layer_bottom img-responsive img-fluid what">
                                                    <div class="hvrbox-layer_top">
                                                        <div class="hvrbox-text">View More<br/><a type="button" href="/about_us" class="btn btn-default" id="image_button">See More</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div id="right-image1">
                                                <div class="hvrbox modelImage img-fluid">
                                                    <img src="/images/blog-3.jpg" alt="blog-3" class="img hvrbox-layer_bottom img-responsive img-fluid what">
                                                    <div class="hvrbox-layer_top">
                                                        <div class="hvrbox-text">View More<br/><a type="button" class="btn btn-default" id="image_button">See More</a></div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Counters -->
            <div style="background-image: url(/images/cover_bg_1.jpg)">
                <div class="row">


                        <div class="col-md-4">
                            <div class="card" id="panel">
                                <div class="card-body" id="counter-card-body">
                                    <img src="/images/blog-1.jpg" class=" rounded-circle card-img-top img-fluid" />
                                </div>
                                <div class="card-footer" id="counter-footer"><h3>Projects</h3></div>
                                <div class="card-footer" id="counter-footer"><h3><span class="label label-info">100</span></h3></div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card " id="panel">
                                <div class="card-body" id="counter-card-body">
                                    <img src="/images/blog-2.jpg" class="card-img-top img-fluid  rounded-circle" />
                                </div>
                                <div class="card-footer" id="counter-footer"><h3>Partners</h3></div>
                                <div class="card-footer" id="counter-footer"><h3><span class="label label-info">2</span></h3></div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card " id="panel">
                                <div class="card-body" id="counter-card-body">
                                    <img src="/images/blog-4.jpg" class="card-img-top img-fluid rounded-circle" />
                                </div>
                                <div class="card-footer" id="counter-footer"><h3>Employees</h3></div>
                                <div class="card-footer" id="counter-footer"><h3><span class="label label-info">30</span></h3></div>

                            </div>
                        </div>



                </div>
            </div>
            <br />
            <!-- Recent Works -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="panel">
                        <div class="card-header" id="panel-heading">
                            <span class="panel-heading">My Work</span>
                            <h2>RECENT Work</h2>
                        </div>
                        <div class="card-body" id="panel">
                            <br/>
                            <div class="row" id="div">

                                <div class="col-md-4"  >
                                    <div class="card" id="panel" >
                                        <div class="hvrbox">
                                            <img class="card-img-top img-fluid hvrbox-layer_bottom img-responsive" src="/images/RecentBuilding.jpg" alt="Card image cap">
                                            <div class="hvrbox-layer_top">
                                                <div class="hvrbox-text">Click for more Building Projects<br/><a type="button" href="flat" class="btn btn-default" id="image_button">See More</a></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Flats</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="flat" class="btn btn-primary">view more</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card" id="panel">
                                        <div class="hvrbox">
                                            <img class="card-img-top img-fluid hvrbox-layer_bottom img-responsive" src="/images/RecentHouse.jpg" alt="Card image cap">
                                            <div class="hvrbox-layer_top">
                                                <div class="hvrbox-text">Click for more House Projects<br/><a type="button" href="house" class="btn btn-default" id="image_button">See More</a></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Houses</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="house" class="btn btn-primary">view more</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card" id="panel">
                                        <div class="hvrbox">
                                            <img class="card-img-top img-fluid hvrbox-layer_bottom img-responsive" src="/images/RecentBungalow.jpg" alt="Card image cap">
                                            <div class="hvrbox-layer_top">
                                                <div class="hvrbox-text">Click for more Bungalow Projects<br/><a type="button" href="bungalow" class="btn btn-default" id="image_button">See More</a></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Bungalow</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="bungalow" class="btn btn-primary">view more</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <br/>
                            <br/>
                            <div class="row" id="div">
                                <div class="col-md-4">
                                    <div class="card" id="panel">
                                        <div class="hvrbox" >
                                            <img class="card-img-top hvrbox-layer_bottom img-responsive" src="/images/RecentLand.jpeg" alt="Card image cap">
                                            <div class="hvrbox-layer_top">
                                                <div class="hvrbox-text">Click for more Land Projects<br/><a type="button" href="land" class="btn btn-default" id="image_button">See More</a></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Land</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="land" class="btn btn-primary">view more</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card" id="panel">
                                        <div class="hvrbox">
                                        <img class="card-img-top hvrbox-layer_bottom img-responsive" src="/images/services-4.jpg" alt="Card image cap">
                                        <div class="hvrbox-layer_top">
                                            <div class="hvrbox-text">Click for more Projects<br/><a type="button" href="/project" class="btn btn-default" id="image_button">See More</a></div>
                                        </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Property</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="/project" class="btn btn-primary">view more</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card" id="panel">
                                        <div class="hvrbox">
                                        <img class="card-img-top hvrbox-layer_bottom img-responsive" src="/images/services-5.jpg" alt="Card image cap">
                                        <div class="hvrbox-layer_top">
                                            <div class="hvrbox-text">Click for more Projects<br/><a type="button" href="/project" class="btn btn-default" id="image_button">See More</a></div>
                                        </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">See More</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="/project" class="btn btn-primary">view more</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection
