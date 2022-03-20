<!doctype html>
<html lang="en">
  <head>
  	<title>JAE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Nucleo Icons -->
  <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('css/material-dashboard.css?v=3.0.1')}}" rel="stylesheet" />
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('css/style.css')}}">

  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
        <img class="logo-img" src="{{('img/LOGO.png')}}" alt="Paris">
	  		<h1><a href="index.html" class="logo">JAE Construction</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="#"><span class="fa fa-home mr-3"></span> Homepage</a>
          </li>
          <li>
              <a href="employee"><span class="fa fa-user mr-3"></span> Employee</a>
          </li>
          <li>
            <a href="category"><span class="fa fa-sticky-note mr-3"></span> Category</a>
          </li>
          <li>
            <a href="item"><span class="fa fa-sticky-note mr-3"></span> Items</a>
          </li>
          <li>
            <a href="project"><span class="fa fa-paper-plane mr-3"></span> Project</a>
          </li>
          <li>
            <a href="budget"><span class="fa fa-paper-plane mr-3"></span> Project Budget</a>
          </li>
          <li>
            <a href="dsreport"><span class="fa fa-paper-plane mr-3"></span> Daily Site Report</a>
          </li>
        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
      <div class='container'>
            @yield('content')
          </div>
      </div>
		</div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
  </body>
</html>