<?php
include"include/config.php";
if (isset($_POST['archive'])){
	
	for($x = 0 ; $x <= 11; $x++){
		 $qry =mysqli_query($mysql_connection_object,"SELECT COUNT(tbl_votes.c_id), tbl_positions.position,  tbl_party.party,  tbl_candidates.year, tbl_students.lastname, tbl_students.firstname, tbl_students.middlename, tbl_students.level , tbl_candidates.year FROM tbl_candidates INNER JOIN tbl_votes ON tbl_candidates.c_id=tbl_votes.c_id INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id where tbl_positions.pos_id='$x' GROUP By tbl_votes.c_id order by COUNT(tbl_votes.c_id)  desc");
		  while($row = mysqli_fetch_assoc($qry)){	
			  $count = $row['COUNT(tbl_votes.c_id)'];
			  $position = $row['position'];
			  $party = $row['party'];
			  $year = $row['year'];
			  $lname = $row['lastname'];
			  $fname = $row['firstname'];
			  $mname = $row['middlename'];
			  $level = $row['level'];
			  
			 mysqli_query($mysql_connection_object,"INSERT INTO `tbl_archive`( `firstname` , `middle` , `lastname`, `position`, `party`, `level`, `votes`, `year`) VALUES('$fname', '$mname', '$lname', '$position', '$party', '$level' , '$count' , '$year' )");
			 // echo $count . " " . $fname . " " . $position . "<br>"; 
			}  
		  }
		 echo "<script>
                alert('Archive Candidates Records!!');
                window.location.href='report_officially_elected.php';
            </script>";
	//mysqli_query($mysql_connection_object,"delete  from tbl_candidates");
	//mysqli_query($mysql_connection_object,"delete  from tbl_votes");

}
	
	
?>