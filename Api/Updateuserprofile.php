<?php
include( 'database-connection.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

     
	  $p_name = $_REQUEST['name'];
	  $email = $_REQUEST['email'];
	  $password = $_REQUEST['password'];
	 // $image = $_REQUEST['image'];
	  $id = $_REQUEST['id'];
   

   $filename = $_FILES[ "uploadfile" ][ "name" ];
$tempname = $_FILES[ "uploadfile" ][ "tmp_name" ];
$folder = "Productimages/" . $filename;	   



  $sql = "UPDATE users SET name='$p_name',email='$email',password='$password',image='$filename' WHERE id='$id'";

//	   $sql = "INSERT INTO users(name,email,password)
//                     VALUES ('$p_name','$email','$password')";          
    
   if ( move_uploaded_file( $tempname, $folder ) ) {

	$msg = "Image uploaded successfully";

} else {
	$msg = "Failed to upload image";
}  
 


   if (mysqli_query($conn, $sql)) {
	 $last_id = $conn->insert_id;
	// echo $last_id;
	 $s_sql = "SELECT * FROM users WHERE id='$id' ";
    
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
                        array("status"=>false , "message" => "No last found.") );			
			} 
}
else
			{
              echo json_encode(
                        array("status"=>false , "message" => "No record found.") );
			
			}


?>