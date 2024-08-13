<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0px;
    }
    .my_class{
        display: none;
        text-align: left;
    }
    .print_this{
        display: none;
        text-align: left;
    }
    .hide_div{
        display: none;
    }          
    .hidden_div{
        display: none;
    }
    @media print {
        .hide_div{
            display:block;
        }
        .hidden_div{
            display: block;
        }
        .print_this{
            margin: 20px;
            display:block;
            font-size: 14px;
        }
        .my_class{
            display:block;
            font-size: 14px;
        }
        .td{
            font-size: 20px;
        }
    }
</style>
<div class="my_class">
    <div class="print_this">
        <?php
            $sql = "SELECT * FROM tbl_settings";
            $result = mysqli_query($mysql_connection_object, $sql);
            $set_data = mysqli_fetch_assoc($result);
        ?>
        <img class="pull-right" src="images/deped.png" width="100px" style="top: 0px;">
        <img class="pull-right" src="images/<?php echo $set_data['logo'];?>" width="100px" style="top: 0px;">
        <p1>Republic of the Philippines</p1><br>
        <p1>Department of Education</p1><br>
        <p1>Region VI - Western Visayas</p1><br>
        <p1>Division of Sagay City</p1><br>
        <p1><strong><?php echo $set_data['school_name'];?></strong></p1><br>
    </div>
    <p1>____________________________________________________________________________________________________________________________________________________________________________________________________________</p1>
</div>