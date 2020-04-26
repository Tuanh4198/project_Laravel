@extends('layout')
@section('content')
<div id="contact-page" class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{URL::to('/homepage')}}">Home</a></li>
          <li class="active">Our stock</li>
        </ol>
    </div><!--/breadcrums-->
    <div class="bg">
        <div class="row">
            <?php
                $message = Session::get('message');
                if($message){
                    echo '<h6 class="text-center txt-alert" style="margin-top: 10px; letter-spacing: 1px; color:#ff0000; font-size: 18px; font-style: italic;}">',$message.'</h6>';
                    Session::put('message',null);
                }
            ?>
            <h4 class="text-center">Back to <a href="{{URL::to('/homepage')}}">Home Page</a> to continue shopping</h4>
            <img src="{{asset('public/frontend/images/404/our-stock.png')}}" alt="" style="display: block; margin: auto;">
        </div>
    </div>
</div><!--/#contact-page-->
@endsection
