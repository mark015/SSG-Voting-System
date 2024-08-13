<?php 
include"include/config.php";
session_start();
$lrn_no=$_SESSION['lrn_no'];


if(isset($_POST['vote'])){
	//$pres = isset($_POST['pres'])? $_REQUEST['pres']:"";
	//$vpres = isset($_POST['vpres'])? $_REQUEST['vpres']:"";
	//$sec = isset($_POST['sec'])? $_REQUEST['sec']:"";
	//$treas = isset($_POST['treas'])? $_REQUEST['treas']:"";
	//$aud = isset($_POST['aud'])? $_REQUEST['aud']:"";
	//$pio = isset($_POST['pio'])? $_REQUEST['pio']:"";
	//$rep_11a = isset($_POST['rep_11a'])? $_REQUEST['rep_11a']:"";
	//$rep_11b = isset($_POST['rep_11b'])? $_REQUEST['rep_11b']:"";
	//$rep_12a = isset($_POST['rep_12a'])? $_REQUEST['rep_12a']:"";
	//$rep_12b = isset($_POST['rep_12b'])? $_REQUEST['rep_12b']:"";
	date_default_timezone_set("Asia/Manila");
	
	
	if(isset($_POST["pres"])){
	foreach($_POST["pres"] as $pres ){
		mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$pres', '$lrn_no')");
		}
	}
	if(isset($_POST["vpres"])){
		foreach($_POST["vpres"] as $vpres ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$vpres', '$lrn_no')");
		}
	}
	if(isset($_POST['secr'])){
		foreach($_POST['secr'] as $sec ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$sec', '$lrn_no' )");
		}
	}
	if(isset($_POST['treas'])){
		foreach($_POST['treas'] as $treas ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$treas', '$lrn_no')");
		}
	}
	if(isset($_POST['aud'])){
		foreach($_POST['aud'] as $aud ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$aud', '$lrn_no')");
		}
	}
	if(isset($_POST["pio"])){
		foreach($_POST["pio"] as $pio ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$pio', '$lrn_no')");
		}
	}
	if(isset($_POST["peace"])){
		foreach($_POST["peace"] as $peace ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$peace', '$lrn_no')");
		}
	}
	if(isset($_POST["rep_11a"])){
		foreach($_POST["rep_11a"] as $rep_11a ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$rep_11a', '$lrn_no')");
		}
	}
	if(isset($_POST["rep_11b"])){
		foreach($_POST["rep_11b"] as $rep_11b ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$rep_11b', '$lrn_no')");
		}
	}
	if(isset($_POST["rep_12a"])){
		foreach($_POST["rep_12a"] as $rep_12a ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$rep_12a', '$lrn_no')");
		}
	}
	if(isset($_POST["rep_12b"])){
		foreach($_POST["rep_12b"] as $rep_12b ){
			mysqli_query($mysql_connection_object,"INSERT INTO `tbl_votes`( `c_id` , `lrn_no`) VALUES('$rep_12b', '$lrn_no')");
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

    $sql = "SELECT cellphone FROM tbl_students WHERE lrn_no = '$lrn_no'";
    $result = mysqli_query($mysql_connection_object, $sql);
    $data = mysqli_fetch_assoc($result);
    
    $number = '0'.$data['cellphone'];
    $msg = 'You have successfully voted. Thank you for participating.';
    $api = "TR-JEFFC439836_C9SYY";
    //TR-SHANA601483_K2R2K
    $result = itexmo($number,$msg,$api);
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
        echo "";
    }
 
	mysqli_query($mysql_connection_object,"update tbl_students set status = 'Voted' where lrn_no = '$lrn_no' ");	
       echo "
            <script>
                alert('Done Voting!!!');
                window.location.href='../index.php';
            </script>";
}

?>