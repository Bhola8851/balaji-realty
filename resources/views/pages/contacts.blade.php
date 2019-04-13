@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row" >
        <div class="col-md-5 col-xs-12">
            <div class="imagelogo">
            <img src="/images/balajirealty logo.png" class="content  img-responsive" id="imagelogo"/>
            <br/>
            <br/>   
            <div class="media">
                <ul>
                    <li><h3><i class="fas fa-home"></i> Bhayandar (East) ,Thane </h3></li>
                    <li><h3><i class="fas fa-envelope"></i> balajiwebsite@gmail.com</h3></li>
                    <li><h3><i class="fas fa-phone"></i> (+91) 8655669954</h3></li>
                </ul>
            </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="col-md-1"></div>
        <div class="col-md-6 col-xs-12">
            <br>
            <br>
            <br>
    
            @include('inc.messages')
            <form class="form-container" method="POST" action="{{url('contacts/send')}}">
                {{ csrf_field() }}
                <h2><b>Contact Us <i class="fas fa-address-card"></i></b></h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Your Name"/>
                </div>
                <div class="form-group">
                    <label for="Email">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address"/>
                </div>
                <div class="form-group">
                    <label for="Phone">Phone Number</label>
                    <input class="form-control" name="phone" type="text" placeholder="Your Phone Number"/>
                </div>
                <div class="form-group">
                    <label for="Query">Enter Comment</label>
                    <textarea class="form-control" name="queryi" type="text" rows="5" cols="7" placeholder="Enter your Query"></textarea>
                </div>
                <input type="submit" name="send" value="Send" class="btn btn-danger btn-block" style=""/>
            </form>
            <br/>
            <div class="media">
                <label><b>Connect with us:</b></label>
                <ul class="icons">
                    <li class="h3"><a href="https://www.facebook.com/" class="fab fa-facebook"></a></li>
                    <li class="h3"><a href="https://www.instagram.com/accounts/login/?hl=en" class="fab fa-instagram"></a></li>
                    <li class="h3"><a href="https://twitter.com/login" class="fab fa-twitter-square"></a></li>
                    <li class="h3"><a href="https://www.snapchat.com/" class="fab fa-snapchat-square"></a></li>
                    
                </ul>
            </div>
            
        </div>
        
    </div>
</div>


@endsection