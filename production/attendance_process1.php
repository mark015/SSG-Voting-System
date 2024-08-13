<?php
    require_once 'include/config.php';

    if(isset($_GET['lrn_no'])){
        $lrn_no = isset($_GET['lrn_no']) ? $_GET['lrn_no']:"";
        $sql = "SELECT * FROM tbl_students WHERE lrn_no='$lrn_no'";
        $qry = mysqli_query($mysql_connection_object,$sql);
        $data = mysqli_fetch_array($qry);

        if($data['status'] == 'Active'){
            echo "<script>
                    alert('Account Already Active!!!');
                    window.location.href='attendance.php';
                </script>";
        }else if($data['status'] == 'Voted'){
            echo "<script>
                    alert('Account Already Active!!!');
                    window.location.href='attendance.php';
                </script>";
        } else {
            $sql="UPDATE tbl_students SET status='Active' WHERE lrn_no=?";
            $qry=$mysql_connection_object->prepare($sql);
            $qry->bind_param("s",$lrn_no);
            $qry->execute();
            
            $query = "INSERT INTO `tbl_attendance_logs`(`lrn_no`) VALUES('$lrn_no')";
            $result = mysqli_query($mysql_connection_object, $query);
            echo "<script>
                    alert('Account Successfully Activated!!!');
                    window.location.href='attendance.php';
                </script>";
        }
    }
?>