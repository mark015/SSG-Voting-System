<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title">
            <?php
                $sql = "SELECT * FROM tbl_settings";
                $result = mysqli_query($mysql_connection_object, $sql);
                $set_data = mysqli_fetch_assoc($result);
            ?>
            <a href="#" class="site_title"><img src="images/<?php echo $set_data['logo'];?>" width="50px"><span style="font-family:AR Destine;"> SSG VOTING SYSTEM</span></a>
        </div>
            
        <div class="clearfix"></div>
        <br>
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side main_menu hidden-print">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="filluppform.php"> Fill Up Form </a></li>
                        </ul>
                    </li>
             
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
                      
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="System Settings" href="#.php">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="../index.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>