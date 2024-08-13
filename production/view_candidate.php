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

        <title>SSG Voting and Learner's Information System</title>

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
                    include 'include/print.php';
                ?>

                <!-- page content -->
                <div class="right_col" role="main" style="background-image: url(images/<?php echo $set_data['bg_image'];?>); background-repeat: no-repeat; background-size: cover;">
                    <div class="">    
                        <div class="page-title">
                            <div class="title_left">
                                <h3><b>Info</b></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>                    
                        <div class="row">
                            <!-- form input mask -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title hidden-print">
                                        <h2>Candidate Details</h2>                                        
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class='btn btn-danger btn-xs' href='rec_candidates.php'><i class='fa fa-reply'> Back</i></li></a>
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
                                        <?php
                                            $id= $_GET['c_id'];
                                            $sql="SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename, tbl_students.gender, tbl_students.level, tbl_positions.position, tbl_party.party FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE c_id=?";
                                            $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                            $qry=$mysql_connection_object->prepare($sql);
                                            $qry->bind_param("i",$id);
                                            $qry->execute();
                                            $qry->bind_result($c_id, $nickname, $c_image, $lastname, $firstname, $middlename, $gender, $level, $position, $party);
                                            $qry->fetch();
                                        ?>
                                        <?php
                                            $sql="SELECT tbl_students.strand_id, tbl_strands.strand_name FROM tbl_students INNER JOIN tbl_strands ON tbl_students.strand_id=tbl_strands.strand_id WHERE tbl_students.lastname='$lastname' && tbl_students.firstname='$firstname'";
                                            $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                            $qry=$mysql_connection_object->prepare($sql);
                                            $qry->execute();
                                            $qry->bind_result($strand_id, $strand_name);
                                            $qry->fetch();
                                        ?>
                                        <form method="post" action="">
                                            <div class="col-md-2 col-md-offset-0 col-sm-4 col-xs-4 form-group">
                                                <img src="images/<?php echo $c_image ?>" style="width:100%; height:200px;">
                                            </div>
                                            <div class="col-md-10 col-sm-8 col-xs-12">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-md-offset-0 col-sm-6 col-xs-6 form-group">
                                                        <span><label>Full Name:</label>
                                                            <input type="text" class="form-control" value="<?php echo "$firstname $middlename $lastname" ?>" readonly></span>
                                                    </div>
                                                    <div class="col-md-12 col-md-offset-0 col-sm-6 col-xs-6 form-group">
                                                        <label>Nickname:</label>
                                                        <input type="text" class="form-control" name="nickname" value="<?php echo $nickname ?>" readonly>
                                                    </div>
                                                    <div class="col-md-12 col-md-offset-0 col-sm-6 col-xs-6 form-group">
                                                        <label>Gender:</label>
                                                        <input type="text" class="form-control" name="gender" value="<?php echo $gender ?>" readonly>
                                                    </div>
                                                    <div class="col-md-12 col-md-offset-0 col-sm-6 col-xs-6 form-group">
                                                        <label>Strand:</label>
                                                        <input type="text" class="form-control" name="party" value="<?php echo $strand_name ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-md-offset-0 col-sm-6 col-xs-6 form-group">
                                                        <label>Level:</label>
                                                        <input type="text" class="form-control" name="party" value="<?php echo $level ?>" readonly>
                                                    </div>
                                                    <div class="col-md-12 col-md-offset-0 col-sm-6 col-xs-6 form-group">
                                                        <label>Position:</label>
                                                        <input type="email" class="form-control" name="position" value="<?php echo $position ?>" readonly>
                                                    </div>
                                                    <div class="col-md-12 col-md-offset-0 col-sm-6 col-xs-6 form-group">
                                                        <label>Partylist:</label>
                                                        <input type="text" class="form-control" name="party" value="<?php echo $party ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <?php include'include/footer.php';?>
        </div>
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
    </body>
</html>
