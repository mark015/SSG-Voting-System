<?php
    require_once'include/config.php';
    include'include/auth.php';
    date_default_timezone_set("Asia/Manila");  
    $date=date("Y-m-d"); 
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
                            <h3><b>Records</b></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Students <small>Grade 11</small></h2>
                                    <ul class="nav navbar-right panel_toolbox hidden-print">
                                        <li><a class="btn btn-default btn-xs" href='form_students.php'><i class='fa fa-user-plus'> Add</i></a></li>
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title hidden-print" style="width: 75px">Action</th>
                                                <th class="column-title">No. </th>
                                                <th class="column-title" style="width: 75px">LRN No. </th>
                                                <th class="column-title">Name</th>
                                                <th class="column-title">Gender</th>
                                                <th class="column-title">Age</th>
                                                <th class="column-title">Address</th>
                                                <th class="column-title">Strand</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												$query = "SELECT * FROM `tbl_settings`";
												$result_object = mysqli_query($mysql_connection_object, $query);
												$elec_data = mysqli_fetch_assoc($result_object);
                                                $sql="SELECT * FROM tbl_students INNER JOIN tbl_strands ON tbl_students.strand_id=tbl_strands.strand_id WHERE level='Grade 11' ORDER BY lastname";
                                                $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                $qry=$mysql_connection_object->prepare($sql);
                                                $qry->execute();
                                                $qry->bind_result($lrn_no, $track_id, $strand_id, $lastname, $firstname, $middlename, $ext_name, $gender, $bdate, $street, $barangay, $city, $province, $postal_code, $country, $mother, $father, $guardian, $telephone, $cellphone, $email, $level, $pass, $status, $strd_id, $strd_tid,$strd_name, $strd_description);
                                            
                                                $x = 0;
												if($date == $elec_data['election_date']){
                                                    while($qry->fetch()) {
                                                        $diff=date_diff(date_create($bdate),date_create($date));
                                                        $age=$diff->format('%y');
                                                        $x++;

                                                        echo "<tr>
                                                                <td class='hidden-print'>
                                                                    <a class='btn btn-info btn-xs' title='View' href='view_student.php?lrn_no=$lrn_no'><i class='fa fa-folder'></i></a>
                                                                    <a class='btn btn-warning btn-xs hide' title='Edit' href='edit_student.php?lrn_no=$lrn_no'><i class='fa fa-edit'></i></a>
                                                                    <a class='btn btn-danger btn-xs hide' title='Delete' href='deleteprocess.php?lrn_no=$lrn_no' onClick='return confirm(\"Press OK to confirm.\")'><i class='fa fa-trash-o'></i></a>
                                                                </td>
                                                                <td>$x</td>
                                                                <td>$lrn_no</td>
                                                                <td>$lastname, $firstname $ext_name $middlename</td>
                                                                <td>$gender</td>
                                                                <td>$age</td>
                                                                <td>$street $barangay, $city</td>
                                                                <td>$strd_name</td>
                                                            </tr>"; 
                                                        }
													} else {
                                                        while($qry->fetch()) {
                                                             $diff=date_diff(date_create($bdate),date_create($date));
                                                             $age=$diff->format('%y');
                                                             $x++;

                                                             echo "<tr>
                                                                <td class='hidden-print'>
                                                                    <a class='btn btn-info btn-xs ' title='View' href='view_student.php?lrn_no=$lrn_no'><i class='fa fa-folder'></i></a>
                                                                    <a class='btn btn-warning btn-xs ' title='Edit' href='edit_student.php?lrn_no=$lrn_no'><i class='fa fa-edit'></i></a>
                                                                    <a class='btn btn-danger btn-xs ' title='Delete' href='deleteprocess.php?lrn_no=$lrn_no' onClick='return confirm(\"Press OK to confirm.\")'><i class='fa fa-trash-o'></i></a>
                                                                </td>
                                                                <td>$x</td>
                                                                <td>$lrn_no</td>
                                                                <td>$lastname, $firstname $ext_name $middlename</td>
                                                                <td>$gender</td>
                                                                <td>$age</td>
                                                                <td>$street $barangay, $city</td>
                                                                <td>$strd_name</td>
                                                                </tr>"; 
                                                         }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Students <small>Grade 12</small></h2>
                                    <ul class="nav navbar-right panel_toolbox hidden-print">
                                        <li><a class="btn btn-default btn-xs" href='form_students.php'><i class='fa fa-user-plus'> Add</i></a></li>
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
                                <div class="table-responsive">
                                    <table id="datatable-fixed-header" class="table table-hover">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title hidden-print" style="width: 75px">Action</th>
                                                <th class="column-title">No. </th>
                                                <th class="column-title" style="width: 75px">LRN No. </th>
                                                <th class="column-title">Name</th>
                                                <th class="column-title">Gender</th>
                                                <th class="column-title">Age</th>
                                                <th class="column-title">Address</th>
                                                <th class="column-title">Strand</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$sql="SELECT * FROM tbl_students INNER JOIN tbl_strands ON tbl_students.strand_id=tbl_strands.strand_id WHERE level='Grade 12' ORDER BY lastname";
											$mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
											$qry=$mysql_connection_object->prepare($sql);
											$qry->execute();
											$qry->bind_result($lrn_no, $track_id, $strand_id, $lastname, $firstname, $middlename, $ext_name, $gender, $bdate, $street, $barangay, $city, $province, $postal_code, $country, $mother, $father, $guardian, $telephone, $cellphone, $email, $level, $pass, $status, $strd_id, $strd_tid,$strd_name, $strd_description);

											$x = 0;
											if($date == $elec_data['election_date']){
                                                while($qry->fetch()) {
                                                    $diff=date_diff(date_create($bdate),date_create($date));
                                                    $age=$diff->format('%y');
                                                    $x++;
													
                                                    echo "<tr>
                                                            <td class='hidden-print'>
                                                                <a class='btn btn-info btn-xs' title='View' href='view_student.php?lrn_no=$lrn_no'><i class='fa fa-folder'></i></a>
                                                                <a class='btn btn-warning btn-xs hide' title='Edit' href='edit_student.php?lrn_no=$lrn_no'><i class='fa fa-edit'></i></a>
                                                                <a class='btn btn-danger btn-xs hide' title='Delete' href='deleteprocess.php?lrn_no=$lrn_no' onClick='return confirm(\"Press OK to confirm.\")'><i class='fa fa-trash-o'></i></a>
                                                            </td>
                                                            <td>$x</td>
                                                            <td>$lrn_no</td>
                                                            <td>$lastname, $firstname $ext_name $middlename</td>
                                                            <td>$gender</td>
                                                            <td>$age</td>
                                                            <td>$street $barangay, $city</td>
                                                            <td>$strd_name</td>
                                                        </tr>"; 
                                                }
                                            } else {
                                                while($qry->fetch()) {
                                                    $diff=date_diff(date_create($bdate),date_create($date));
                                                    $age=$diff->format('%y');
                                                    $x++;
                                                    echo "<tr>
                                                            <td class='hidden-print'>
                                                                <a class='btn btn-info btn-xs' title='View' href='view_student.php?lrn_no=$lrn_no'><i class='fa fa-folder'></i></a>
                                                                <a class='btn btn-warning btn-xs' title='Edit' href='edit_student.php?lrn_no=$lrn_no'><i class='fa fa-edit'></i></a>
                                                                <a class='btn btn-danger btn-xs' title='Delete' href='deleteprocess.php?lrn_no=$lrn_no' onClick='return confirm(\"Press OK to confirm.\")'><i class='fa fa-trash-o'></i></a>
                                                            </td>
                                                            <td>$x</td>
                                                            <td>$lrn_no</td>
                                                            <td>$lastname, $firstname $ext_name $middlename</td>
                                                            <td>$gender</td>
                                                            <td>$age</td>
                                                            <td>$street $barangay, $city</td>
                                                            <td>$strd_name</td>
                                                        </tr>"; 
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
