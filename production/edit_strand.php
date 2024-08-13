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
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php
                    include'include/sidemenu.php'; 
                    include'include/topnav.php';
                    include'include/print.php';
                ?>
                
                <!-- page content -->
                <div class="right_col" role="main" style="background-image: url(images/<?php echo $set_data['bg_image'];?>); background-repeat: no-repeat; background-size: cover;">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3><b>Settings</b></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                            <!-- form input mask -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Add Strand</h2>
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
                                        <?php
                                            $s_id= $_GET['strand_id'];
                                            $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                            $sql = "SELECT * FROM tbl_strands INNER JOIN tbl_tracks ON tbl_strands.track_id=tbl_tracks.track_id WHERE strand_id=?";
                                            $qry=$mysql_connection_object->prepare($sql);
                                            $qry->bind_param("i",$s_id);
                                            $qry->execute();
                                            $qry->bind_result($strand_id, $track_id, $strand_name, $strand_desc, $track_id, $track_name, $track_desc);
                                            $qry->fetch();
                                        ?>
                                        <form method="post" action="editprocess.php" enctype="multipart/form-data">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="hidden" class="form-control" name="strand_id" value="<?php echo $s_id ;?>">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group">Strand Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="text" class="form-control has-feedback-left" name="strand_name" value="<?php echo $strand_name ;?>" required="" />
                                                        <span class="glyphicon glyphicon-education form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group">Strand Category: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0 form-group">
                                                        <select class="form-control has-feedback-left" name="track_name">
                                                            <option selected value="<?php echo $track_name; ?>"><?php echo $track_name; ?></option>
                                                            <?php 
                                                                $sql = "SELECT track_name FROM tbl_tracks";
                                                                $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
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
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group">Strand Description: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <textarea class="form-control" name="strand_desc" value="<?php echo $strand_desc; ?>"></textarea>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin-left: 10px;">
                                                    <button type="submit" name="edit_strand" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> Update</button>
                                                    <a href="form_strand.php" class="btn btn-warning" type="button"><i class='fa fa-reply'> Cancel</i></a>
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
