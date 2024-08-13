<?php
    require_once'include/config.php';
    include'include/auth.php';
    date_default_timezone_set("Asia/Manila");  
    $date=date("Y-m-d"); 

    function fetch_data() {  
        include'include/config.php';
        $output = ''; 					
        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
        $sql="SELECT * FROM tbl_students INNER JOIN tbl_strands ON tbl_students.strand_id=tbl_strands.strand_id WHERE status != 'Voted' ORDER BY lastname"; 
        $result = mysqli_query($mysql_connection_object, $sql) or die(mysqli_error($mysql_connection_object)); 
        $x = 0;
        while($row = mysqli_fetch_array($result)) {       
            $x++;
            if($row["cellphone"] == 0){
                $row["cellphone"] = "";
            }
            $output .= '<tr> 
                            <td>'.$x.'</td>  
                            <td>'.$row["lrn_no"].'</td>  
                            <td>'.$row["lastname"].", ".$row["firstname"]." ".$row["middlename"].'</td>  
                            <td>'.$row["gender"].'</td>  
                            <td>'.$row["street"]. " " .$row["barangay"]. ", " .$row["city"]. ", " .$row["province"].'</td>    
                            <td>'.$row["level"].'</td>  
                            <td>'.$row["strand_name"].'</td>  
                            <td>'.$row["cellphone"].'</td>  
                        </tr>';  
        }
        return $output;  
    } 

    if(isset($_POST["generate_pdf"])) {  
        require_once('tcpdf/tcpdf.php');
        $sql = "SELECT * FROM tbl_settings";
        $result = mysqli_query($mysql_connection_object, $sql);
        $set_data = mysqli_fetch_assoc($result);
        
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $obj_pdf->SetCreator(PDF_CREATOR);  
        $obj_pdf->SetTitle("SSG Voting System");  
        $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $obj_pdf->SetDefaultMonospacedFont('helvetica');  
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
        $obj_pdf->setPrintHeader(false);  
        $obj_pdf->setPrintFooter(false);  
        $obj_pdf->SetAutoPageBreak(TRUE, 10);  
        $obj_pdf->SetFont('helvetica', '', 10);  
        $obj_pdf->AddPage();  
        $content = '';  
        $content .= '  
            <div class="print_this">
                <p1>Republic of the Philippines</p1><br>
                <p1>Department of Education</p1><br>
                <p1>Region VI - Western Visayas</p1><br>
                <p1>Division of Sagay City</p1><br>
                <p1><strong>Sagay City Senior High School</strong></p1>
            </div>
            <p1>___________________________________________________________________________________________</p1>
            <h3>List of In-active Voters</h3>
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="1" style="text-align: center;">
                <tr>  
                    <th width="5%">NO.</th>  
                    <th width="15%">LRN</th>  
                    <th width="20%">Name</th>  
                    <th width="8%">Gender</th>  
                    <th width="20%">Address</th> 
                    <th width="10%">Grade</th>  
                    <th width="10%">Strand</th> 
                    <th width="12%">Contact</th> 
                </tr>';  
        $content .= fetch_data();  
        $content .= '</table>';  
        $obj_pdf->writeHTML($content);  
        $obj_pdf->Output('report_inactive.pdf', 'I');  
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
                            <h3><b>Reports</b></h3>
                        </div>
                    </div>
                    <div class="hidden_div" style="text-align: center">
                        <h3>List of In-active Voters</h3>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>In-active Voters <small><?php echo $date; ?></small></h2>
                                    <ul class="nav navbar-right panel_toolbox hidden-print">
                                        <li>
                                            <form method="post">
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
                            <div class="x_content">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">No.</th>
                                                <th class="column-title" style="width: 75px">LRN No. </th>
                                                <th class="column-title">Name</th>
                                                <th class="column-title">Gender</th>
                                                <th class="column-title">Address</th>
                                                <th class="column-title">Level</th>
                                                <th class="column-title">Strand</th>
                                                <th class="column-title">Contact</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                echo fetch_data();
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
