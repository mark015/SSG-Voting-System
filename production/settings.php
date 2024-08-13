<?php
    require_once'include/config.php';
    include'include/auth.php';

    if(isset($_POST['default'])){
        $default = 'default_bg.jpg';
        
        $sql="UPDATE tbl_settings SET bg_image=?";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("s", $default);
        $qry->execute();
        echo "<script>
                alert('Data Reset to Default!!');
                window.location.href='settings.php';
            </script>";
    }

    if(isset($_POST['change_bg_image'])){
    $bg_image = isset($_POST['bg_image']) ? $_POST['bg_image'] : "";
	$images = $_FILES['bg_image']['name'];
	$tmp_dir = $_FILES['bg_image']['tmp_name'];
	$imgSize = $_FILES['bg_image']['size'];
        
    if($imgSize < 5000000) {
        move_uploaded_file($tmp_dir,"images/$images");
    } else {
        $_SESSION['MSG'] = "<script> alert ('Sorry, your file is too large.')";
    }
        $sql="UPDATE tbl_settings SET bg_image=?";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("s", $images);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='settings.php';
            </script>";
    }

    if(isset($_POST['change_logo'])){
    $logo = isset($_POST['logo']) ? $_POST['logo'] : "";
	$image = $_FILES['logo']['name'];
	$tmp_dir = $_FILES['logo']['tmp_name'];
	$imgSize = $_FILES['logo']['size'];
        
    if($imgSize < 5000000) {
        move_uploaded_file($tmp_dir,"images/$image");
    } else {
        $_SESSION['MSG'] = "<script> alert ('Sorry, your file is too large.')";
    }
        $sql="UPDATE tbl_settings SET logo=?";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("s", $image);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='settings.php';
            </script>";
    }

    if(isset($_POST['change_sch_name'])){
        $sch_name = isset($_POST['sch_name']) ? $_POST['sch_name'] : "";

        $sql="UPDATE tbl_settings SET school_name=?";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("s", $sch_name);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='settings.php';
            </script>";
    }
    
    if(isset($_POST['btn_set'])){
        $elec_date = isset($_POST['elec_date']) ? $_POST['elec_date'] : "";

        $sql="UPDATE tbl_settings SET election_date=?";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("s", $elec_date);
        $qry->execute();
        echo "<script>
                alert('Succesfully Set!!');
                window.location.href='settings.php';
            </script>";
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
    </head>
    
    <script language="javascript" type="text/javascript">
		function previewImage() {
			document.getElementById("image-preview").style.display = "block";
			var oFReader = new FileReader();
			 oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

			oFReader.onload = function(oFREvent) {
			  document.getElementById("image-preview").src = oFREvent.target.result;
			};
		  };
		function previewImage1() {
			document.getElementById("image-preview1").style.display = "block";
			var oFReader = new FileReader();
			 oFReader.readAsDataURL(document.getElementById("image-source1").files[0]);

			oFReader.onload = function(oFREvent) {
			  document.getElementById("image-preview1").src = oFREvent.target.result;
			};
		  };
    </script>
    
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
                                <h3><b>System Configuration</b></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                            <div class="clearfix"></div>
                            <?php
                                $sql = "SELECT * FROM tbl_settings";
                                $qry=$mysql_connection_object->prepare($sql);
                                $qry->execute();
                                $qry->bind_result($id, $date, $start, $end, $logo, $school_name, $bg_image);
                                $qry->fetch();
                            ?>
                            <!-- form input mask -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>School Logo</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm"><i class='fa fa-edit'> Change</i></button></li>
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
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="height: 350px;">
                                            <!-- Small modal -->
                                            <br>
                                            <img src="images/<?php echo $logo; ?>" style="width: 100%; height: 80%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel2">Change Logo</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12 col-md-offset-0 form-group"><br>
                                                        <img  id="image-preview" src="images/<?php echo $logo; ?>" style="width:100%; height: 260px; background-color: black; "/>
                                                        <input type="file" class="form-control" id="image-source" onchange="previewImage();" name="logo"  accept="image/png, image/jpeg, image/gif" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="change_logo" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- form input mask -->
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>School Name</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg"><i class='fa fa-edit'> Change</i></button></li>
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
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="height: 350px;">
                                            <h1 style="font-family: Elephant; font-size: 70px;" align="center"><?php echo "$school_name"; ?></h1>
                                        </div>                  
                                    </div>
                                </div>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <form method="post" action="">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Change School Name</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group"><br>
                                                        <input type="text" class="form-control" name="sch_name" value="<?php echo $school_name; ?>" required="" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="change_sch_name" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Background Image</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><form method="post" action=""><button type="submit" name="default" class="btn btn-sm btn-dark"> Default</button></form></li>
                                            <li><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bs-example-modal-ms1"><i class='fa fa-edit'> Change</i></button></li>
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
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <!-- Small modal -->
                                            <img src="images/<?php echo $bg_image; ?>" style="width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bs-example-modal-ms1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel3">Change Background</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12 col-md-offset-0 form-group"><br>
                                                        <img  id="image-preview1" src="images/<?php echo $bg_image; ?>" style="width:100%; height: 260px; background-color: black; "/>
                                                        <input type="file" class="form-control" id="image-source1" onchange="previewImage1();" name="bg_image"  accept="image/png, image/jpeg, image/gif" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="change_bg_image" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
