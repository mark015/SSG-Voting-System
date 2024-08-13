<?php
    require_once'include/config.php';
    include'include/auth.php';
    //header('refresh:2; report_election.php');

    date_default_timezone_set("Asia/Manila");
    $date = date('Y');
	$query = "SELECT count(status) FROM `tbl_students` where status='voted'";
	$result_object = mysqli_query($mysql_connection_object, $query);
	$stat_data = mysqli_fetch_assoc($result_object);
	$query = "SELECT count(*) FROM `tbl_students`";
	$result_object = mysqli_query($mysql_connection_object, $query);
	$stud_data = mysqli_fetch_assoc($result_object);
	$total = ($stat_data['count(status)'] / $stud_data['count(*)']) * 100;
	$total1 = number_format($total);
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
        
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <style>
            input[type="checkbox"]:checked+span{
                color: red;

            }
            input[type="checkbox"]{
                display: none;
            }

            input[type="radio"]:checked+span{
                color: red;

            }
            input[type="radio"]{
                display: none;
            }

            .b{
                border-radius: 10px;
                border: solid 2px;
                height: 70px;
                width: 70px;
                padding-top: 0px;
                padding-bottom: 0px;
            }
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
                    <div class="page-title hidden-print">
                        <div class="title_left">
                            <h3><b>Reports</b></h3>
							
                        </div>
                    </div>
                    <div class="hidden_div" style="text-align: center">
                        <h3>Election Result <small><?php echo $date;?></small></h3>
						<h3>
						   Voters Turnout:
							<?php
								echo $total1 . "%";
							?>
						</h3> 
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title hidden-print"> 
                                    <h2>Election Result <?php echo $date;?></h2>
                                    <ul class="nav navbar-right panel_toolbox hidden-print">
                                        <li>
                                            <form method="post" action="pdf_election.php">
                                                <button type="submit" class="btn btn-sm btn-danger" name="generate_pdf"><i class='fa fa-file-pdf-o'> PDF</i></button>
                                            </form>
                                        </li>
                                        <li><button class="btn btn-sm btn-dark" onclick="window.print()"><i class='fa fa-print'> Print</i></button></li>
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
                                <form method="post" action="voting_process1.php">
                                    <h4>Voters Turnout:<?php echo $total1 . "%";?></h4> 
                                    <?php 
                                        for($x = 1; $x <= 10; $x++ ){
                                    ?>
                                    <div class="x_content">
                                        <div class="table-responsive">
                                            <table class="col-md-12 table table-hover">
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title">Full Name</th>
                                                        <th class="column-title">Nickname</th>
                                                        <th class="column-title">Party</th>
                                                        <th class="column-title">Level</th>
                                                        <th class="column-title">Votes</th>
                                                    </tr>
                                                </thead>
                                                <?php 
                                                    $sql="select * from tbl_positions where pos_id='$x' ";
                                                    $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                    $qry=$mysql_connection_object->prepare($sql);
                                                    $qry->execute();
                                                    $qry->bind_result($pos_id , $position);
                                                    while($qry->fetch()) {
                                                        echo "<h2><strong>$position<strong></h2>";
                                                    }
                                                ?>
                                                <tbody>
                                                    <?php
                                                        $query = "SELECT COUNT(tbl_votes.c_id), tbl_positions.position FROM tbl_candidates INNER JOIN tbl_votes ON tbl_candidates.c_id=tbl_votes.c_id INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id WHERE tbl_positions.pos_id='$x' GROUP By tbl_votes.c_id ORDER BY COUNT(tbl_votes.c_id) DESC ";
                                                        $result_object = mysqli_query($mysql_connection_object, $query);
                                                        $count_data = mysqli_fetch_assoc($result_object);														
                                                        $sql="	SELECT COUNT(tbl_votes.c_id), tbl_positions.position,tbl_candidates.c_id, tbl_candidates.nickname, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename, tbl_students.level, tbl_party.party FROM tbl_candidates INNER JOIN tbl_votes ON tbl_candidates.c_id=tbl_votes.c_id INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.pos_id='$x'  GROUP By tbl_votes.c_id order by COUNT(tbl_votes.c_id) DESC";
                                                        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                        $qry=$mysql_connection_object->prepare($sql);
                                                        $qry->execute();
                                                        $qry->bind_result($vote_counts,$position ,$c_id, $nickname, $lastname, $firstname, $middlename, $level, $party);
                                                        while($qry->fetch()) {
                                                            echo "<tr>

                                                                    <td style='width:40%;'>$lastname, $firstname $middlename</td>
                                                                    <td>$nickname</td>
                                                                    <td>$party</td>
                                                                    <td>$level</td>
                                                                    <td style='width:5%;'>$vote_counts</td>
                                                                </tr>
                                                                ";
														}
															
                                                        if($vote_counts == $count_data['COUNT(tbl_votes.c_id)']){
                                                            echo "
                                                                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='.bs-example-modal-lg'>Select Candidates</button>";
                                                            echo "
                                                                <div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' aria-hidden='true'>
                                                                    <div class='modal-dialog modal-lg'>
                                                                        <div class='modal-content'>
                                                                            <div class='modal-header'>
													                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
													                           <h4 class='modal-title' id='myModalLabel2'> $position</h4>
													                       </div>
                                                                           <div class='modal-body'>";
                                                                            $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_candidates.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id WHERE tbl_positions.pos_id = '$pos_id'");
                                                                            while($row = mysqli_fetch_assoc($query)){
                                                                                $c_id = $row['c_id'];
                                                                                $fname = $row['firstname'];
                                                                                $mname = $row['middlename'];
                                                                                $lname = $row['lastname'];
                                                                                $nname = $row['nickname'];
                                                                                $c_image = $row['c_image'];
                                                                                $position = $row['position'];
                                                                                $party = $row['party'];
                                                                                echo"
                                                                                    <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6'><br>
                                                                                    <label style='display: block; color: black;'>
                                                                                        <center>
                                                                                            <image class='b' src='images/$c_image'></image><br>
                                                                                        </center>
                                                                                        <div>
                                                                                            <input type='radio' name='secr[]' value='$c_id' required>
                                                                                            <span>
                                                                                                Name: $fname  $mname  $lname<br>
                                                                                                Nickname: $nname<br>
                                                                                                Partylist: $party<br>
                                                                                            </span><br>
                                                                                        </div>
                                                                                    </label>
                                                                                </div>";
                                                                            }
                                                            echo"
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                                    <button type='submit' name='vote' class='btn btn-primary'>Save changes</button>
                                                                </div>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php ?>		      
                                        </div>		
                                    </div>
								<?php }
									 ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include'include/footer.php';?>
        </div>
        <!-- /footer content -->
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


