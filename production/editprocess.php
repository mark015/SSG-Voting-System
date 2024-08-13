<?php
    require_once'include/config.php';
    include'include/auth.php';

    if(isset($_POST['edit_user'])){
        $userid = isset($_POST['userid']) ? $_POST['userid'] : "";
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
        $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
        $username = isset($_POST['username']) ? $_POST['username'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $userimage = isset($_POST['userimage']) ? $_POST['userimage'] : "";
        $curpass = isset($_POST['currentpassword']) ? $_POST['currentpassword'] : "";
        $newpass = isset($_POST['newpassword']) ? $_POST['newpassword'] : "";
        $passconf = isset($_POST['passconf']) ? $_POST['passconf'] : "";
        $hash = hash("SHA256", $curpass);
        $newhash = hash("SHA256", $newpass);
        $userimage = $_FILES['userimage']['name'];
        $tmp_dir = $_FILES['userimage']['tmp_name'];
        $imgSize = $_FILES['userimage']['size'];

        if($imgSize < 5000000) {
            move_uploaded_file($tmp_dir,"images/$userimage");
        } else {
            $_SESSION['MSG'] = "<script> alert ('Sorry, your file is too large.')";
        }

        $sql = "SELECT * FROM tbl_users WHERE userid='$userid'";
        $qry = mysqli_query($mysql_connection_object,$sql);
        $user_data = mysqli_fetch_array($qry);
        $cdate = $user_data['cdate'];

        if ($hash == $user_data['password']){
            if ($newpass != $passconf) {
                echo "<script>
                        alert('New Password Do Not Match!!');
                        window.location.href='admin_users.php';
                    </script>";
            } else{
                $sql="UPDATE tbl_users SET firstname=?, lastname=?, gender=?, username=?, email=?, userimage=?, cdate=?, password=? WHERE userid='$userid'";
                $qry= $mysql_connection_object->prepare($sql);
                $qry->bind_param("ssssssss", $firstname, $lastname, $gender, $username, $email, $userimage, $cdate, $newhash);
                $qry->execute();
                echo "<script>
                        alert('Data Succesfully Updated!!');
                        window.location.href='admin_users.php';
                    </script>";
            }
        }else { 
            echo "<script>
                    alert('Current Password Do Not Match!!');
                    window.location.href='admin_users.php';
                </script>";
        }

    }

    if(isset($_POST['edit_candidate'])){
        $c_id = isset($_POST['c_id']) ? $_POST['c_id'] : "";
        $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : "";
        $position = isset($_POST['position']) ? $_POST['position'] : "";
        $party = isset($_POST['party']) ? $_POST['party'] : "";
        $c_image = isset($_POST['c_image']) ? $_POST['c_image'] : "";
        $c_image = $_FILES['c_image']['name'];
        $tmp_dir = $_FILES['c_image']['tmp_name'];
        $imgSize = $_FILES['c_image']['size'];

        $sql = "SELECT * FROM tbl_positions WHERE position='$position'";
        $qry = mysqli_query($mysql_connection_object,$sql);
        $pos_data = mysqli_fetch_array($qry);
        $pos_id = $pos_data['pos_id'];
        
        $sql = "SELECT * FROM tbl_party WHERE party='$party'";
        $qry = mysqli_query($mysql_connection_object,$sql);
        $party_data = mysqli_fetch_array($qry);
        $party_id = $party_data['party_id']; 
        
        if($imgSize < 5000000) {
            move_uploaded_file($tmp_dir,"images/$c_image");
        } else {
            $_SESSION['MSG'] = "<script> alert ('Sorry, your file is too large.')";
        }

        $sql="UPDATE tbl_candidates SET pos_id=?, nickname=?, c_image=?, party=? WHERE c_id='$c_id'";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("isss", $pos_id, $nickname, $c_image, $party_id);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='rec_candidates.php';
            </script>";
    }

    if(isset($_POST['edit_student'])){
        date_default_timezone_set("Asia/Manila");
        $date=date("Y-m-d");
        $bdate = isset($_POST['bdate']) ? $_POST['bdate'] : "";
        $lrn_no = isset($_POST['lrn_no']) ? $_POST['lrn_no'] : "";
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
        $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : "";
        $ext_name = isset($_POST['ext_name']) ? $_POST['ext_name'] : "";
        $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
        $street = isset($_POST['street']) ? $_POST['street'] : "";
        $barangay = isset($_POST['barangay']) ? $_POST['barangay'] : "";
        $city = isset($_POST['city']) ? $_POST['city'] : "";
        $province = isset($_POST['province']) ? $_POST['province'] : "";
        $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
        $country = isset($_POST['country']) ? $_POST['country'] : "";
        $mother = isset($_POST['mother']) ? $_POST['mother'] : "";
        $father = isset($_POST['father']) ? $_POST['father'] : "";
        $guardian = isset($_POST['guardian']) ? $_POST['guardian'] : "";
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
        $cellphone = isset($_POST['cellphone']) ? $_POST['cellphone'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $track = isset($_POST['track']) ? $_POST['track'] : "";
        $strand = isset($_POST['strand']) ? $_POST['strand'] : "";
        $level = isset($_POST['level']) ? $_POST['level'] : "";
        
        $sql = "SELECT * FROM tbl_tracks WHERE track_name='$track'";
        $qry = mysqli_query($mysql_connection_object,$sql);
        $track_data = mysqli_fetch_array($qry);
        $track_id = $track_data['track_id']; 

        $sqli = "SELECT * FROM tbl_strands WHERE strand_name='$strand'";
        $qry = mysqli_query($mysql_connection_object,$sqli);
        $strand_data = mysqli_fetch_array($qry);
        $strand_id = $strand_data['strand_id']; 

        $sql="UPDATE tbl_students SET track_id=?, strand_id=?, lastname=?, firstname=?, middlename=?, ext_name=?, gender=?, bdate=?, street=?, barangay=?, city=?, province=?, postal_code=?, country=?, mother=?, father=?, guardian=?, telephone=?, cellphone=?, email=?, level=? WHERE lrn_no='$lrn_no'";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("iisssssssssssssssssss", $track_id, $strand_id, $lastname, $firstname, $middlename, $ext_name, $gender, $bdate, $street, $barangay, $city, $province, $postal_code, $country, $mother, $father, $guardian, $telephone, $cellphone, $email, $level);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='rec_students.php';
            </script>";
    }

    if(isset($_POST['edit_position'])){
        $id = isset($_POST['position_id']) ? $_POST['position_id'] : "";
        $position = isset($_POST['position']) ? $_POST['position'] : "";

        $sql="UPDATE tbl_positions  SET position=? WHERE pos_id='$id'";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("s", $position);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='form_position.php';
            </script>";
    }


    if(isset($_POST['edit_party'])){
        $id = isset($_POST['party_id']) ? $_POST['party_id'] : "";
        $party= isset($_POST['party']) ? $_POST['party'] : "";

        $sql="UPDATE tbl_party SET party=? WHERE party_id='$id'";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("s", $party);
        $qry->execute();
        echo "<script>
                alert('Data Successfully Updated!!!');
                window.location.href='form_party.php';
            </script>";
    }

    if(isset($_POST['edit_track'])){
        $track_id = isset($_POST['track_id']) ? $_POST['track_id'] : "";
        $track_name = isset($_POST['track_name']) ? $_POST['track_name'] : "";
        $track_desc = isset($_POST['track_desc']) ? $_POST['track_desc'] : "";

        $sql="UPDATE tbl_tracks  SET track_name=?, track_description=? WHERE track_id='$track_id'";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("ss", $track_name, $track_desc);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='form_track.php';
            </script>";
    }

    if(isset($_POST['edit_strand'])){
        $strand_id = isset($_POST['strand_id']) ? $_POST['strand_id'] : "";
        $strand_name = isset($_POST['strand_name']) ? $_POST['strand_name'] : "";
        $strand_desc = isset($_POST['strand_desc']) ? $_POST['strand_desc'] : "";
        $track_name = isset($_POST['track_name']) ? $_POST['track_name'] : "";
        
        $sql = "SELECT * FROM tbl_tracks WHERE track_name='$track_name'";
        $qry = mysqli_query($mysql_connection_object,$sql);
        $track_data = mysqli_fetch_array($qry);
        $track_id = $track_data['track_id']; 

        $sql="UPDATE tbl_strands SET track_id=?, strand_name=?, strand_description=? WHERE strand_id='$strand_id'";
        $qry= $mysql_connection_object->prepare($sql);
        $qry->bind_param("iss", $track_id, $strand_name, $strand_desc);
        $qry->execute();
        echo "<script>
                alert('Data Succesfully Updated!!');
                window.location.href='form_strand.php';
            </script>";
    }
?>