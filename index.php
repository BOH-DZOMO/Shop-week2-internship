<?php
$title = "Todo Site";
require_once("./pages/partials/header.par.php");
require_once "./includes/autoloader.inc.php";
require_once "./includes/config.session.inc.php";
?>
<title>Shop</title>
<link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
   <main>
      <div class="container">
         <div class="header">
            <span id="signin">Sign In</span>
            <span id="signup">Sign Up</span>
         </div>
         <hr>
         <div id="content">
            <form action="./includes/auth.inc.php" method="post">
               <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="" required>
               </div>
               <div id="error_log">
               <?php
               if (isset($_SESSION['errors_signin']) && $_SESSION["errors_signin"] !== null) {
                  $data = $_SESSION["errors_signin"];
                  $_SESSION["errors_signin"] = null;
                  echo "<ul>";
                  foreach ($data as $key => $value) {
                  echo "<li class='errors' style='font-size: 15px;color: red; margin-bottom: 5px'>$value</li>";
                  }
                  echo "</ul>";
               }
                 ?>
               </div>
               <div class="d-grid gap-2">
                  <button class="btn btn-primary" style="font-weight: 500;" type="submit" name="signIn">Sign In</button>
               </div>
            </form>
         </div>
      </div>
   </main>
   <script src="./assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
   <script src="./assets/Vendor/fontawesome/js/all.min.js"></script>
   <script>
      let signInBtn = document.getElementById("signin");
      let signUpBtn = document.getElementById("signup");
      let content = document.getElementById("content");
      let error_log = document.getElementById("error_log");


      signInBtn.classList.add("focus");

      signUpBtn.addEventListener("click", (e) => {
         // signInBtn.classList.toggle("focus");
         // signUpBtn.classList.toggle("focus");
         signUpBtn.className ="focus"
         signInBtn.className = "non-focus"

         content.innerHTML = `<form action="./includes/auth.inc.php" method="post" id="signupForm">
            <div class="mb-2">
               <label for="firstname" class="form-label">First Name</label>
               <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" required>
            </div>
            <div class="mb-2">
               <label for="lastname" class="form-label">Last Name</label>
               <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" required>
            </div>
            <div class="mb-2">
               <label for="telephone" class="form-label">Telephone</label>
               <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="" required>
            </div>
            <div class="mb-2">
               <label for="email" class="form-label">Email</label>
               <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-2">
               <label for="password" class="form-label">Password</label>
               <input type="password" class="form-control" name="password" id="password" placeholder="" required>
            </div>
            <div class="mb-2">
               <label for="password_confirm" class="form-label">Confirm Password</label>
               <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="" required>
            </div>
            <div id="error_log">
                  <?php
                  if (isset($_SESSION['errors_signup'])  && $_SESSION["errors_signup"] !== null) {
                     $data = $_SESSION["errors_signup"];
                     $_SESSION["errors_signup"] = null;
                     echo "<ul>";
                     foreach ($data as $key => $value) {
                     echo "<li class='errors' style='font-size: 15px;color: red; margin-bottom: 5px'>$value</li>";
                     }
                     echo "</ul>";
                  }
                  ?>
            </div>
            <div class="d-grid gap-2">
               <button class="btn btn-primary" style="font-weight: 500;" name="signUp" type="submit">Sign Up</button>
            </div>
            </form>`
      })
      signInBtn.addEventListener("click", (e) => {
         // signInBtn.classList.toggle("focus");
         // signUpBtn.classList.toggle("focus");
         signUpBtn.className ="non-focus"
         signInBtn.className = "focus"
         content.innerHTML = `
               <form action="./includes/auth.inc.php" method="post">
               <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="" required>
               </div>
               <div id="error_log">
               </div>
               <div class="d-grid gap-2">
                  <button class="btn btn-primary" style="font-weight: 500;" type="submit" name="signIn">Sign In</button>
               </div>
            </form>`
      })
      
      let url = new URLSearchParams(window.location.search)
      let signupP = url.get('signup');
      let signipP = url.get('signin');
      
      if (signupP == "failed") {
         
         signUpBtn.click();
      }
   </script>
</body>

</html>
