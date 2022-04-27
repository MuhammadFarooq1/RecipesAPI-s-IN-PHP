<?php

include( 'database-connection.php' );

header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );


$s_sql = "SELECT * FROM (
   SELECT * FROM popularkeywords ORDER BY id DESC LIMIT 10
) Var1
   ORDER BY id ASC";

$r_result = mysqli_query( $conn, $s_sql );

//   if ($r_result->num_rows > 1) {

//	$get = mysqli_fetch_assoc($r_result);

if ( $result = $conn->query( $s_sql ) ) {
	while ( $row = $result->fetch_assoc() ) {

		// set response code - 200 OK
		http_response_code( 200 );

		print_r( json_encode( array( "status" => true, "messege " => "success", "data" => ( $row ) ) ) );

		// echo "New record created successfully !";

	}
} else {
	echo json_encode(
		array( "status" => false, "message" => "No record found." ) );
}









?>