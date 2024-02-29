<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/Signup.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap" rel="stylesheet">

<title>Yearn Art | Signup</title>
<link rel="icon" href="{{ asset('assets/image/Yearn.jpg') }}" type="image/png">

</head>
<body>
  <nav class="navbar">
    <div class="logo">
      <img src="assets/image/Yearn.jpg" alt="Logo">
      <a href="/">Yearn Art</a>
    </div>
    <div class="menu">
      <div class="menu-links">
            <a href="Products" class="Products">Products</a>
            <a href="MyOrders" class="Orders">My Orders</a>
            <a href="About" class="About">About Us</a>
            <a href="FAQ" class="FAQ">FAQ</a>
            <a href="login" class="Login">Log in</a>
            <a href="register" class="Signup">Signup</a>
      </div>
    </div>
    <div class="menu-btn">
      <i class="fa-solid fa-bars"></i>
    </div>
  </nav>
  <p id="Welcome">Create your Yearn Art Account.</p>
 
  <div id="signup-form">
    <form>
        <p class="fields">All fields are required.</p>
        <div class="form-row">
            <div class="column">
                <label for="full-name">Full Name:</label>
                <input type="text" id="full-name" name="full-name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <div class="column">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                <button type="submit">Sign Up</button>
                <p>Already have an account? <a href="Login.html">Login Now!</a></p>
                <p class="cbAgree">
                    <input type="checkbox" id="agree-checkbox" name="agree-checkbox" required>
                    By cheking, I confirm that I have thoroughly read and agreed to Yearn Art's <b><a href="#" class="terms">Terms of Use</a></b> and <b><a href="#" class="privacy">Privacy Policy</a></b>. These documents outline the methods by which Yearn Art collects, utilizes, and reveals my personal information, as well as the legal entitlements I possess according to relevant legislation.
                </p>
            </div>
        </div>
        
    </form>
</div>
  


  <script>
    const menuLinks = document.querySelectorAll('.menu-link');
    
    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        menuLinks.forEach(otherLink => otherLink.classList.remove('active-link'));
        link.classList.add('active-link');
      });
    });
  </script>
</body>
</html>
