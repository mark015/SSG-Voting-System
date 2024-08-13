<?php
    require_once 'include/config.php';
    include'include/auth.php';
	if ( isset( $_POST['addstudent'] ) ) {    
    date_default_timezone_set("Asia/Manila");
    $date=date("Y-m-d");
    $bdate = isset($_POST['bdate']) ? $_POST['bdate'] : "";
    
    $lrn_no = isset($_POST['lrn_no']) ? $_POST['lrn_no'] : "";
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : "";
    $ext_name = isset($_POST['ext_name']) ? $_POST['ext_name'] : "";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $street = isset($_POST['street']) ? $_POST['street'] : "";
    $barangay = isset($_POST['barangay']) ? $_POST['barangay'] : "";
    $city = isset($_POST['city']) ? $_POST['city'] : "";
    $province = isset($_POST['province']) ? $_POST['province'] : "";
    $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
    $country = isset($_POST['country']) ? $_POST['country'] : "";
    $mother = isset($_POST['mother']) ? $_POST['mother'] : "";
    $father = isset($_POST['father']) ? $_POST['father'] : "";
    $guardian = isset($_POST['guardian']) ? $_POST['guardian'] : "";
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
    $cellphone = isset($_POST['cellphone']) ? $_POST['cellphone'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $level = isset($_POST['level']) ? $_POST['level'] : "";
    $track = isset($_POST['track']) ? $_POST['track'] : "";
    $strand = isset($_POST['strand']) ? $_POST['strand'] : "";
    $status = 'Inactive';
    
    function random_password($length = 5){
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }
    $pass = random_password(8);
    
    $sql = "SELECT * FROM tbl_tracks WHERE track_name='$track'";
    $qry = mysqli_query($mysql_connection_object,$sql);
    $track_data = mysqli_fetch_array($qry);
    $track_id = $track_data['track_id']; 
    
    $sql = "SELECT * FROM tbl_strands WHERE strand_name='$strand'";
    $qry = mysqli_query($mysql_connection_object,$sql);
    $strand_data = mysqli_fetch_array($qry);
    $strand_id = $strand_data['strand_id']; 
    
    $query = "SELECT * FROM `tbl_students` WHERE `lrn_no` = '$lrn_no'";
    $result_object = mysqli_query($mysql_connection_object, $query);
    $student_data = mysqli_fetch_assoc($result_object);
    
    if ($lrn_no == $student_data['lrn_no']){ 
        echo "<script>
                alert('Already Exist!!!');
            </script>";
    } else{
        $sql = "INSERT INTO tbl_students VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $qry = $mysql_connection_object->prepare($sql);
        $qry->bind_param("siisssssssssssssssssssss", $lrn_no, $track_id, $strand_id, $lastname, $firstname, $middlename, $ext_name, $gender, $bdate, $street, $barangay, $city, $province, $postal_code, $country, $mother, $father, $guardian, $telephone, $cellphone, $email, $level, $pass, $status);
        
        if ($qry->execute()) { 
            echo "<script>
                    alert('Succesfully Added!!');
                    window.location.href='#';
                </script>";
        } else { 
            echo "<script>
                    alert('Registration Failed!! Something went wrong.');
                </script>";
        }
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
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <link rel="icon" href="images/scshs_logo.png"/>
        
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        
        <style>
        </style>
        <script>
            function showHint(str){
                
                if(str.length == 0){
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else{
                    var xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState==4 && xmlhttp.status==200){
                            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "attendance_process.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>   
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php
                    include'include/att_sidemenu1.php';
                    include'include/att_topnav.php';
                    include 'include/print.php';
                ?>

                <!-- page content -->
                <!-- page content -->
                <div class="right_col" role="main" style="background-image: url(images/<?php echo $set_data['bg_image'];?>); background-repeat: no-repeat; background-size: cover;">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3><b>Fill-up Forms</b></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                            <!-- form input mask -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Add Student</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a>
                                                    </li>
                                                    <li><a href="#">Settings 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form method="post" action="">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">I. Student Information: </label>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Learner Reference Number (LRN): </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="lrn_no" placeholder="LRN Number" required="" autofocus />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Last Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="lastname" placeholder="Lastname" required="" />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">First Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="firstname" placeholder="Firstname" required="" />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Middle Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="middlename" placeholder="Middlename" />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Extension Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="ext_name" placeholder="Extension Name"/>
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Gender: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <select class="form-control has-feedback-left" name="gender">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Date of Birth (MM/DD/YY): </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="date" class="form-control has-feedback-left" name="bdate" required="" />
                                                        <span class="glyphicon glyphicon-calendar form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Permanent Address: </label>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">House Number and Street: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="street" placeholder="House Number and Street"/>
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Subdivision/Barangay: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="barangay" placeholder="Subdivision/Barangay" required="" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">City/Municipality: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="city" placeholder="City/Municipality" required="" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Province: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="province" placeholder="Province" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Postal/Zip Code: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="postal_code" placeholder="Postal/Zip Code" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Country: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="country" placeholder="Country" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="separator">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Parent/s or Guardian's Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Mother's Name (Last, First Middle): </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="mother" placeholder="Mother's Name" />
                                                            <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Father's Name (Last, First Middle): </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="father" placeholder="Father's Name" />
                                                            <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Guardian's Name (Last, First Middle): </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="guardian" placeholder="Guardian's Name" />
                                                            <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="separator">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Student Contact Information: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Telephone Number: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="telephone" placeholder="Telephone Number" />
                                                            <span class="glyphicon glyphicon-earphone form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Cellphone Number: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="cellphone" placeholder="Cellphone Number" />
                                                            <span class="glyphicon glyphicon-phone form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">E-mail Address: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="email" class="form-control has-feedback-left" name="email" placeholder="E-mail Address" />
                                                            <span class="glyphicon glyphicon-envelope form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">II. SENIOR HIGH SCHOOL (SHS) PROGRAM:</label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-md-5 col-sm-12 col-xs-12">
                                                            <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Track: </label>
                                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                                <select class="form-control has-feedback-left" name="track">
                                                                    <?php 
                                                                        $sql = "SELECT track_name FROM tbl_tracks";
                                                                        $qry = $mysql_connection_object->prepare($sql);
                                                                        $qry->execute();
                                                                        $qry->bind_result($opt_tname);
                                                                        while($qry->fetch()){
                                                                            echo"<option>$opt_tname</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <span class="glyphicon glyphicon-education form-control-feedback left" aria-hidden="true"></span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Strand: </label>
                                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                                <select class="form-control has-feedback-left" name="strand">
                                                                    <?php 
                                                                        $sql = "SELECT strand_name FROM tbl_strands";
                                                                        $qry = $mysql_connection_object->prepare($sql);
                                                                        $qry->execute();
                                                                        $qry->bind_result($opt_sname);
                                                                        while($qry->fetch()){
                                                                            echo"<option>$opt_sname</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <span class="glyphicon glyphicon-education form-control-feedback left" aria-hidden="true"></span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Level: </label>
                                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                                <select class="form-control has-feedback-left" name="level">
                                                                    <option value="Grade 11">Grade 11</option>
                                                                    <option value="Grade 12">Grade 12</option>
                                                                </select>
                                                                <span class="glyphicon glyphicon-education form-control-feedback left" aria-hidden="true"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group"><br>
                                                <div class="separator">
                                                    <button type="submit" name="addstudent" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Submit</button>
                                                    <button type="reset" class="btn btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include'include/footer.php';?>
        </div>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="../vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="../vendors/Flot/jquery.flot.js"></script>
        <script src="../vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../vendors/Flot/jquery.flot.time.js"></script>
        <script src="../vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="../vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>      
        <!-- Datatables -->
        <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
        <script src="../vendors/jszip/dist/jszip.min.js"></script>
        <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    </body>
</html>