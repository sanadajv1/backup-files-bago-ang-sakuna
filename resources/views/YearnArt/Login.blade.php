<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/Login.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap" rel="stylesheet">

<title>Yearn Art | Login</title>
<link rel="icon" href="assets/Image/Yearn.jpg" type="image/png">

</head>
<body>
  <nav class="navbar">
    <div class="logo">
      <img src="assets/Image/Yearn.jpg" alt="Logo">
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

  <p id="Welcome">Welcome to Yearn Art! Please Login.</p>

  <div id="login-form">
    <form>
      <label for="email">Email or Phone Number</label>
      <input type="text" id="email" name="email" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">LOGIN</button>
    </form>
    <a href="#">Forgot Password?</a>
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
