<?php
include( 'database-connection.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

       $userid = $_REQUEST['userid'];
	  // $p_id = $_REQUEST['pid'];
	  
	  
	 $s_sql = "SELECT * FROM likedracipes WHERE userid='$userid' ";
    $rows = [];
     
	 if($result = $conn->query($s_sql)){
      while ( $row = $result->fetch_assoc() ){
			$rows[] = $row;	
				  // set response code - 200 OK
      	// echo "New record created successfully !";
	  }
	  http_response_code(200);
	print_r( json_encode(array("status" => true , "messege " => "success" , "data" => ($rows) )));
	
	 }
	else
			{			
              echo json_encode(
                        array("status"=>false , "message" => "No record found.") );			
			} 

	 

?>