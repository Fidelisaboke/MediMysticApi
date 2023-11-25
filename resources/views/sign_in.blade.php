<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/sign_in.css', 'resources/js/sign_in.js'])
    <title>Sign In</title>
</head>

<body>
    <form action="sign-in/process" method="POST">
        @csrf
        <div class="form-header">
            <h1>MedicaMystic Dispensary</h1>
            <img id="img-syringe" alt="Image of syringe" title="Syringe: From Flaticon" src="{{asset('img/syringe.png')}}" />
        </div>
        <div class="form-content">
            <div class="sign-in-section">
                <h2>SIGN IN</h2>
                @if($errors->any())
                    <span id="error_msg" style="color:red">@error('error'){{$message}}@enderror</span><br>
                @elseif (session('status'))
                    <span id="success_msg" style="color: green">{{session('status')}}</span><br>
                @endif
                <input type="email" placeholder="Email..." id="email" name="email"><br>              
                <input type="password" placeholder="Enter password..." id="password" name="password"><br>
                <div class="form-buttons">
                    <button type="submit" name="submit" value="submit">Submit</button><br>
                </div><br><br>
                <a href="register">New user?</a>
                <br>
            </div>
        </div>
    </form>
</body>

</html>