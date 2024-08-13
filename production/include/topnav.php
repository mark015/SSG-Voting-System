<!-- top navigation -->
<div class="top_nav hidden-print">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="images/<?php echo $user_data['userimage'];?>" alt=""> <?php echo $_SESSION["username"]; ?> 
                        <span class=" fa fa-angle-down"> </span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="profile.php"><i class="fa fa-info-circle pull-right"></i><b>Profile</b></a></li>
                        <li><a href="../index.php" style="color: red;"><i class="glyphicon glyphicon-log-out pull-right"></i><b>Log Out</b></a></li>
                    </ul>
                </li>
                <li class="fa fa-clock-o" aria-hidden="true" style="font-size: 30px; padding: 3px; margin-top: 2%"> <b><span id="timer" style="font-size: 30px; color: red;"></span></b></li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
<script>
    var d = new Date();
    document.getElementById("date").innerHTML = d.toDateString();
</script>

<script>
    var myVar = setInterval(myTimer, 1000);
    function myTimer() {
      var d = new Date();
      document.getElementById("timer").innerHTML = d.toLocaleTimeString();
    }
</script>