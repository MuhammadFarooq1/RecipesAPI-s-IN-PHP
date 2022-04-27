
<?php
include( 'database-connection.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

      $productid  = $_REQUEST['productid'];
      $recipename  = $_REQUEST['recipename'];
	  $dificulty   = $_REQUEST['dificulty'];
	  $cookingtime = $_REQUEST['cookingtime'];
	  $ingredients = $_REQUEST['ingredients'];
	  $perserving  = $_REQUEST['perserving'];
	  $direction   = $_REQUEST['direction'];


   $ps_sql = "SELECT * FROM addproduct WHERE id='$productid' ";
     
    if($result = $conn->query($ps_sql)){
     $row = $result->fetch_assoc();
		  
	  $catagorie = $row['catagorie'];
	  $image = $row['image'];
	  $tittle  = $row['tittle'];
	 
	  
      $sql = "INSERT INTO cookrescipes(productid,image,recipename,catagorie,tittle,dificulty,cookingtime,ingredients,perserving,direction)
                     VALUES ('$productid','$image','$recipename','$catagorie','$tittle','$dificulty','$cookingtime','$ingredients','
					 $perserving','$direction')";
       
		if (mysqli_query($conn, $sql)) {
	         $last_id = $conn->insert_id;
	// echo $last_id;
	 $s_sql = "SELECT * FROM cookrescipes WHERE id='$last_id' ";
    
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
                        array("status"=>false , "message" => "You have No record found.") );			
			} 
}
else
			{
              echo json_encode(
                        array("status"=>false , "message" => "oop! No record found.") );
			
			}
	}
	
else

{
	echo "nodosd  ";
}





?>