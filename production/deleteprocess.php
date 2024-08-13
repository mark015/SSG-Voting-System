<?php
    require_once'include/config.php';
    include'include/auth.php';

    if(isset($_GET['userid'])){
        $userid = isset($_GET['userid']) ? $_GET['userid']:"";

        $sql = "SELECT * FROM tbl_users WHERE userid=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result ($userid);

        $sql="DELETE FROM tbl_users WHERE userid=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("i",$userid);
        $qry->execute();
        header ("location:admin_users.php");
    }

    if(isset($_GET['c_id'])){
        $c_id = isset($_GET['c_id']) ? $_GET['c_id']:"";

        $sql = "SELECT * FROM tbl_candidates WHERE c_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result($c_id);

        $sql="DELETE FROM tbl_candidates WHERE c_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("i",$c_id);
        $qry->execute();
        header ("location:rec_candidates.php");
    }

    if(isset($_GET['lrn_no'])){
        $lrn_no = isset($_GET['lrn_no']) ? $_GET['lrn_no']:"";

        $sql = "SELECT * FROM tbl_students WHERE lrn_no=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result ($lrn_no);

        $sql="DELETE FROM tbl_students WHERE lrn_no=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("s",$lrn_no);
        $qry->execute();
        header ("location:rec_students.php");
    }

    if(isset($_GET['strand_id'])){
        $strand_id = isset($_GET['strand_id']) ? $_GET['strand_id']:"";

        $sql = "SELECT * FROM tbl_strands WHERE strand_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result ($strand_id);

        $sql="DELETE FROM tbl_strands WHERE strand_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("i",$strand_id);
        $qry->execute();
        header ("location:form_strand.php");
    }

    if(isset($_GET['track_id'])){
        $track_id = isset($_GET['track_id']) ? $_GET['track_id']:"";

        $sql = "SELECT * FROM tbl_tracks WHERE track_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result ($track_id);

        $sql="DELETE FROM tbl_tracks WHERE track_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("i",$track_id);
        $qry->execute();
        header ("location:form_track.php");
    }

    if(isset($_GET['position_id'])){
        $position_id = isset($_GET['position_id']) ? $_GET['position_id']:"";

        $sql = "SELECT * FROM tbl_positions WHERE pos_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result ($track_id);

        $sql="DELETE FROM tbl_positions WHERE pos_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("i",$position_id);
        $qry->execute();
        header ("location:form_position.php");
    }

    if(isset($_GET['party_id'])){
        $party_id = isset($_GET['party_id']) ? $_GET['party_id']:"";

        $sql = "SELECT * FROM tbl_party WHERE party_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result ($track_id);

        $sql="DELETE FROM tbl_party WHERE party_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("i",$party_id);
        $qry->execute();
        header ("location:form_party.php");
    }

    if(isset($_GET['msg_id'])){
        $msg_id = isset($_GET['msg_id']) ? $_GET['msg_id']:"";

        $sql = "SELECT * FROM tbl_messages WHERE msg_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->execute();
        $qry->bind_result($msg_id);

        $sql="DELETE FROM tbl_messages WHERE msg_id=?";
        $qry=$mysql_connection_object->prepare($sql);
        $qry->bind_param("i",$msg_id);
        $qry->execute();
        header ("location:sms.php");
    }
?>