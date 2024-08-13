<?php
    require_once'include/config.php';
    include'include/auth.php';
    date_default_timezone_set("Asia/Manila");
    $date = date('Y');
    $date1 = date('d');
	$date2 = date('Y-m-d');

    if(isset($_POST['btn_set_date'])){
        $elec_date = isset($_POST['elec_date']) ? $_POST['elec_date'] : "";
        $elec_time_start = isset($_POST['elec_time_start']) ? $_POST['elec_time_start'] : "";
        $elec_time_end = isset($_POST['elec_time_end']) ? $_POST['elec_time_end'] : "";
        
        $sql="UPDATE tbl_settings SET election_date=?, start_time=?, end_time=?";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("sss", $elec_date, $elec_time_start, $elec_time_end);
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
                                <h3><b>Settings</b></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Set Election<small>Date</small></h2>
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
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group">Set Election Day: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input class="form-control has-feedback-left" type="date" name="elec_date">
                                                    <span class="glyphicon glyphicon-calendar form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group">Set Election Start Time: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input class="form-control has-feedback-left" type="time" name="elec_time_start">
                                                    <span class="glyphicon glyphicon-calendar form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group">Set Election End Time: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input class="form-control has-feedback-left" type="time" name="elec_time_end">
                                                    <span class="glyphicon glyphicon-calendar form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin-left: 10px;">
                                                <button type="submit" name="btn_set_date" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Set</button>
                                            </div>
                                        </form>                                      
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Archieve<small>Date</small></h2>
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
                                        <form action="" method="post">

                                            <?php
                                            $query = "SELECT * FROM `tbl_settings`";
                                            $result_object = mysqli_query($mysql_connection_object, $query);
                                            $elec_data = mysqli_fetch_assoc($result_object);
											
											$query = "SELECT * FROM `tbl_archive`";
											$result_object = mysqli_query($mysql_connection_object, $query);
											$archive_data = mysqli_fetch_assoc($result_object);
											
                                            if($elec_data['election_date'] >	 $date){ ?>
                                            <button class="btn btn-ms btn-danger" type="submit" name="archive"><i class='fa fa-save'> Archive</i></button>
                                            <?php }else{

                                            } ?>
                                        </form>	                             
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
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
<?php
	if (isset($_POST['archive'])){
	for($x = 0 ; $x < 11; $x++){
		 $qry =mysqli_query($mysql_connection_object,"SELECT COUNT(tbl_votes.c_id), tbl_positions.position,  tbl_party.party,  tbl_candidates.year, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename, tbl_students.level FROM tbl_candidates INNER JOIN tbl_votes ON tbl_candidates.c_id=tbl_votes.c_id INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id where tbl_positions.pos_id='$x' GROUP By tbl_votes.c_id order by COUNT(tbl_votes.c_id)  desc");
		  while($row = mysqli_fetch_assoc($qry)){	
			  $count = $row['COUNT(tbl_votes.c_id)'];
			  $position = $row['position'];
			  $party = $row['party'];
			  $year = $row['year'];
			  $lname = $row['lastname'];
			  $fname = $row['firstname'];
			  $mname = $row['middlename'];
			  $level = $row['level'];
			  if($archive_data['year'] == $date){
				  echo "<script>
					  alert('Record Exist!');
					  window.location.href='election_date.php';
					</script>";
														
				}
			  else{
				 mysqli_query($mysql_connection_object,"INSERT INTO `tbl_archive`( `firstname` , `middle` , `lastname`, `position`, `partylist`, `year_level`, `votes`, `year`) VALUES('$fname', '$mname', '$lname', '$position', '$party', '$level' , '$count' , '2017' )");
				  echo $count . " " . $fname . " " . $position . "<br>"; 
				  echo "<script>
					  alert('Archive Candidates Records!!');
					  window.location.href='election_date.php';
					</script>";
				}  
			  }
	}

}
	
