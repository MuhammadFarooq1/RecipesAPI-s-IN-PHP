<?php
include( 'database-connection.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

       $userid = $_REQUEST['userid'];
       $productid = $_REQUEST['productid'];
	  // $p_id = $_REQUEST['pid'];
	  
  $query = "SELECT * FROM recipeslike WHERE userid='$userid' AND productid='$productid'";
         $result = $conn->query($query);
               if ($result) {
                if ($result->num_rows == 1) {
                   echo json_encode(
                        array("status"=>false , "message" => "The User Have Already Like this recipes") );
    } 
   else
   {
	
   $sql = "UPDATE addproduct SET recipeslike =recipeslike + 1 WHERE id='$productid'";
	   if ($conn->query($sql) === TRUE) {
		
		   $inertsql = "INSERT INTO recipeslike(userid,productid)
                     VALUES ('$userid','$productid')";
            
         if (mysqli_query($conn, $inertsql)) {
	          // $last_id = $conn->insert_id;
		   
			 http_response_code(200);
	  print_r( json_encode(array("status" => true , "messege " => "success"  )));
	
		 }
		   else {
              echo json_encode(
                        array("status"=>false , "message" => " Failed TO Insert. ") );
                }
       } else {
             //echo "Error updating record: " . $conn->error;
		   echo json_encode(
                        array("status"=>false , "message" => "Error updating record:". $conn->error) );
                }
   }
   }   
         else {
              echo json_encode(
                        array("status"=>false , "message" => "No connection found.") );
    }


?>