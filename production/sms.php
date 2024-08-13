<?php
    require_once'include/config.php';
    include'include/auth.php';
    /*---------UNUSED API CODE--------
    TR-ROMUL226816_7WIJJ 
    TR-REYMA809320_YSN4A 
    --------------------------------*/
    if ( isset( $_POST['btn_send'] ) ) {
        $number = $_POST['number'];
        $name = 'SCSHS SSG Voting';
        $msg = $_POST['msg'];
        $api = "TR-KENNE494804_NQYWJ";
        
        if(!empty(($_POST['number']) && ($_POST['msg']))){
            if($result = itexmo($number,$msg,$api)){
                if ($result == ""){
                    echo "
                        <script>
                            alert('iTexMo: No response from server!!!
                            Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                            Please CONTACT US for help.');
                            window.location.href='sms.php';
                        </script>;
                    ";  
                } else if ($result == 0){
                    echo "
                    <script>
                        alert('Message Succesfully Sent!');
                        window.location.href='sms.php';
                    </script>";
                } else {   
                    echo "Error Num ". $result . " was encountered!";
                }
            } else{
                echo "";
            }
        }
    }

    function itexmo($number, $msg, $api){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $msg, '3' => $api);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }

    if(isset($_POST['btn_save'])){
        $date_to_send = $_POST['date_to_send'];
        //$time_to_send = $_POST['time_to_send'];
        $msg_content = $_POST['msg_content'];
        
        $query = "INSERT INTO `tbl_messages`(`msg_content`, `date_to_send`) VALUES ('$msg_content','$date_to_send')";
        $result = mysqli_query($mysql_connection_object, $query);
        if ($result == TRUE) {
            echo "<script>
                alert('Succesfully Added!!');
                window.location.href='sms.php';
            </script>";
        } else { 
            echo "<script>
                    alert('Registration Failed!! Something went wrong.');
                </script>";
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
                                <h3><b>Settings</b></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                            <!-- form input mask -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Create SMS<small></small></h2>
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
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group">Date to Send: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="date" class="form-control" name="date_to_send" required="" >
                                                    </div>
                                                </div>
                                                <!--
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group">Time to Send: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="time" class="form-control" name="time_to_send" required="" >
                                                    </div>
                                                </div>
                                                -->
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group">Message Content: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <textarea class="form-control" name="msg_content" maxlength="100" placeholder="Your Message....." required="" ></textarea>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin-left: 10px;">
                                                        <button type="submit" name="btn_save" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Messages<small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox hidden-print">
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
                                            <table id="datatable" class="col-md-12 table table-hover">
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title">Message Content </th>
                                                        <th class="column-title">Date To be Send</th>
                                                        <th class="column-title no-link last hidden-print" style="width: 80px"><span class="nobr">Action</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql="SELECT * FROM tbl_messages ORDER BY date_added ASC";
                                                        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
                                                        $qry=$mysql_connection_object->prepare($sql);
                                                        $qry->execute();
                                                        $qry->bind_result($msg_id, $msg_content, $date_to_send, $timeto_send, $date_added);
                                                        while($qry->fetch()) {
                                                            echo "<tr>
                                                                    <td>$msg_content</td>
                                                                    <td>$date_to_send</td>
                                                                    <td class='hidden-print'>
                                                                        <a class='btn btn-danger btn-xs' title='Delete' href='deleteprocess.php?msg_id=$msg_id' onClick='return confirm(\"Press OK to confirm.\")'><i class='fa fa-trash-o'> </i></a>
                                                                    </td>
                                                                </tr>"; 
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>		
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>SMS Notification<small>Single Send</small></h2>
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
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group">Mobile Number(11 digit): </label>
                                                <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                    <input class="form-control" type="number" name="number" maxlength="11" min="0" placeholder="09*********">
                                                </div>
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group">Message Content: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <textarea class="form-control" name="msg" placeholder="Your Message....." required="" ></textarea>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin-left: 10px;">
                                                    <button type="submit" name="btn_send" class="btn btn-success"><i class="fa fa-send" aria-hidden="true"></i> Send Now</button>
                                                </div>
                                            </div>
                                        </form>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
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
