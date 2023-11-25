<!DOCTYPE html>
<html>

<head>
    @vite(['resources/css/register.css'])
    <title>Registration page</title>
</head>

<body>
    <div class="register-form-container">
        <header class="form-header">
            <h2>MedicaMystic Dispensary</h2>
            <img id="digital-pharmacy" alt="image of digital pharmacy" src="{{asset('img/online-pharmacy.png')}}">
            <hr>
        </header>
        <form class="register-form" action="register/process" method="POST">
            @csrf
            <h3>REGISTER</h3>
            <h4>Enter your details below</h4>
            <!-- Error messages -->
            @if($errors->any())
                @foreach ($errors->all() as $err)
                    <li style="color:red">{{$err}}</li>
                @endforeach
            @endif
            <br>
            <label for="username">Username</label>
            <input 
                type="text" 
                placeholder="Username..." 
                name="username" 
                id="username" 
                value="{{old('username')}}" 
                required
            ><br>
            <label for="email">Email</label>
            <input 
                type="email" 
                placeholder="someone@example.com" 
                name="email" 
                id="email" 
                value="{{old('email')}}"
                required
            ><br>
            <!--<label for="user_type">Select type</label>
            <select name="user_type" id="user_type">
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="pharmaceutical_company">Pharmaceutical Company</option>
                <option value="pharmacist">Pharmacist</option>
                <option value="supervisor">Supervisor</option>
            </select><br>-->
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <label for="password">Enter password</label>
            <input type="password" placeholder="Enter Password" id="password" name="password" required><br>
            <label for="confirm_password">Confirm password</label>
            <input 
                type="password" 
                placeholder="Confirm Password" 
                id="confirm_password" 
                name="confirm_password" 
                required
            ><br>
            <button type="submit" id="submit" name="submit" value="submit">Submit</button><br>
            <a href="sign-in" target="_self">Already have an account?</a>
        </form>
    </div>
</body>

</html>