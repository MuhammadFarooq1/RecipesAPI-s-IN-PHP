<?php
include( 'database-connection.php' );

header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );



$userid = $_REQUEST[ 'userid' ];
$catagorie = $_REQUEST[ 'catagorie' ];
// $image = $_REQUEST['image'];
$tittle = $_REQUEST[ 'tittle' ];
$ingredients = $_REQUEST[ 'ingredients' ];
$direction = $_REQUEST[ 'direction' ];
$name = $_REQUEST[ 'name' ];
$recipes = $_REQUEST[ 'recipes' ];
$views = $_REQUEST[ 'views' ];
$recipeslike = $_REQUEST[ 'recipeslike' ];
$cookingtime = $_REQUEST[ 'cookingtime' ];
$dificulty = $_REQUEST[ 'dificulty' ];
$perserving = $_REQUEST[ 'perserving' ];


$filename = $_FILES[ "uploadfile" ][ "name" ];
$tempname = $_FILES[ "uploadfile" ][ "tmp_name" ];
$folder = "Productimages/" . $filename;



$sql = "INSERT INTO addproduct(userid,catagorie,image,tittle,ingredients,direction,name,recipes,views,recipeslike,cookingtime,dificulty,perserving)
                     VALUES ('$userid','$catagorie','$filename','$tittle','$ingredients','$direction','$name','$recipes','$views','$recipeslike','$cookingtime','$dificulty','$perserving')";


if ( move_uploaded_file( $tempname, $folder ) ) {

	$msg = "Image uploaded successfully";

} else {
	$msg = "Failed to upload image";
}



if ( mysqli_query( $conn, $sql ) ) {
	$last_id = $conn->insert_id;
	// echo $last_id;
	$s_sql = "SELECT * FROM addproduct WHERE id='$last_id' ";

	$r_result = mysqli_query( $conn, $s_sql );
	if ( $r_result->num_rows == 1 ) {

		$get = mysqli_fetch_assoc( $r_result );
		// set response code - 200 OK
		http_response_code( 200 );

		print_r( json_encode( array( "status" => true, "messege " => "success", "data" => ( $get ) ) ) );

		// echo "New record created successfully !";
	} else {
		echo json_encode(
			array( "status" => false, "message" => "Failed to insert " ) );
	}
} else {
	echo json_encode(
		array( "status" => false, "message" => "No record found." ) );

}


?>