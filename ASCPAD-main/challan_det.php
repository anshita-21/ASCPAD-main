<?php 
include 'partials/_dbconnect.php';
error_reporting(0);
$vehicle_no=$_GET['vehicle_no'];

$sql="select vehicle_no,police_name,police_st,date from towed_vehicles_rto where vehicle_no='$vehicle_no'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);


$sql1="select vehicle_no,rule_broken,rule_broken_penalty,date from challan_vehicle_rto where vehicle_no='$vehicle_no'";
$result1=mysqli_query($conn,$sql1);
$num1=mysqli_num_rows($result1);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challan|Tow - Site</title>
    <link rel="stylesheet" href="veh_detstyle.css">
    <style>
        table, th, td {
            border:1px solid black;
        }
</style>
</head>

<body>
    <nav class="navbar">
        <h1 class="title">
            Towing Services
        </h1>
    </nav>
   
    <h2 class="tow-head"> Tow challan details </h2>
    <div class="table1">
    <table>
            <tr>
    
            <th>Police Name</th>
            <th>Police Station</th>
            <th>Date</th>
            </tr>
    
    <?php
        if($num>0){
            while($row=mysqli_fetch_assoc($result)){
            
            echo "
            <tr>
               
                <td>".$row['police_name']."</td>
                <td>".$row['police_st']."</td>
                <td>".$row['date']."</td>
            </tr>
            ";
            }
        }
        else{
            echo "
            <tr>
                <td colspan='4'>No record found</td>
         
            </tr>
            ";
        }

        ?>
        </table>
    </div>

    <h2 class="chall-head"> Rules Violated challan details </h2>
    <div class="table1">
    <table>
            <tr>
            <th>Rules violated</th>
            <th>Penalty amount</th>
            <th>Date</th>
            </tr>
    
    <?php
        if($num1>0){
            while($row1=mysqli_fetch_assoc($result1)){
            
            echo "
            <tr>
                <td>".$row1['rule_broken']."</td>
                <td>".$row1['rule_broken_penalty']."</td>
                <td>".$row1['date']."</td>
            </tr>
            ";
            }
        }
        else{
            echo "
            <tr>
                <td colspan='3'>No record found</td>
         
            </tr>
            ";
        }

        ?>
        </table>
    </div>

    <footer>
        <nav class="fnbar">
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Feedback</a>
            <a href="#">Visitor Summary</a>
            <a href="#">Help</a>
            <a href="#">Link To Us</a>
            <a href="#">Website Policy</a>
        </nav>
        <div class="content">
            <div class="ctnt1">

                <h3 class="f1">Traffic Rules</h3>
                <div class="rules">
                    <a href="#">Do Not Drink and Drive</a>
                    <a href="#">Always Own Valid Car Insurance Policy</a>
                    <a href="#">Wear your seatbelt while Driving a Car</a>
                    <a href="#">Riding a Two-Wheeler without a Helmet On</a>
                    <a href="#">Using a Mobile Phone while Riding</a>
                    <a href="#">Over Speeding</a>
                    <a href="#">Jumping the Red Light</a>
                </div>
            </div>
            <div class="ctnt2">
                <h3 class="f2">
                    About Govt
                </h3>
                <div class="about">
                    <a href="#">Constitution Of India</a>
                    <a href="#">Govt Directory</a>
                    <a href="#">Indian Parliament</a>
                    <a href="#">Publications</a>
                    <a href="#">RTO Of India</a>
                    <a href="#">Traffic Police</a>
                    <a href="#">Who's Who</a>
                </div>
            </div>
        </div>


    </footer>
</body>

</html>