<?php
    require_once'include/config.php';
    include'include/auth.php';
    // header('refresh:3; home.php');

    $sql = "SELECT *FROM tbl_students WHERE level='Grade 11'";
    $query = $mysql_connection_object->prepare($sql);
    $query->execute();
    $query->store_result();
    $query->fetch();
    $g1 = $query->num_rows();
    $sql = "SELECT *FROM tbl_students WHERE level='Grade 12'";
    $query = $mysql_connection_object->prepare($sql);
    $query->execute();
    $query->store_result();
    $query->fetch();
    $g2 = $query->num_rows();
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
            
        <script>
            function showHint(str){
                if(str.length == 0){
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else{
                    var xmlhttp = new XMLHttpRequest();
                    
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState==4 && xmlhttp.status==200){
                            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "search.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>        
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
                    <div class="col-md-12 col-sm-12 col-xs-12 hidden-print">
                        <div class="row tile_count">
                            <?php
                                $sql = "SELECT * FROM tbl_users";
                                $query = $mysql_connection_object->prepare($sql);
                                $query->execute();
                                $query->store_result();
                                $query->fetch();
                                $users = $query->num_rows();
                            ?>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-users" style="color: lightblue;"></i>
                                    </div>
                                    <div class="count"><?php echo $users ?></div>
                                    <h3>Users</h3>
                                    <p>Authorized</p>
                                </div>
                            </div>
                            <?php
                                $sql = "SELECT *FROM tbl_students";
                                $query = $mysql_connection_object->prepare($sql);
                                $query->execute();
                                $query->store_result();
                                $query->fetch();
                                $students = $query->num_rows();
                            ?>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="tile-stats info">
                                    <div class="icon"><i class="fa fa-users" style="color: gold;"></i>
                                    </div>
                                    <div class="count"><?php echo $students ?></div>
                                    <h3>Students</h3>
                                    <p>Enrolled</p>
                                </div>
                            </div>
                            <?php
                                $sql = "SELECT *FROM tbl_students WHERE status='Voted'";
                                $query = $mysql_connection_object->prepare($sql);
                                $query->execute();
                                $query->store_result();
                                $query->fetch();
                                $voted = $query->num_rows();
                            ?>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="tile-stats info">
                                    <div class="icon"><i class="fa fa-users" style="color: green;"></i>
                                    </div>
                                    <div class="count"><?php echo $voted ?></div>
                                    <h3>Students</h3>
                                    <p>Voted</p>
                                </div>
                            </div>
                            <?php
                                $sql = "SELECT *FROM tbl_students WHERE status='Inactive' || status='Active'";
                                $query = $mysql_connection_object->prepare($sql);
                                $query->execute();
                                $query->store_result();
                                $query->fetch();
                                $not_voted = $query->num_rows();
                            ?>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="tile-stats info">
                                    <div class="icon"><i class="fa fa-users" style="color: red;"></i>
                                    </div>
                                    <div class="count"><?php echo $not_voted ?></div>
                                    <h3>Students</h3>
                                    <p>Not Voted</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>                    
                    
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Students <small>Graph by Level</small></h2>
                                <ul class="nav navbar-right panel_toolbox hidden-print">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <canvas id="graph_can" width="317" height="350"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Students<small>Graph by Gender</small></h2>
                                <ul class="nav navbar-right panel_toolbox hidden-print">
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
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                    $sql="SELECT COUNT(gender),gender FROM tbl_students GROUP BY gender";
                                    $qry=$mysql_connection_object->prepare($sql);
                                    $qry->execute();
                                    $qry->bind_result($count,$level);
                                ?>
                                <canvas id="pie-chart" width="317" height="212" ></canvas>
                                <h6 style="text-align:center;">
                                <?php 
                                    while($qry->fetch()){
                                        echo"$level : $count&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                    } 
                                ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>                    
                    
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Students<small>Graph by Status</small></h2>
                                <ul class="nav navbar-right panel_toolbox hidden-print">
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
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                    $sql="SELECT COUNT(status),status FROM tbl_students GROUP BY status";
                                    $qry=$mysql_connection_object->prepare($sql);
                                    $qry->execute();
                                    $qry->bind_result($count,$status);
                                ?>
                                <canvas id="pie-charts" width="317" height="183" ></canvas>
                                <h6 style="text-align:center;">
                                <?php 
                                    while($qry->fetch()){
                                        echo"$status : $count&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                    } 
                                ?>
                                </h6>
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


<script>
    let c=graph_can.getContext('2d');
    let graph={users:0,teachers:0,studentss:0,uh:0,th:0,sh:0,total:0,users_color:"",teachers_color:"",students_color:""};
    function set_graph(uw,tw,sw,uc,tc,sc){
        graph.total=tw+sw;
        graph.teachers=tw;
        graph.users=uw;
        graph.students=sw;
        graph.users_color=uc;
        graph.teachers_color=tc;
        graph.students_color=sc;
        graph.pos=280;
        main();
    }

    let loop;
    function main(){
        loop=requestAnimationFrame(main);
        c.fillStyle="#ffffff";
        c.fillRect(0,10,graph_can.width,graph_can.height);
        c.save();
        c.fillStyle="#222222";
        c.textAlign="center";
        //c.font=" 18px Century Gothic ";
        //c.fillText("Table Graph", graph_can.width/2,33);
        c.restore();

        //c.fillStyle=graph.users_color;
        //c.fillRect(60,300,10,10);
        c.save();
        c.fillStyle="#222222";
        c.font="12px Century Gothic ";
        //c.fillText("Users("+graph.users+")",72,310);
        c.fillText("Grade 11("+graph.teachers+")",72,330);
        c.fillText("Grade 12("+graph.students+")",72,350);
        c.restore();
        c.fillStyle=graph.teachers_color;
        c.fillRect(60,320,10,10);
        c.fillStyle=graph.students_color;
        c.fillRect(60,340,10,10);

        label_();
        graph_();
    }

    function graph_(){
        graph.uh+=graph.users/40;
        graph.th+=graph.teachers/40;
        graph.sh+=graph.students/40;

        if(graph.users<=graph.uh&&graph.teachers<=graph.th&&graph.students<=graph.sh){
            cancelAnimationFrame(loop);
        }
        //c.fillStyle=graph.users_color;
        //c.fillRect((graph_can.width/2)-20-50,graph.pos-(graph.uh/graph.total)*200,40,(graph.uh/graph.total)*200);

        c.fillStyle=graph.teachers_color;
        c.fillRect((graph_can.width/2)-20+5,graph.pos-(graph.th/graph.total)*200,40,(graph.th/graph.total)*200)


        c.fillStyle=graph.students_color;
        c.fillRect((graph_can.width/2)-10+55,graph.pos-(graph.sh/graph.total)*200,40,(graph.sh/graph.total)*200)
    }

    function label_(){
        c.fillStyle="#222222";
        c.fillRect(graph_can.width/2-80,graph.pos-200,1,200);
        c.fillRect(graph_can.width/2-80,graph.pos-1,270,1);
        let w=200/10;
        c.save();
        c.font="10px Century Gothic";
        c.textAlign="center";

        for(let i=0;i<=10;i++){
            c.fillStyle="#222222";
            c.fillText((i/10)*100+"%",graph_can.width/2-100,graph.pos-(w*i)+4);
            c.fillStyle="#888888";
            c.fillRect(graph_can.width/2-80,graph.pos-(w*i),260,1);
        }
        c.restore();
        c.save()
        c.fillStyle="#222222";
        c.textAlign="center";
        c.font="12px Century Gothic";
        c.fillText("TOTAL: "+graph.total,graph_can.width/2,20);
        c.restore();
    }

    set_graph(<?php echo $users;?>, <?php echo $g1;?>,<?php echo $g2;?>, "gold", "green", "red");

</script>

<script>
    <?php
        $sql="SELECT COUNT(status),status FROM tbl_students GROUP BY status";
        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result($c,$status);
    ?>
    new Chart(document.getElementById("pie-charts"), {
        type: 'doughnut',
        data: {
          labels: [<?php while($qry->fetch()){ echo "'$status',";}?>],
          datasets: [
            {
                <?php 
                    $sql="SELECT COUNT(status),status FROM  tbl_students  GROUP BY status";
                    $qry=$mysql_connection_object->prepare($sql);
                    $qry->execute();
                    $qry->bind_result($c,$level);
                ?>
              label: "",
              backgroundColor:  [<?php for ($x = 0; $x <=1000; $x++) { echo",'#3e95cd', '#8e5ea2','#3cba9f','#FF00FF','#c45850','#ff1a1a','#661aff','#00ffff','#6600cc','#e600e6','#2E8B57','#00FF7F'";} ?>],
              data: [<?php while($qry->fetch()){ echo "$c,";} ?>]
            }
          ]
        },
        options: {
          title: {
            display: true,
              <?php 
                $sql="SELECT COUNT(status) FROM  tbl_students ";
                $qry=$mysql_connection_object->prepare($sql);
                $qry->execute();
                $qry->bind_result($count1);
                $qry->fetch();
              ?>
            text: 'Total : <?php echo "$count1"; ?>'

          }
        }
    });
</script> 

<script>
    <?php
        $sql="SELECT COUNT(gender),gender FROM tbl_students GROUP BY gender";
        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result($count,$level);
    ?>
    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
          labels: [<?php while($qry->fetch()){ echo "'$level',";}?>],
          datasets: [
            {
                <?php 
                    $sql="SELECT COUNT(gender),level FROM  tbl_students  GROUP BY gender";
                    $qry=$mysql_connection_object->prepare($sql);
                    $qry->execute();
                    $qry->bind_result($count,$level);
                ?>
              label: "",
          backgroundColor: ['pink', '#6600cc'],
              data: [<?php while($qry->fetch()){ echo "$count,";} ?>]
            }
          ]
        },
        options: {
          title: {
            display: true,
              <?php 
                $sql="SELECT COUNT(gender) FROM  tbl_students ";
                $qry=$mysql_connection_object->prepare($sql);
                $qry->execute();
                $qry->bind_result($count3);
                $qry->fetch();
              ?>
            text: 'Total : <?php echo "$count3"; ?>'

          }
        }
    });
</script>
