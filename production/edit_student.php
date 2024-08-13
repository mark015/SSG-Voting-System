<?php
    require_once'include/config.php';
    include'include/auth.php';

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
        <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
        
        <style>
        </style>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php
                    include'include/sidemenu.php'; 
                    include'include/topnav.php';
                ?>
                <!-- page content -->
                <div class="right_col" role="main" style="background-image: url(images/<?php echo $set_data['bg_image'];?>); background-repeat: no-repeat; background-size: cover;">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3><b>Updates</b></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                            <!-- form input mask -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Edit Student Details</h2>                                        
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class='btn btn-danger btn-xs' href='rec_students.php'><i class='fa fa-reply'> Back</i></a></li>
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a></li>
                                                    <li><a href="#">Settings 2</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <?php                                            
                                            $lrn_no = $_GET['lrn_no'];
                                            $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                            $sql = "SELECT * FROM tbl_students INNER JOIN tbl_strands ON tbl_students.strand_id=tbl_strands.strand_id INNER JOIN tbl_tracks ON tbl_students.track_id=tbl_tracks.track_id WHERE lrn_no=?";
                                            $qry=$mysql_connection_object->prepare($sql);
                                            $qry->bind_param("s",$lrn_no);
                                            $qry->execute();
                                            $qry->bind_result($lrn_no, $track_id, $strand_id, $lastname, $firstname, $middlename, $ext_name, $gender, $bdate, $street, $barangay, $city, $province, $postal_code, $country, $mother, $father, $guardian, $telephone, $cellphone, $email, $level, $pass, $status, $strd_id, $strd_tid, $strd_name, $strd_desc, $track_id, $track_name, $track_desc);
                                            $qry->fetch();
                                        ?>
                                        <form method="post" action="editprocess.php" enctype="multipart/form-data">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">I. Student Information: </label>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Learner Reference Number (LRN): </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="lrn_no" value="<?php echo $lrn_no ;?>" readonly />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Last Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="lastname" value="<?php echo $lastname ;?>" required="" />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">First Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="firstname" value="<?php echo $firstname ;?>" required="" />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Middle Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="middlename" value="<?php echo $middlename ;?>" />
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Name Extension: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="ext_name" value="<?php echo $ext_name ;?>"/>
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Gender: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <select class="form-control has-feedback-left" name="gender" required>
                                                            <option selected value="<?php echo $gender ;?>"><?php echo $gender ;?></option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Date of Birth (MM/DD/YY): </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <input type="date" class="form-control has-feedback-left" name="bdate" value="<?php echo $bdate ;?>" required="" />
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
                                                            <input type="text" class="form-control has-feedback-left" name="street"  value="<?php echo $street ;?>"/>
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Subdivision/Barangay: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="barangay"  value="<?php echo $barangay ;?>" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">City/Municipality: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="city"  value="<?php echo $city ;?>" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Province: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="province"  value="<?php echo $province ;?>" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Postal/Zip Code: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="postal_code"  value="<?php echo $postal_code ;?>"/>
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Country: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="country"  value="<?php echo $country ;?>" />
                                                            <span class="glyphicon glyphicon-road form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="separator">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Parent/s or Guardian's Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Mother's Name: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="mother"  value="<?php echo $mother ;?>" />
                                                            <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Father's Name: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="father"  value="<?php echo $father ;?>" />
                                                            <span class="glyphicon glyphicon-user form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Guardian's Name: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="guardian"  value="<?php echo $guardian ;?>" />
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
                                                            <input type="text" class="form-control has-feedback-left" name="telephone"  value="<?php echo $telephone ;?>" />
                                                            <span class="glyphicon glyphicon-earphone form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">Cellphone Number: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="text" class="form-control has-feedback-left" name="cellphone"  value="<?php echo $cellphone ;?>" />
                                                            <span class="glyphicon glyphicon-phone form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                        <p class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">E-mail Address: </p>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                            <input type="email" class="form-control has-feedback-left" name="email"  value="<?php echo $email ;?>" />
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
                                                                    <option selected value="<?php echo $track_name; ?>"><?php echo $track_name; ?></option>
                                                                    <?php 
                                                                        $sql = "SELECT track_name FROM tbl_tracks";
                                                                        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                                        $qry = $mysql_connection_object->prepare($sql);
                                                                        $qry->execute();
                                                                        $qry->bind_result($opt_tname);
                                                                        while($qry->fetch()){
                                                                            echo"<option>$opt_tname</option>";;
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
                                                                    <option selected value="<?php echo $strd_name; ?>"><?php echo $strd_name; ?></option>
                                                                    <?php 
                                                                        $sql = "SELECT strand_name FROM tbl_strands";
                                                                        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                                        $qry = $mysql_connection_object->prepare($sql);
                                                                        $qry->execute();
                                                                        $qry->bind_result($opt_cname);
                                                                        while($qry->fetch()){
                                                                            echo"<option>$opt_cname</option>";
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
                                                                    <option selected value="<?php echo $level ;?>"><?php echo $level ;?></option>
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
                                                    <button type="submit" name="edit_student" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Update</button>
                                                    <a href="rec_students.php" class="btn btn-warning" type="button">Cancel</a>
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
        <!-- Drop Zone -->
        <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
    </body>
</html>
