<?php 
    require_once 'include/config.php';
    include 'include/auth1.php';
?>

<!DOCTYPE html>
<html>
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
        
        <link rel="icon" href="images/scshs_logo.png"/>

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/tabs.css" type="text/css" media="screen, projection"/>

        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.7.custom.min.js"></script>

<head>	
    <script type="text/javascript">
		$(function() {

			var $tabs = $('#tabs').tabs();
	
			$(".ui-tabs-panel").each(function(i){
	
			  var totalSize = $(".ui-tabs-panel").size() - 1;
	
			  if (i != totalSize) {
			      next = i + 2;
		   		  $(this).append("<a href='#' class='next-tab mover' rel='" + next + "'>Next Page &#187;</a>");
			  }
	  
			  if (i != 0) {
			      prev = i;
		   		  $(this).append("<a href='#' class='prev-tab mover' rel='" + prev + "'>&#171; Prev Page</a>");
			  }
   		
			});
	
			$('.next-tab, .prev-tab,').click(function() { 
		           $tabs.tabs('select', $(this).attr("rel"));
		           return false;
		       });
       

		});
    </script>
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
            height: 170px;
            width: 200px;
            padding-top: 0px;
            padding-bottom: 0px;
        }
	</style>

</head>

<body>
<br>
    <div class="col-md-12 col-md-offset-1 col-sm-12 col-md-xs-12">
        <?php
            $sql = "SELECT * FROM tbl_settings";
            $result = mysqli_query($mysql_connection_object, $sql);
            $set_data = mysqli_fetch_assoc($result);
        ?>
        <img src="images/<?php echo $set_data['logo'];?>" width="120px"><span style="font-family:AR Destine; font-size: 40px;"> SSG VOTING SYSTEM <small style="font-family:Algerian; font-size: 20px;"><?php echo $set_data['school_name'];?></small></span>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div id="tabs">
            <ul class="hide">
                <li><a href="#fragment-1">Step 1</a></li>
                <li><a href="#fragment-2">Step 2</a></li>
                <li><a href="#fragment-3">Step 3</a></li>
                <li><a href="#fragment-4">Step 4</a></li>
                <li><a href="#fragment-5">Step 5</a></li>
                <li><a href="#fragment-6">Step 6</a></li>
                <li><a href="#fragment-7">Step 7</a></li>
                <li><a href="#fragment-8">Step 8</a></li>
                <li><a href="#fragment-9">Step 9</a></li>
                <li><a href="#fragment-10">Step 10</a></li>
           </ul>
            <form method="post" action="voting_process.php">
                <div class="col-md-12 col-sm-12 col-md-xs-12" style="background-color: lightgray;">
                    <marquee>
                        <h4 style="color: red; ">
                            <b>Welcome to SSG Voting System!!! Please Select Your Desire Candidate in Each Position. </b>
                        </h4>
                    </marquee>
                </div>
                <div id="fragment-1" class="ui-tabs-panel" >
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'President'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no  INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'President'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='radio' name='pres[]' value='$c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?>       
                </div>
                <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide">
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Vice President'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Vice President'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='radio' name='vpres[]' value='$c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?>       
                </div>
                <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide">
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Secretary'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Secretary'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='radio' name='secr[]' value='$c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?>       
                </div>
                <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide">
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Treasurer'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Treasurer'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='radio' name='treas[]' value='$c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?>       
                </div>
                <div id="fragment-5" class="ui-tabs-panel ui-tabs-hide">
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Auditor'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Auditor'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='radio' name='aud[]' value='$c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?> 
                </div>
                <div id="fragment-6" class="ui-tabs-panel ui-tabs-hide">
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Public Information Officer'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Public Information Officer'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='radio' name='pio[]' value='$c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?> 
                </div>
                <div id="fragment-7" class="ui-tabs-panel ui-tabs-hide">
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Peace Officer'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Peace Officer'");
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
                            <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
							<label style='display: block; color: black;'>
                                <center>
                                    <image class='b' src='images/$c_image'></image><br>
                                </center>
                                <div>
                                    
                                        <input type='radio' name='peace[]' onclick='return myfunction()' value='$c_id'>
                                        <span>
                                            Name: $fname  $mname  $lname<br>
                                            Nickname: $nname<br>
                                            Partylist: $party<br>
                                        </span><br>
                                    </label>
                                </div>
                            </div>";
                    };
                ?> 
                <script type="application/javascript">
                    function myfunction(){
                        var a= document.getElementsByName('peace[]');
                        var newvar = 0;
                        var count;
                        for(count=0; count<a.length; count++){
                            if(a[count].checked==true){
                                newvar = newvar+1;
                            }
                        }
                        if(newvar>=3){
                            document.getElementById('notvalid').innerHTML=""
                            return false;
                        }
                    }
                </script>
                </div>
                <div id="fragment-8" class="ui-tabs-panel ui-tabs-hide">
                   <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Representative (Grade 12, Academic-Humms)'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Representative (Grade 12, Academic-Humms)'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='checkbox' name='rep_12a[]' value=' $c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?> 
                </div>
                <div id="fragment-9" class="ui-tabs-panel ui-tabs-hide">
                    <?php
                        $sql= "SELECT tbl_candidates.c_id, tbl_positions.position from tbl_candidates INNER JOIN tbl_positions WHERE tbl_positions.position = 'Representative (Grade 12, TVL)'";
                        $result = mysqli_query($mysql_connection_object, $sql);
                        $p_data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 style="color: white"><b><?php echo $p_data['position']; ?></b></h3>
                    </div>
                    <?php
                        $query = mysqli_query($mysql_connection_object,"SELECT tbl_candidates.c_id, tbl_candidates.nickname, tbl_candidates.c_image, tbl_positions.position, tbl_party.party, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id WHERE tbl_positions.position = 'Representative (Grade 12, TVL)'");
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
                                <div class='image view view-first col-md-6 col-sm-6 col-md-xs-6' style='background-color: skyblue;'><br>
								<label style='display: block; color: black;'>
                                    <center>
                                        <image class='b' src='images/$c_image'></image><br>
                                    </center>
                                    <div>
                                        
                                            <input type='checkbox' name='rep_12b[]' value='$c_id'>
                                            <span>
                                                Name: $fname  $mname  $lname<br>
                                                Nickname: $nname<br>
                                                Partylist: $party<br>
                                            </span><br>
                                        </label>
                                    </div>
                                </div>";
                        };
                    ?>
                </div>
                <div id="fragment-10" class="ui-tabs-panel ui-tabs-hide">
                    <div class='col-md-12' style='background-color: skyblue; text-align: center; margin-top: 5%;'><br>
                        <h1 style="color: white; font-family:Times New Roman; font-size: 60px;">THANK YOU FOR VOTING!!!</h1>
                        <h3>Please Click Submit to Cast Your Vote</h3><br>
                        <button type="submit" class="btn btn-ms btn-success" name="vote" >Submit</button>
                    </div>
            </div>
            </form>
        </div>
        <br>
    </div>
</body>
</html>
