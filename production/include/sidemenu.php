<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title">
            <?php
                $sql = "SELECT * FROM tbl_settings";
                $result = mysqli_query($mysql_connection_object, $sql);
                $set_data = mysqli_fetch_assoc($result);
            ?>
            <a href="home.php" class="site_title"><img src="images/<?php echo $set_data['logo'];?>" width="50px" style="margin-bottom: 7px;"><span style="font-family:AR Destine;"> SSG VOTING SYSTEM</span></a>
        </div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <?php
                $d = $_SESSION['userid'];
                $query = "SELECT * FROM `tbl_users` WHERE `userid` = '$d'";
                $result_object = mysqli_query($mysql_connection_object, $query);
                $user_data = mysqli_fetch_assoc($result_object);
            ?>
            <div class="profile_pic">
                <img src="images/<?php echo $user_data['userimage'];?>" style="width:55px; height:55px;" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2><b><?php echo $user_data['firstname']; ?> <?php echo $user_data['lastname']; ?></b></h2>
                <span><i class="fa fa-circle text-success"></i> Online</span>
            </div>
            <span style="margin-left:6%; color: aqua; width: 100%;"><i class="fa fa-envelope">&nbsp;</i><?php echo $user_data['email']; ?>&nbsp;</span>
        </div>
        <!-- /menu profile quick info -->
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side main_menu hidden-print">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="home.php"> Dashboard </a></li>
                            <!---
                            <li><a href="search_student.php"> Search Student </a></li>
                            ---->
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-book"></i> Archive <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="archive_candidates.php"> Candidates</a></li>
                            <li><a href="archive_election_result.php">Election Result</a></li>
                            <li><a href="archive_elected_officers.php">Elected Officers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-edit"></i> Fill-up Forms <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="form_candidates.php">Add Candicate</a></li>
                            <li><a href="form_students.php">Add Student</a></li>
                            <li><a href="form_users.php">Add User</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-database"></i> Records <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="admin_users.php">Admin Users </a></li>
                            <li><a href="rec_candidates.php"> Candidates </a></li>
                            <li><a href="rec_students.php">Students</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-print"></i> Reports <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="report_candidates.php">Candidates List</a></li>
                            <li><a href="report_election.php">Election Result</a></li>
                            <li><a href="report_students.php">Enrolled Students</a></li>
                            <li><a href="report_officially_elected.php">Officially Elected SSG Officers</a></li>
                            <li><a href="report_active.php">Status - Active Voters</a></li>
                            <li><a href="report_inactive.php">Status - Inactive Voters</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-cogs"></i> Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="election_date.php">Election Setting</a></li>
                            <li><a href="form_party.php">Party</a></li>
                            <!--<li><a href="form_position.php">Position</a></li>-->
                            <li><a href="sms.php">SMS</a></li>
                            <li><a href="form_strand.php">Strand</a></li>
                            <li><a href="form_track.php">Track</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-tasks"></i> Students Access Code <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="code.php">Access Code</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-wrench"></i> System Configuration <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="settings.php">Personalize</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
                      
        <!-- /menu footer buttons
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="index.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>