@extends('layout')
@section('content')
<style type="text/css">
    .bg{margin-bottom: 30px;}
    .social-network{display: none;}
    address ul{
        padding-left: 0;
        display: flex;
        flex-direction: column;
    }
    address ul li{
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    address ul li i.fa{
        display: block;
        width: 15px;
        margin-right: 10px;
        line-height: 20px;
        font-size: 15px;
        text-align: center;
        color: #1d4d77;
    }
    address ul li span,address ul li a{
        display: block;
        color: black;
        font-size: 16px;
        line-height: 20px;
        cursor: pointer;
    }
    address ul li span:hover{
        text-decoration: underline;
        color: #1d4d77;
    }
    .contact-info{
        border-radius: 5px;
        border: 2px solid #f5f5f5;
    }
    .col-sm-8 >.contact-form{
        padding: 25px 20px 0;
        border-radius: 5px;
        border: 2px solid #f5f5f5;
        margin-bottom: 30px;
    }
</style>
<div class="map" style="margin-bottom: 0px;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14899.130734239914!2d105.8160406!3d21.0013466!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa1ac2118c6c429a3!2sShiseido!5e0!3m2!1svi!2s!4v1582462242047!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border-bottom: 5px solid #333; width: 100%;" allowfullscreen=""></iframe>
</div>
<div id="contact-page" class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{URL::to('/homepage')}}">Home</a></li>
          <li class="active">Contact Us</li>
        </ol>
    </div><!--/breadcrums-->
    <div class="bg">
        <div class="row">           
            <div class="col-sm-12">                         
                <h2 class="title text-center">Contact <strong>Us</strong></h2>
            </div>                  
        </div>      
        <div class="row">
            <div class="col-sm-4">
                <div class="contact-info" style="padding-top: 25px;">
                    <h2 class="title text-center">Contact Info</h2>
                    <address>
                        <ul>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><span>72A Nguyễn Trãi, Thượng Đình, Thanh Xuân, Hà Nội</span></li>
                            <li><i class="fa fa-phone-square" aria-hidden="true"></i><span><a href="tel:84386876699">+84 386876699</a></span></li>
                            <li><i class="fa fa-facebook" aria-hidden="true"></i><span><a href="https://www.facebook.com/ShiseidoVn/">SHISEIDO</a></span></li>
                            <li><i class="fa fa-youtube" aria-hidden="true"></i><span><a href="https://www.youtube.com/channel/UC2_NoH96vBrJ4Q3Qqo2_kYw">shiseidousa</a></span></li>
                            <li><i class="fa fa-instagram" aria-hidden="true"></i><span><a href="https://www.instagram.com/shiseidopro_official/">@shiseidopro_official</a></span></li>
                            <li><i class="fa fa-twitter" aria-hidden="true"></i><span><a href="https://twitter.com/shiseidoworld">@shiseidoworld</a></span></li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i><span>shiseido.contactus@gmail.com</span></li>
                            <li><i class="fa fa-linkedin" aria-hidden="true"></i><span><a href="https://www.linkedin.com/company/shiseido">shiseido linkedin</a></span></li>
                        </ul>
                    </address>
                    <h2 class="title text-center">Shop hour</h2>
                    <address>
                        <ul>
                            <li><i class="fa fa-calendar-o" aria-hidden="true"></i><span>
                                From <b> Monday </b> To <b> Saturday </b>
                            </span></li>
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i><span>
                                From <b> 7h </b> To <b> 17h </b>
                            </span></li>
                        </ul>
                    </address>
                </div>
            </div>     
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Get In Touch</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="type" class="form-control" required="required" placeholder="Message type">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="messenger" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                        </div>                        
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                        </div>
                    </form>
                </div>
            </div>         
        </div>  
    </div>  
</div><!--/#contact-page-->
@endsection
