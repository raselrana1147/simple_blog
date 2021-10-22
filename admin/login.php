<?php
  session_start();

    require_once('../database/db.php');

    if (isset($_SESSION['login']) && $_SESSION['login']==true) {
         header("location:index.php");
    }  
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simple Blog | Admin Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="lobibox/css/lobibox.min.css">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="lobibox/js/lobibox.js"></script>
  <script src="lobibox/js/custom.js"></script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    
  </div>
  <?php 


    if ($_SERVER['REQUEST_METHOD']=="POST") {

         $email=htmlspecialchars(trim(stripcslashes($_POST['email'])));
         $password=htmlspecialchars(trim(stripcslashes($_POST['password'])));
  

         if (empty($email)) {
            echo "<script>error_meesage('Email is required')</script>";
         }elseif (empty($password)) {
            echo "<script>error_meesage('Password is required')</script>";
         }else{

            $password= md5($password);

           $sql="SELECT * from admins where email='$email' AND password='$password' ";
           $query=mysqli_query($connection,$sql);
           $row=mysqli_num_rows($query);
          
           if ($row==1) {

              $value=mysqli_fetch_assoc($query);

              $_SESSION['admin_id']=$value['id'];
              $_SESSION['myName']=$value['name'];
              $_SESSION['email']=$value['email'];
              $_SESSION['login']=true;
              $_SESSION['session_status']=true;
              header("location:index.php");
            
           }else{
                echo "<script>error_meesage('Credentials did not match')</script>";
           }
         }
         
    }

   ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
         
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>

  </div>
</div>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
