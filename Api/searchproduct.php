<?php

include( 'database-connection.php' );

header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );




$catagorie = $_REQUEST[ 'catagorie' ];



$s_sql = "SELECT * FROM addproduct WHERE catagorie='$catagorie'";

$r_result = mysqli_query( $conn, $s_sql );

if ( $r_result->num_rows == 1 ) {

	$query = "SELECT * FROM popularkeywords WHERE name='$catagorie'";
	$result = $conn->query( $query );
	if ( $result ) {
		if ( $result->num_rows == 1 ) {
        //   echo "saved to popular";
		}
	 else {
		$P_sql = "INSERT INTO popularkeywords(name) VALUES ('$catagorie')";

		$P_result = mysqli_query( $conn, $P_sql );
	}}


	$get = mysqli_fetch_assoc( $r_result );
	// set response code - 200 OK
	http_response_code( 200 );

	print_r( json_encode( array( "status" => true, "messege " => "success", "data" => ( $get ) ) ) );

	// echo "New record created successfully !";
} else {
	echo json_encode(
		array( "status" => false, "message" => "No record found." ) );
}









?>