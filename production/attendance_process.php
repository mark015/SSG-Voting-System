<?php
    require_once'include/config.php';
 
    $result = $_GET['q']."%";
    $sql = "SELECT * FROM tbl_students WHERE lrn_no LIKE ?";
    $qry = $mysql_connection_object->prepare($sql);
    $qry->bind_param("s", $result);
    $qry->bind_result($lrn_no, $track_id, $strand_id, $lastname, $firstname, $middlename, $ext_name, $gender, $bdate, $street, $barangay, $city, $province, $postal_code, $country, $mother, $father, $guardian, $telephone, $cellphone, $email, $level, $pass, $status);
    $qry->execute();

    $r=0;

    while($qry->fetch()){
        $r++;
        echo "<table class='table'>
                <thead style='color: black;'>
                    <tr class='headings'>
                        <th class='column-title'>Action</th>
                        <th class='column-title'>LRN No.</th>
                        <th class='column-title'>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style='font-size: 16px; color: black;'>
                        <td style='width: 20%;'><a class='btn btn-danger btn-sm' href='attendance_process1.php?lrn_no=$lrn_no'><i class='fa fa-key'> Activate</i></a></td>
                        <td style='width: 30%;'><b>$lrn_no</b></td>
                        <td style='width: 50%;'><b>$lastname, $firstname $middlename</b></td>
                    </tr>
                </tbody>
            </table>";
    }
    if($r==0){
        echo "<table>
                <tbody>
                    <tr style='font-size: 16px;'>
                        <td style='width: 100%; color: red;'><b>Search Not Found!!!</b></td>
                    </tr>
                </tbody>
            </table>"; 
    }
?>