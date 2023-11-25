<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/home.css'])
    <title>Home Page</title>
  </head>
  <body>
    <!--NAVIGATION BAR-->
    <div class="nav-bar">
      <a class="active-page" href="home">Home</a>
      <a href="overview">Overview</a>
      <div id="nav-login"> 
        <a href="sign-in">Sign in</a>
      </div>
    </div>

    <!--ABOVE THE FOLD-->
    <div class="welcome-container">
      <div class="welcome-header">
        <!--the page header-->
        <h2>MedicaMystic Dispensary</h2>
        <span id="page-headline"
          ><b
            >Get your <span class="headline-word">meds</span> with no stress!</b
          ></span
        >
        <br />
        <span id="page-subheadline"
          >Sign in or register to access the drug dispensary</span>
        <br /><br />
        <div class="welcome-options">
          <!--call to action-->
          <a class="btn-links btn-sign_in" href="sign-in">Sign In</a>
          <a class="btn-links btn-register" href="register">Register</a>
        </div>
      </div>
      <br /><br />

      <div class="header-image">
        <!--header-image-->
        <img
          id="img-syringe"
          alt="Image of syringe"
          title="Syringe: From Flaticon"
          src="{{asset('img/syringe.png')}}"
        />
      </div>
    </div>

    <!--BELOW THE FOLD-->

    <!--benefits and trust indicators-->
    <div class="benefits-container">
      <div class="testimonials-section">
        <!-- (&#39; This is a single quote)-->
        <q id="john-doe-testimonial">
          I love MedicaMystic! It&#39;s so easy to order my meds online!<br />
          No more waiting in line at the pharmacy, I'm lazy! MedicaMystic <br />
          is like magic, but better! As I always say, <br />
          &#39;Don&#39;t be tragic, be MedicaMystic!&#39; 😎</q
        ><br />
        <i><b>-John Doe, MedicaMystic user</b></i>
      </div>
      <br /><br />

      <div class="benefits-section">
        <h2>Smooth, super, and superb</h2>
        <h3>Why use MedicaMystic?</h3>
        <div class="benefits-list">
          <span>Convenient</span><br />
          <span>Easy to use</span><br />
          <span>Your conscience says so</span>
        </div>
      </div>
    </div>

    <div class="features-container">
      <div class="features-header">
        <h2>Features</h2>
        <h3>What does MedicaMystic offer?</h3>
      </div>
      <div class="features-list">
        <h4>User Account Creation</h4>
        <p>
          To effectively view and manage your<br />
          details on the go
        </p>
        <h4>Inventory Control</h4>
        <p>
          To streamline inventory management<br />
          better than ever before
        </p>
        <h4>E-prescriptions Management</h4>
        <p>
          Storage, control, and slick transfer<br />
          of medical prescriptions
        </p>
        <h4>Automated dispensing solutions</h4>
        <p>
          To handle tasks such as searching and<br />
          selecting drugs, saving you time
        </p>
      </div>
    </div>

    <div class="features-conclusion">
      <p>
        With our web-based drug dispensing system, you can enjoy<br />
        the benefits of a
        <span class="features-text">comprehensive, connected,</span> and
        <span class="features-text">consistent</span><br />
        medication management solution.<br />
        Register today and see the difference for yourself!
      </p>
    </div>

    @include('includes/footer')
    </div>
  </body>
</html>
