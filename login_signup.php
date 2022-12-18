<html lang="en">
  <head>
    <title>Sign Up & Login Pakh-Pakhali</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>

  <body>
    <div class="hero">
      <div class="form-box">
        <div class="button-box">
          <div id="btn"></div>
          <button type="button" class="toggle-btn" onclick="Login()">
            Login
          </button>
          <button type="button" class="toggle-btn" onclick="SignUp()">
            Sign Up
          </button>
        </div>
        <div class="logo"><img src="Images/logo04.png" alt="#"/></div>
        <form action="backend/login.php" method="post" id="Login" class="input-group">
          <label>
            <input
              type="text"
              name="login-username"
              class="input-field"
              placeholder=" Enter Username"
              required
            />
          </label>
          <label>
            <input
              type="password"
              name="login-password"
              class="input-field"
              placeholder=" Enter Password"
              required
            />
          </label>
          <button type="submit" name="login-button" id="login-button" class="submit-btn">Login</button>
        </form>
        <form action="backend/register.php" method="post" id="Signup" class="input-group">
          <label>
            <input
              type="text"
              name="signup-first_name"
              class="input-field"
              placeholder=" Enter First Name"
              required
            />
          </label>
          <label>
            <input
              type="text"
              name="signup-last_name"
              class="input-field"
              placeholder=" Enter Last Name"
              required
            />
          </label>
          <label>
            <input
              type="text"
              name="signup-username"
              class="input-field"
              placeholder=" Enter Username"
              required
            />
          </label>
          <input
            type="text"
            name="signup-email"
            class="input-field"
            placeholder=" Enter Email"
            required
          />
          <input
            type="password"
            name="signup-password"
            class="input-field"
            placeholder=" Enter Password"
            required
          />
          <input
            type="password"
            name="signup-confirm-password"
            class="input-field"
            placeholder=" Confirm Password"
            required
          />
          <input
            type="text"
            name="signup-region"
            class="input-field"
            placeholder=" Enter Region"
            required
          />
          <input
            type="checkbox"
            name="signup-checkbox"
            class="check-box"
            id="terms-and-conditions-checkbox"
            required
          />
          <label for="terms-and-conditions-checkbox">I agree to the terms & conditions</label>
          <button type="submit" name="signup-button" id="signup-button" class="submit-btn">Sign Up</a></button>
        </form>
      </div>
    </div>
    <script>
      let x = document.getElementById("Login");
      let y = document.getElementById("Signup");
      let z = document.getElementById("btn");

      function SignUp() {
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "110px";
      }

      function Login() {
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0";
      }
    </script>
  </body>
</html>
