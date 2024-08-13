<?php
    require_once'production/include/config.php';
    session_start();
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    unset($_SESSION['lrn_no']);
	date_default_timezone_set("Asia/Manila");
	$time = date('H:i:sa');
	$date2 = date('Y-m-d');
	//echo $time;
    date_default_timezone_set('Asia/Manila');
    $count_date = date('Y-m-d');
    //$del_date = $count_date;

    //$unixTimestamp = strtotime($count_date);

    //Get the day of the week using PHP's date function.
    //$dayOfWeek = date("l", $unixTimestamp);

    //Print out the day that our date fell on.
    //echo $count_date . ' fell on a ' . $dayOfWeek;
if (isset( $_POST['login'] ) ) {
    $username = isset($_POST['username']) ? $_POST['username']: "";
    $password = isset($_POST['password']) ? $_POST['password']: "";
    $hash = hash("SHA256", $password);
    
    $query = "SELECT * FROM `tbl_users` WHERE `username` = '$username'";
    $result_object = mysqli_query($mysql_connection_object, $query);
    $user_data = mysqli_fetch_assoc($result_object);
    
    $qry = "SELECT * FROM `tbl_students` WHERE `lrn_no` = '$username'";
    $result_object = mysqli_query($mysql_connection_object, $qry);
    $student_data = mysqli_fetch_assoc($result_object);
	
	$qry1 = "SELECT * FROM `tbl_settings` ";
	$result_object1 = mysqli_query($mysql_connection_object, $qry1);
	$settings_data = mysqli_fetch_assoc($result_object1);
	
    
    if (is_null($user_data) && is_null($student_data)) {
        echo "<script>
                alert('User Does Not Exist!!');
                window.location.href='index.php';
            </script>";
    } else {
        if ($hash == $user_data['password']) {
            $_SESSION['userid'] = $user_data['userid'];
            $_SESSION['username'] = $user_data['username'];
            
            $date = "SELECT * FROM tbl_messages WHERE date_to_send = '$count_date' ";
            $q=mysqli_query($mysql_connection_object,$date);
			$num_result = mysqli_num_rows($q);
            
            if($num_result>0){                    
                $send_msg = "SELECT * FROM tbl_messages WHERE date_to_send = '$count_date'";
                $qry = mysqli_query($mysql_connection_object,$send_msg);
                $getmsg=mysqli_fetch_array($qry);
                $message=$getmsg['msg_content'];
                            
                $getnum = "SELECT * FROM tbl_students";
                $cpnum = mysqli_query($mysql_connection_object,$getnum);

                $data5=[];
                $contact=0;

                function itexmo($phone,$text,$api){
                    $url = 'https://www.itexmo.com/php_api/api.php';
                    $itexmo = array('1' => $phone, '2' => $text, '3' => $api);
                    $param = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($itexmo),
                        ),
                    );
                    $context  = stream_context_create($param);
                    return file_get_contents($url, false, $context);
                }
                //TR-SHANA601483_K2R2K
                $api = "TR-JEFFC439836_C9SYY";
                while($d=mysqli_fetch_array($cpnum)){       
                    $data5[$contact]=$d['cellphone'];

                    $phone = "0".$data5[$contact];
                    $text = $message;

                    $result = itexmo($phone,$text,$api);
                    if ($result == ""){
                        echo "iTexMo: No response from server!!!
                            Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                            Please CONTACT US for help. ";  
                    } else if ($result == 0){
                        echo "<script>
                                window.location.href='production/home.php?SUCCESS';
                            </script>";
                    } else  {
                        echo "Error Num ". $result . " was encountered!";
                    }
                    $contact++;
                }
            } else {
                echo "
                <script>
                    alert('Login Successfully!!!');
                    window.location.href='production/home.php?noaction';
                </script>";
            }
        } else if ($password == $student_data['password']) {
            if ($student_data['status'] == "Inactive"){
                echo "
                    <script>
                        alert('You Need to Activate Your Account First!!!');
                        window.location.href='index.php';
                    </script>";
            } else if($student_data['status'] == "Voted"){ 
                echo "
                    <script>
                        alert('You Already Finished Casting Your Votes!!!');
                        window.location.href='index.php';
                    </script>";
            } else {
				if($time <= $settings_data['end_time'] && $date2 == $settings_data['election_date']   ){
                $_SESSION['lrn_no'] = $student_data['lrn_no'];
                echo "
                <script>
                    alert('Login Successfully!!!');
                    window.location.href='production/voters.php';
                </script>";
            } else {
				echo "
				<script>
					alert('Time End!!');
					window.location.href='index.php';
				</script>";
				}
			}
        } else {
            echo "
                <script>
                    alert('Wrong Password!!!');
                    window.location.href='index.php';
                </script>";
        }
    }
}

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
                alert('Successfully Login!!!');
                window.location.href='production/attendance.php';
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
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">
        <link rel="icon" href="production/images/scshs_logo.png"/>
        <!-- iCheck -->
        <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- PNotify -->
        <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
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
                  <div class="animate form login_form">
                      <section class="login_content">
                        <?php
                            $sql = "SELECT * FROM tbl_settings";
                            $result = mysqli_query($mysql_connection_object, $sql);
                            $set_data = mysqli_fetch_assoc($result);
                        ?>
                          <center>
                              <img class="img-responsive pad" src="production/images/<?php echo $set_data['logo'];?>"  width="50%" height="50%" alt="Photo">
                              <h5 id="date"></h5>
                              <p id="timer"></p>
                          </center>
                          <form role="form-group" class="align-center" method="post" action="">
                              <h1 style="font-family:AR Destine;">Login Form</h1>
                              <div class="form-group has-feedback">
                                  <input type="text" class="form-control has-feedback-left" name="username" placeholder=" Username" autofocus required="" />
                                  <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                              </div>
                              <div class="form-group has-feedback">
                                  <input type="password" class="form-control has-feedback-left" name="password" placeholder=" Password" required="" />
                                  <span class="glyphicon glyphicon-lock form-control-feedback left" aria-hidden="true"></span>
                              </div>
                              <div class="form-group">
                                  <input class="btn btn-sm btn-dark" type="submit" name="login" value="Log in">
                              </div>
                              <br>
                              <div class="clearfix"></div>

                              <div class="separator">
                                  <p class="change_link">
                                      <a href="production/index1.php" class="to_attendance">Student Fill-up Form</a><span>||</span>
                                      <a href="#signup" class="to_attendance">Student's Attendance</a>
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
                  
                  <div id="attendance" class="animate form registration_form">
                      <section class="login_content">
                          <center>
                              <img class="img-responsive pad" src="production/images/<?php echo $set_data['logo'];?>"  width="50%" height="50%" alt="Photo">
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
                                      <a href="#signin" class="to_register"> Go Back </a>
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
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- PNotify -->
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>