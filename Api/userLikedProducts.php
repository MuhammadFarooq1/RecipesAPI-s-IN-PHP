<?php
include( 'database-connection.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

       $userid = $_REQUEST['userid'];
	   $p_id = $_REQUEST['pid'];
	   $discription = $_REQUEST['discription'];
	  

	   $sql = "INSERT INTO likedracipes(pid,userid,discription)
                     VALUES ('$p_id','$userid','$discription')";
            
         if (mysqli_query($conn, $sql)) {
	$last_id = $conn->insert_id;
	// echo $last_id;
	 $s_sql = "SELECT * FROM likedracipes WHERE id='$last_id' ";
    


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
}
else
			{
              echo json_encode(
                        array("status"=>false , "message" => "No record found.") );
			
			}


?>