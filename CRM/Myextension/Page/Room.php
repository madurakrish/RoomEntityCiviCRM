<?php

require_once 'CRM/Core/Page.php';

class CRM_Myextension_Page_Room extends CRM_Core_Page {
  function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('List of Rooms'));

	//Database connection parameters		
	$servername = "localhost";
	$username = "root";
	$password = "admin123";
	$dbname = "civicrm";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT room_label, room_number, room_floor, room_ext FROM civicrm_room";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		
		//Output the column names
		echo "<table><tr><th>Room Label</th><th>Room Number</th><th>Room Floor</th><th>Room Extension</th></tr>";
		// Output data of each row
		while($row = $result->fetch_assoc()) {
			 echo "<tr><td>". $row["room_label"]. "</td><td>". $row["room_number"]. "</td><td>" . $row["room_floor"] . "</td><td>" . $row["room_ext"] . "</td></tr>";
		 }
		 echo "</table>";
	} else {
		 echo "No results";
	}

	$conn->close();	
			
    parent::run();
  }
}
