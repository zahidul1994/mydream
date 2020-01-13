<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
   
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}/">
   
            <!-- Favicons -->
        <link rel="icon" type="image/x-icon" href="assets/images/camera.jpg">
  
 <!-- Camera Slider CSS -->
        <link href="{{asset('css/fontcss/camera.css')}}" rel="stylesheet" type="text/css"/>
       
    
       
       
       

        

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Navbar</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
 <div class="container-fluid">
                <h4> Camera Slide Show</h4>
                
                <!--Camera Slide-->
                 <div class="camera_wrap">
                    <div data-src="{{asset('storage/images/header2.jpeg')}}">
                        <img src="{{asset('storage/images/header2.jpeg')}}">
                        <div class="camera_caption">
                            <p>A jQuery slideshow with many effects, transitions, easy to customize, using canvas and mobile ready, based on jQuery 1.9.1+</p>
                        </div>
                    </div>
                    <div data-src="{{asset('storage/images/header-bg.jpg')}}">
                        <img src="{{asset('storage/images/header-bg.jpg')}}" class="img-responsive">
                        <div class="camera_caption">
                            <p>A jQuery slideshow with many effects, transitions, easy to customize, using canvas and mobile ready, based on jQuery 1.9.1+</p>
                        </div>
                    </div>
                    <div data-src="{{asset('storage/images/header1.jpeg')}}">
                        <img src="{{asset('storage/images/header1.jpeg')}}">
                        <div class="camera_caption">
                            <p>A jQuery slideshow with many effects, transitions, easy to customize, using canvas and mobile ready, based on jQuery 1.9.1+</p>
                        </div>
                    </div>
                    <div data-src="{{asset('storage/images/header2.jpeg')}}>">
                        <img src="{{asset('storage/images/header3.jpeg')}}>">
                        <div class="camera_caption">
                            <p>A jQuery slideshow with many effects, transitions, easy to customize, using canvas and mobile ready, based on jQuery 1.9.1+</p>
                        </div>
                    </div>
                </div>   <!--------Camera Slide End-->
            </div>   <!--***********  Row End-->
<div class="container">
  

@yield('content')

  </div> <!--contaienr-->
  
      <!-- Copyright -->
      <footer><div class="text-center"><?php echo date("Y"); ?>© Copyright:
  <a href="https://rongdonuict.com/"> Rongdhonuict.com</a>
  </div></footer>

      @yield('script')   
    <!-- Copyright -->		
<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

<!--Camera js area start-->
<script src="{{asset('js/fontjs/modernizr-3.5.0.min.js')}}"></script>
<script src="{{asset('js/fontjs/easing.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/fontjs/camera.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/fontjs/plugins.js')}}"></script>
<!-- Camera js area end -->
     
</body>
</html>
  
 

      
