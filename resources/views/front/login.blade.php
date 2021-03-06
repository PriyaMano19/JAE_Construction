<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
   
    <style type="text/css">
       @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

body {
    background: #ecf0f3
}

.wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff
}

.logo {
    width: 80px;
    margin: auto
}

.logo img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 100%;
    
}

.wrapper .name {
    font-weight: 600;
    font-size: 1.4rem;
    letter-spacing: 1.3px;
    padding-left: 10px;
    color: #555
}

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 1px 1px 1px #cbced1, inset -3px -3px 3px #fff;

}

.wrapper .form-field .fas {
    color: #555
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #B2022F;
    color: #fff;
    border-radius: 25px;
    box-shadow: 10px 3px 20px #cbced1, -5px -5px 10px #fff;
    letter-spacing: 1.3px
}

.wrapper .btn:hover {
    background-color: #dc143c;
}

.wrapper a {
    text-decoration: none;
    font-size: 0.8rem;
    color: black
}

.wrapper a:hover {
    color: #B2022F
}

@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px
    }
}
    </style>
 
 
</head>
<body>
 
 

 
                     
<form  action="{{ route('login.check') }}" method="POST">
                    @csrf
                            <div id="err" style="color: red">
                                @if(session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            </div>
     <div class="wrapper">
    <div class="logo"> <img src="{{asset('img/LOGO.png')}}" alt=""> </div>
    <div class="text-center mt-1 name"> JAFFNA <strong>ARCHITECT & ENGINEERS </div>
    <form class="p-3 mt-3">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="username" id="userName" placeholder="Username"> </div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="password" id="pwd" placeholder="Password"> </div> <button class="btn mt-3">Login</button>
    </form>
    <div class="text-center fs-6"> <a href="#">Forget password?</a> or <a href="#">Login</a> </div>
</div>
</form>
 

</body>
</html>