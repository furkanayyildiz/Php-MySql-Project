<?php 
     //connect to database
     $conn = mysqli_connect("localhost", "Furkan", "pizzacıfurkan", "furkan_pizza");

     //checking connection
     if(!$conn){
             echo "Connection error" . mysqli_connect_error();
     }



?>