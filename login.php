<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="assets/bs/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="main.css" type="text/css">
<script type="text/javascript" src="assets/bs/js/bootstrap.min.js"></script>
</head>

<body class="body">

<div class="container">
  <div class="formlogin">
    <div class="panel">
      <div class="panel-body text-center text-info"> <strong>Login Form</strong></div>
    </div>
    <form method="post" action="ceklogin.php">
      <div class="form-group">
      <label>Username</label>
        <input type="text" name="user" class="form-control" placeholder="Masukan Username">
      </div>
      <div class="form-group">
      <label>Password</label>
        <input type="password" name="pass" class="form-control" placeholder="Masukan Password">
      </div>
      <div class="form-group text-center">
        <button class="btn btn-info btn-block" type="submit">Login</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>