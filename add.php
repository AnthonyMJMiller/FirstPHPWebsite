<?php
    session_start();
    $conn = mysqli_connect("localhost","root","") or die(mysqli_error()); //Connect to server
    if($_SESSION['user']){
    }
    else{
       header("location:index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
       $details = mysqli_real_escape_string($conn, $_POST['details']);
       $time = strftime("%X"); //time
       $date = strftime("%B %d, %Y"); //date
       $decision = "no";


       mysqli_select_db($conn, "first_db") or die("Cannot connect to database"); //Conect to database
       foreach($_POST['public'] as $each_check) //gets the data from the checkbox
       {
          if($each_check != null){ //checks if checkbox is checked
             $decision = "yes"; // sets the value
          }
       }

       mysqli_query($conn, "INSERT INTO list(details, date_posted, time_posted, public) VALUES ('$details','$date','$time','$decision')"); //SQL query
       header("location:home.php");
    }
    else
    {
       header("location:home.php");
    }
?>
