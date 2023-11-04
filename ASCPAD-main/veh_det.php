<?php 
include 'partials/_dbconnect.php';
error_reporting(0);
$police_name=$_GET['police_name'];

$count_sql="SELECT count(*) FROM `towed_vehicles_rto` WHERE police_name='$police_name' AND DATE(date)=CURDATE()";
$result1=mysqli_query($conn,$count_sql);
$row1=mysqli_fetch_assoc($result1);
$noresult=false;  
if($_SERVER["REQUEST_METHOD"]=="POST"){    
    $fdate=date('Y-m-d', strtotime($_POST["from_date"]));
    $tdate=date('Y-m-d', strtotime("1 day", strtotime($_POST["to_date"])));
    $sql="select vehicle_no,date from towed_vehicles_rto where police_name='$police_name' AND date >= '$fdate' AND date <= '$tdate'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num>1){
        $noresult=false;
    }
    else{
        $noresult=true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle|Tow - Site</title>
    <link rel="stylesheet" href="veh_detstylecss.css">
    <style>
table, th, td {
  border:1px solid black;
}
</style>
</head>

<body>
<div class="login__logo">
        <img src="./depngs/towlogo.png" alt="No Logo">
    </div>
    <hr>
    <div class="container">
        <div class="details">
            <h2>No. of vehicles towed today - <?php echo $row1['count(*)']?> </h2>
            <h2>Enter date to get details of towed vehicles by you</h2>
            <form action="" method="post">
                <div class="from">
                    <p>From</p>
                    <input type="date" required name="from_date" class="date">
                </div>
                <div class="to">
                    <p>To</p>
                    <input type="date" required name="to_date" id=""><br>
                </div>
                <div class="btn">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="table">
            <table class="my-table">
                <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Date</th>
                    </tr>
                <?php
                    if($noresult){
                        echo "
                            <tr>
                                <td colspan='2'>
                                    No record found
                                </td>
                            </tr>";
                    }
                    else{
                        while($row=mysqli_fetch_assoc($result)){
                            echo"
                                <tr>
                                    <td>".$row['vehicle_no']."</td>
                                    <td>".$row['date']."</td>
                                </tr>
                                ";
                        }
                    }
                    ?>
            </table>

        </div>
    </div>

    <hr>

    <div class="footer">
        <div class="footer-links">
            <div class="footer-links_logo">
                <img src="./depngs/towlogo.png" alt="">
                <p>Lorem ipsum dolor sit amet. <br /> All Rights Reserved</p>
            </div>
            <div class="footer-links_div">
                <h4>Links</h4>
                <p>Overons</p>
                <p>Social Media</p>
                <p>Counters</p>
                <p>Contact</p>
            </div>
            <div class="footer-links_div">
                <h4>Company</h4>
                <p>Terms & Conditions</p>
                <p>Privacy Policy</p>
                <p>Contact</p>
            </div>
            <div class="footer-links_div">
                <h4>Get in touch</h4>
                <p>Crechterwoord K12 182 DK Alknjkcb</p>
                <p>085-132567</p>
                <p>info@payme.net</p>
            </div>
        </div>

    </div>
    <div class="footer-copyright">
        <p>© 2023 ASCPAD. All rights reserved.</p>
    </div>
</body>

</html>