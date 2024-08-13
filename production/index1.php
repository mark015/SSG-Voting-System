<?php
require_once'include/config.php';
session_start();
unset($_SESSION['userid']);
unset($_SESSION['username']);
unset($_SESSION['lrn_no']);

if ( isset( $_POST['attendance'] ) ) {
	$admin_password = $_POST['admin_password'];
    $hash = hash("SHA256", $admin_password);
    
    $query = "SELECT * FROM `tbl_users` WHERE `position` = 'Administrator'";
    $result_object = mysqli_query($mysql_connection_object, $query);
    $user_data = mysqli_fetch_assoc($result_object);
    
    $query = "SELECT * FROM `tbl_users`";
    $result_object = mysqli_query($mysql_connection_object, $query);
    $data = mysqli_fetch_assoc($result_object);

    if ($hash == $data['password']){ 
        $_SESSION['userid'] = $user_data['userid'];
        echo "
            <script>
                alert('Succesfully Login!!!');
                window.location.href='filluppform.php';
            </script>";
    
    } else {
        echo "
            <script>
                alert('Wrong Password!!!');
                window.location.href='#';
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SSG Voting System</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <link rel="icon" href="images/scshs_logo.png"/>
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- PNotify -->
        <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
        <style>
            p{
                font-family: sans-serif;
                font-size: 14px;
            }
            img{
                opacity: 0.5;
                filter: alpha(opacity=50);
            }
        </style>
    </head>

      <body class="login">
          <div>
              <a class="hiddenanchor" id="signup"></a>
              <a class="hiddenanchor" id="signin"></a>

              <div class="login_wrapper">
                  <div >
                      <section class="login_content">
						  <?php
                            $sql = "SELECT * FROM tbl_settings";
                            $result = mysqli_query($mysql_connection_object, $sql);
                            $set_data = mysqli_fetch_assoc($result);
                          ?>
                          <center>
                              <img class="img-responsive pad" src="images/<?php echo $set_data['logo'];?>"  width="50%" height="50%" alt="Photo">
                              <h5 id="date1"></h5>
                              <p id="timer1"></p>
                          </center>
                          <form role="form-group" class="align-center" method="post" action="">
                              <h1 style="font-family:AR Destine;">Admin Password</h1>
                              <div class="form-group has-feedback">
                                  <input type="password" class="form-control has-feedback-left" name="admin_password" placeholder=" Password" required="" autofocus />
                                  <span class="glyphicon glyphicon-lock form-control-feedback left" aria-hidden="true"></span>
                              </div>
                              <div class="form-group">
                                  <input class="btn btn-sm btn-dark" type="submit" name="attendance" value="Submit">
                              </div>

                              <div class="clearfix"></div>

                              <div class="separator">
                                  <p class="change_link">Wrong Destination?
                                      <a href="../index.php" class="to_register"> Go Back </a>
                                  </p>
                                  <div class="clearfix"></div>
                                  <div>
                                      <h2 style="font-family:AR Destine;"><i class="fa fa-fire"></i>SSG Voting System</h2>
                                      <p>Copyright ©2018 All Rights Reserved. College of Information and Communication Technology & Engineering || NONESCOST. Privacy and Terms</p>
                                  </div>
                              </div>
                          </form>
                      </section>
                  </div>
              </div>
          </div>
          <script>
              var d = new Date();
              document.getElementById("date").innerHTML = d.toDateString();
          </script>
          
          <script>
              var myVar = setInterval(myTimer, 1000);
              function myTimer() {
                  var d = new Date();
                  document.getElementById("timer").innerHTML = d.toLocaleTimeString();
              }
          </script>
          <script>
              var d = new Date();
              document.getElementById("date1").innerHTML = d.toDateString();
          </script>
          
          <script>
              var myVar = setInterval(myTimer, 1000);
              function myTimer() {
                  var d = new Date();
                  document.getElementById("timer1").innerHTML = d.toLocaleTimeString();
              }
          </script>
    </body>
</html>
<!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>