<?php

    function fetch_data() {  
        include'include/config.php';
        $output = ''; 					
        $mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
        $sql="SELECT * FROM tbl_candidates INNER JOIN tbl_students ON tbl_candidates.lrn_no=tbl_students.lrn_no INNER JOIN tbl_positions ON tbl_candidates.pos_id=tbl_positions.pos_id INNER JOIN tbl_party ON tbl_candidates.party=tbl_party.party_id INNER JOIN tbl_strands ON tbl_students.strand_id=tbl_strands.strand_id ORDER BY tbl_positions.pos_id"; 
        $result = mysqli_query($mysql_connection_object, $sql) or die(mysqli_error($mysql_connection_object)); 

        while($row = mysqli_fetch_array($result)) {
            $output .= '<tr>  
                            <td><img src="images/'.$row["c_image"].'" style="width: 25px"></td>  
                            <td>'.$row["lastname"].", ".$row["firstname"]." ".$row["middlename"].'</td>  
                            <td>'.$row["nickname"].'</td>  
                            <td>'.$row["gender"].'</td>      
                            <td>'.$row["position"].'</td>
                            <td>'.$row["party"].'</td>
                            <td>'.$row["level"].'</td>
                            <td>'.$row["strand_name"].'</td>
                        </tr>';  
        }
        return $output;  
    } 

    if(isset($_POST["generate_pdf"])) {  
        require_once('tcpdf/tcpdf.php');
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $obj_pdf->SetCreator(PDF_CREATOR);  
        $obj_pdf->SetTitle("SSG Voting System");  
        $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $obj_pdf->SetDefaultMonospacedFont('helvetica');  
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
        $obj_pdf->setPrintHeader(false);  
        $obj_pdf->setPrintFooter(false);  
        $obj_pdf->SetAutoPageBreak(TRUE, 10);  
        $obj_pdf->SetFont('helvetica', '', 10);  
        $obj_pdf->AddPage();  
        $content = '';  
        $content .= '  
            <div class="print_this">
                <p1>Republic of the Philippines</p1><br>
                <p1>Department of Education</p1><br>
                <p1>Region VI - Western Visayas</p1><br>
                <p1>Division of Sagay City</p1><br>
                <p1><strong>Sagay City Senior High School</strong></p1>
            </div>
            <p1>___________________________________________________________________________________________</p1>
            <h3>Candidates List</h3>
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="1" style="text-align: center;">
                <tr>  
                    <th class="column-title">Image </th>
                    <th class="column-title">Full Name </th>
                    <th class="column-title">Nickname </th>
                    <th class="column-title">Gender </th>
                    <th class="column-title">Position </th>
                    <th class="column-title">Party </th>
                    <th class="column-title">Level </th>
                    <th class="column-title">Strand </th>
                </tr>';  
        $content .= fetch_data();  
        $content .= '</table>';  
        $obj_pdf->writeHTML($content);  
        $obj_pdf->Output('candidate_list.pdf', 'I');  
     } 
?>