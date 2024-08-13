<?php

    require_once'include/config.php';
    include'include/auth.php';
	date_default_timezone_set("Asia/Manila");
    $date = date('Y');
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
		<script src="pdfmake.min.js"></script>
        
        <style>
            body {
                width: 100%;
                height: 100%;
                margin: 0px;
            }
            .print_this{
                display: none;
                text-align: center;
            }
            .hide_div{
                display: none;
            }
            @media print {
                .hide_div{
                    display:block;
                }
                .print_this{
                    display:block;
                }
            }
        </style>     
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php
                    include 'include/sidemenu.php'; 
                    include 'include/topnav.php';
                    include 'include/print.php';
                ?>

                <!-- page content -->
                <div class="right_col" role="main" style="background-image: url(images/<?php echo $set_data['bg_image'];?>); background-repeat: no-repeat; background-size: cover;">
                    <div class="page-title hidden-print">
                        <div class="title_left">
                            <h3><b>Reports</b></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <form action="pdf_report_elect.php" method="post">
                                        <h2>Officially Elected<small><?php echo $date; ?></small></h2>
                                        <ul class="nav navbar-right panel_toolbox hidden-print">
                                            <li>
                                                <button type="submit" class="btn btn-sm btn-danger" name="generate_pdf"><i class='fa fa-file-pdf-o'> PDF</i></button>
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
                                    </form>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    
                                    <div class="table-responsive">
                                        <table class="col-md-12 table table-hover" id="datatable-button" >
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title">Position</th>
                                                    <th class="column-title">Full Name</th>
                                                    <th class="column-title">Nickname</th>
                                                    <th class="column-title">Party</th>
                                                    <th class="column-title">Level</th>
                                                    <th class="column-title">Votes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php	
                                                    for($x=1; $x<=10;$x++){
														if($x == 8 || $x == 9) {
			                                                $sql="SELECT COUNT(tbl_votes.c_id) , tbl_candidates.c_id, tbl_candidates.nickname,  tbl_positions.position, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename, tbl_students.level, tbl_party.party FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_votes ON tbl_candidates.c_id=tbl_votes.c_id INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.pos_id='$x' group by tbl_votes.c_id ORDER BY COUNT(tbl_votes.c_id) DESC LIMIT 2";
                                                            $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                            $qry=$mysql_connection_object->prepare($sql);
                                                            $qry->execute();
                                                            $qry->bind_result($votes, $c_id, $nickname, $position, $lastname, $firstname, $middlename, $level, $party);
                                                            while($qry->fetch()) {
                                                                echo "<tr>
                                                                        <td>$position</td>
                                                                        <td>$lastname, $firstname $middlename</td>
                                                                        <td>$nickname</td>
                                                                        <td>$party</td>
                                                                        <td>$level</td>
                                                                        <td>$votes</td>
                                                                    </tr>";
															}
															
														}else{
			                                                $sql="SELECT COUNT(tbl_votes.c_id) , tbl_candidates.c_id, tbl_candidates.nickname,  tbl_positions.position, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename, tbl_students.level, tbl_party.party FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_votes ON tbl_candidates.c_id=tbl_votes.c_id INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.pos_id='$x' group by tbl_votes.c_id ORDER BY COUNT(tbl_votes.c_id) DESC limit 1";
                                                            $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                            $qry=$mysql_connection_object->prepare($sql);
                                                            $qry->execute();
                                                            $qry->bind_result($votes, $c_id, $nickname, $position, $lastname, $firstname, $middlename, $level, $party);
                                                            while($qry->fetch()) {
                                                                echo "<tr>
                                                                        <td>$position</td>
                                                                        <td>$lastname, $firstname $middlename</td>
                                                                        <td>$nickname</td>
                                                                        <td>$party</td>
                                                                        <td>$level</td>
                                                                        <td>$votes</td>
                                                                    </tr>"; 

                                                            };
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
                </div>
				
				
                <?php include'include/sign.php';?>
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
		<script src="export/FileSaver.js"></script>
		<script src="export/java.js"></script>
		<script type="text/javascript">
			          jQuery(function ($) {
                $("#pdf").click(function () {
                    // parse the HTML table element having an id=exportTable
                    var dataSource = shield.DataSource.create({
                        data: "#datatable-button",
                        schema: {
                            type: "table",
                            fields: {
                                    Position: { type: String },
                                    FullName: { type: String },
                                   Nickname: { type: String },
                                    Partylist: { type: String },
                                    Level: { type: String },
                                    Votes: { type: String }
                                    
                            }
                        }
                    });

                    // when parsing is done, export the data to PDF
		                   dataSource.read().then(function (data) {
                        var pdf = new shield.exp.PDFDocument({
                            author: "PrepBootstrap",
                            created: new Date()
                        });
                        pdf.addPage("a4", "portrait");
                        
                        pdf.table(
                           
                            50,
                            30,
                            data,
                            [   
								
                                { field: "Position", title: "Position", width: 60 },
                                { field: "Full Name", title: "Full Name", width: 130 },
                                { field: "Nickname", title: "Nickname", width: 130 },
                                { field: "Partylist", title: "Partylist", width: 100 },
                                { field: "Level", title: "Level", width: 70 },
                                { field: "Votes", title: "Votes", width: 70 }
                            ],
                            {
                                margins: {
                                    top: 20,
                                    left: 50,
                                    right:40,
                                    bottom:20
                                }
                            }
                        );

                        pdf.saveAs({
                            fileName: "all files"
                        });
                    });
                });
            });
        </script>
    </body>
</html>