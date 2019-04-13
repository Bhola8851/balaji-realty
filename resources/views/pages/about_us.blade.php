@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-xs-12 conten imagelogo" >
                    <img src="/images/balajirealty logo.png" class="img-responsive content" id="imagelogo"/>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="content">
                    <!--Right side Content Details About Company-->
                    
                    <label><h2><b>Company Profile</b></h2></label>
                    <h4>
                        <b>Balaji Realty</b>  is a direct selling business that offers a comprehensive range of lifestyle products directly to the consumers.<br /><br />
                        <b>Balaji Realty</b> believes in Enhancing Lifestyle & Fulfilling Dreams  of every individual in our wide network of distributors and consumers.<br /><br />
                    </h4>
                    <ul>
                        <li><h4><i class="fas fa-calendar"></i>   10th January,2010</h4></li>
                        <li><h4><i class="fas fa-home"></i> Bhayandar (East) ,Thane </h4></li>
                        <li><h4><i class="fas fa-envelope"></i> balajirealtywebsite@gmail.com</h4></li>
                        <li><h4><i class="fas fa-phone"></i> (+91) 8655669954</h4></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <br /><br /><br /><br /><br />
        
        
        <div class="row">
            <div class="info col-md-12">
                <!--Scroll Started-->
                <p>
                    We are aiming fulfills the dream of every individual associated with us.
                    Our network of registered distributors and consumers gets special benefits and opportunities due to our increasing dominance in the direct selling industry of our country.
                </p><br />
                <div class="parallax"></div><br /><!--Parallax Effect-->
                <p>
                    We operate through a streamlined procedure where our registered distributors introduce new customers to the company and get them registered in the customer network.
                    By doing so, they not only gain monetary benefits by selling products, but also become entitled to various other income opportunities.
                </p><br />
                <p>We offer a constant source of unlimited income and opportunities for our registered distributors by maintaining a complete range of lifestyle products that they offer to the customers as per their requirement and needs.</p><br />
                <div class="parallax"></div><br /><!--Parallax Effect 2-->
                <hr />
                <h3><b>VISION</b></h3>
                “HAND IN HAND TOGETHER WITH OUR DISTRIBUTORS TO ACHIEVE A MUTUAL SUCCESS IN THE DIRECT SELLING INDUSTRY”
                <hr />
                <h3><b>MISSION</b></h3>
                “TO PROVIDE AN OPPORTUNITY FOR AN INDIVIDUAL TO GET RELIABLE GROWTH OF HEALTH AS WELL AS WEALTH”
                <hr />
            </div>
        </div>
        <br />
        <div class=" jumbotron" style="background:transparent">
            <!--Management Part started-->
            <h1 align="center"><b>MANAGEMENT</b></h1><br/><br/>
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <div class="card" id="panel">
                        <div class="card-body">
                            <img src="/images/person_1.jpg" width="800" height="533" class="img-responsive  card-img-top rounded-circle" />
                        </div>
                        <div class="card-footer" id="counter-footer"><h2>Director</h2></div>
                        <div class="card-footer" id="counter-footer"><h3><span class="label label-info">MR. AJAY RAJ SINGH</span></h3></div>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="card" id="panel">
                        <div class="card-body">
                            <img src="/images/person_3.jpg" width="800" height="533" class="img-responsive card-img-top rounded-circle" />
                        </div>
                        <div class="card-footer" id="counter-footer"><h2>Director</h2></div>
                        <div class="card-footer" id="counter-footer"><h3><span class="label label-info">MR. HARIPRAKASH SINGH</span></h3></div>
                    </div>
                </div>
            </div>
        </div><br/>
        
        <div class="department1  col-md-12">
            <!--GREIVIENCE CELL Part started-->
            <h1 align="center"><b>GREIVIENCE CELL COMMITTEE MEMBERS</b>  </h1><br/>
            <ul class="department">
                <li class="grid col-md-3" align="center">
                    <h4>PCHAND YADAV</h4>
                    <p>M:+91 9987595895 </p>
                </li>
                <li class="grid col-md-3" align="center">
                    <h4>SHIVRAM GUPTA </h4>
                    <p>M:+91 9699939207 </p>
                </li>
                <li class="grid col-md-3" align="center">
                    <h4>RAHUL GUPTA </h4>
                    <p>M:+91 8424800309 </p>
                </li>
            </ul>
        </div><br/>
        
        <div class="department2 col-md-12"><!--Company Working Employee Details-->
            <div class="col-md-12 wel">
                <div class="card" id="panel">

                    <h1 align="center"><b>Company Employee Members</b>  </h1><br />
                    
                    
                    <div class="row">
                        <div class="col-md-4" align="center">
                            <div class="card-body">
                                <img src="/images/people.jpg" width="200" height="200" class=" img-circle" />
                            </div>
                            <h4 class="card-footer" id="counter-footer">Senior Employess of Company </h4>
                            <p class="card-footer" id="counter-footer"><span class=" label label-info">12</span></p>
                        </div>
                        <div class="col-md-4" align="center">
                            <div class="card-body">
                                <img src="/images/number_of_employees.jpg" width="200" height="200" class="img-circle" />
                            </div>
                            <h4 class="card-footer" id="counter-footer">No.Of Employees</h4>
                            <p class="card-footer" id="counter-footer"><span class=" label label-info">20</span></p>
                        </div>
                        <div class="col-md-4" align="center">
                            <div class="card-body">
                                <img src="/images/number_of_agents.jpg" width="200" height="200" class="img-circle" />
                            </div>
                            <h4 class="card-footer" id="counter-footer">Number Of Agents</h4>
                            <p class="card-footer" id="counter-footer"><span class=" label label-info">15</span> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection