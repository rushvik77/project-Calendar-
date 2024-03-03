<?php
  include 'conn.php';
//   include 'navbar.php';

        if(isset($_POST['add'])){
            $Title =$_POST['title'];
            $Description =$_POST['description'];
            $Date =$_POST['date'];
            $StartTime =$_POST['start_time'];
            $EndTime =$_POST['end_time'];
            $Guest =$_POST['members'];
            $Location =$_POST['location'];
        
        
            $sql="INSERT INTO created_event_details (title, description,date,start_time,end_time,guest,location) VALUES ('$Title', '$Description', '$Date', '$StartTime','$EndTime','$Guest','$Location');";
            
            $result = mysqli_query($conn, $sql);
            if($result){
                 echo '<script>alert("Event successfully added!");</script>' ;
//                echo  '<div class="alert alert-primary" role="alert">
//   This is a primary alert—check it out!
// </div>';

            }
            else{
            echo "Error!!". mysqli_error($conn);
            }
        }

?>