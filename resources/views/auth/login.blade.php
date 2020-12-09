@extends('layouts.app')

@section('content')
<!-- home section -->
<div id="home">
<div class="centerSection">
        <h1 class="custom-title">HABESHA SUPERMARKET</h1>
        <p>Look our goods from your home and reduce your time,cost, effort to shop products. It is much easy to use and you will love it. </p>
</div>
</div>

<!--Prodcuts section  -->
<div id="products">
<h1 style="text-align:center">Different Products</h1>
    <div class="centerProducts">
    <i style="font-size:50px; padding:100px 0" class="fas fa-angle-left"></i>
        <div>
            <img  src="/images/fruit.jpg" alt="fruit">
            <p>variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits</p>
        </div>
        <div>
            <img  src="/images/hairOil.jpg" alt="">
            <p>variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits</p></div>
        <div>
            <img  src="/images/soap.jpg" alt="">
            <p>variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits</p>
        </div>
        <div><img  src="/images/shampoo.png" alt="">
        <p>variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits</p>
    </div>
    <i style="font-size:50px; padding:100px 0" class="fas fa-angle-right"></i>
    </div>
</div>

<!-- About us section -->
<div id="about">
<h1 style="text-align:center">About Us</h1>
    <div class="centerAbout">
        <div>
            <h3>Support delivery</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus quam provident et officiis, libero architecto corporis quia ea quae, aperiam quaerat sequi rerum doloremque culpa. Illo aspernatur explicabo dolore beatae!</p>
        </div>
        <div>
        <h3>Easy To Use</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus quam provident et officiis, libero architecto corporis quia ea quae, aperiam quaerat sequi rerum doloremque culpa. Illo aspernatur explicabo dolore beatae!</p>
        </div>
        <div>
        <h3>Categorized</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus quam provident et officiis, libero architecto corporis quia ea quae, aperiam quaerat sequi rerum doloremque culpa. Illo aspernatur explicabo dolore beatae!</p>
    </div>
    </div>
</div>

<!-- login -->
<div id="loginSection"  class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Contact section  -->
<div id="contact">

    <div class="centerContact">
        
        <div class="contactForm">
            <h1 style="text-align:center"> Contact Form</h1>
            <form class="fullForm" action="#">
                <div class="leftForm">
                <input class="contactFormInput" type="text" name="name" placeholder="Name">
                <input class="contactFormInput" type="email" name="email" placeholder="Email">
                <input class="contactFormInput" type="text" name="subject" placeholder="Subject">
                </div>
                <div class="rightForm">
                <textarea class="contactFormInput"  name="message" placeholder="Your message here"></textarea>
                <button class="contactFormButton"> Send </button>
                </div>
            </form>
            
        </div>

       
        <div class="contactReferences">
            <h2 style="text-align:center">Find US</h2>
            <ul>
            <ul class="listGroup">
                    <li><h5>Addres</h5></li>
                    <li>5Kilo infront of AA</li>
                </ul>
                <ul class="listGroup">
                    <li><h5>Phone</h5></li>
                    <li>0901234567</li>
                </ul>
                <ul class="listGroup">
                <li><h5>Email</h5></li>
                <li>someEmail@gmail.com</li>
                </ul>
                <ul class="listGroup">
                <li><h5>Facebook</h5></li>
                <li>Some thin</li>
                </ul>
            </ul>
        
        
    </div>
</div>


@endsection
