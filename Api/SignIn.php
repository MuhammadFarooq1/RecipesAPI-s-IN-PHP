<?php

include( 'database-connection.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



 
	  $email = $_REQUEST['email'];
	  $password = $_REQUEST['password'];
	   
	 
	 $s_sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    
    $r_result = mysqli_query($conn, $s_sql);

	          if ($r_result->num_rows == 1) {
	   
				$get = mysqli_fetch_assoc($r_result);
				  // set response code - 200 OK
            http_response_code(200);
	
	 print_r( json_encode(array("status" => true , "messege " => "success" , "data" => ($get) )));
	
		// echo "New record created successfully !";
   }
	else
			{			
              echo json_encode(
                        array("status"=>false , "message" => "No record found.") );			
			} 



















?>