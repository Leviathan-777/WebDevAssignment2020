<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<title>Login Form</title>
</head>
<body>
	<div class="overlay">
<form method="post" action="loginProcess.php">
   <div class="con">
   <header class="head-form">
      <h1>Log In</h1>
      <p>Enter your details to login</p>
   </header>
   <br>
   <div class="field-set">
         <input class="form-input" id="txt-input" type="text" placeholder="Username" name="username" required>
      <br>
      <input class="form-input" type="password" placeholder="Password" id="pwd"  name="password" required>
      <br>
      <button class="log-in" type="submit" value="Login">Login</button>
   </div>
  </div>
  
</form>
</div>
</body>
</html>