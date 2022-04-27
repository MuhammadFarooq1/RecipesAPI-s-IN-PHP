<?php
include( 'database-connection.php' );

header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );


$catagorie = $_REQUEST[ 'catagorie' ];


$s_sql = "SELECT * FROM addproduct WHERE catagorie='$catagorie' ";
$r_result = mysqli_query( $conn, $s_sql );

if ( $r_result = $conn->query( $s_sql ) ) {
	while ( $row = $r_result->fetch_assoc() ) {

		// set response code - 200 OK
		http_response_code( 200 );

		print_r( json_encode( array( "status" => true, "messege " => "success", "data" => ( $row ) ) ) );
}
} else {
	echo json_encode(
		array( "status" => false, "message" => "No record found." ) );
}



?>