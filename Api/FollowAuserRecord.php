<?php
include( 'database-connection.php' );

header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );

$userid = $_REQUEST[ 'userid' ];
$visiterid = $_REQUEST[ 'visiterid' ];


$query = "SELECT * FROM usersfollowingrecord WHERE visiterid='$visiterid'";
$result = $conn->query( $query );
if ( $result ) {
	if ( $result->num_rows == 1 ) {
		echo json_encode(
			array( "status" => false, "message" => "The User Have Already Follow this Account" ) );
	} else {

		$sql = "UPDATE users SET Followers =Followers + 1 WHERE id='$userid'";
		if ( $conn->query( $sql ) === TRUE ) {
			$inertsql = "INSERT INTO usersfollowingrecord(userid,visiterid)
                     VALUES ('$userid','$visiterid')";

			if ( mysqli_query( $conn, $inertsql ) ) {
				// $last_id = $conn->insert_id;

				http_response_code( 200 );
				print_r( json_encode( array( "status" => true, "messege " => "success" ) ) );

			} else {
				echo json_encode(
					array( "status" => false, "message" => " Failed TO Insert. " ) );
			}
		} else {
			//echo "Error updating record: " . $conn->error;
			echo json_encode(
				array( "status" => false, "message" => "Error updating record:" . $conn->error ) );
		}
	}
} else {
	echo json_encode(
		array( "status" => false, "message" => "No connection found." ) );
}


?>