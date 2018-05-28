
	<?php
	
	require("config.php");

		// Start XML file, create parent node

		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("wifispots");
		$parnode = $dom->appendChild($node);


		// Select all the rows in the markers table

		$query = "SELECT * FROM wifispots WHERE 1";
		$result = mysql_query($query);
		if (!$result) {
		  die('Invalid query: ' . mysql_error());
		}

		header("Content-type: text/xml");

		// Iterate through the rows, adding XML nodes for each

		while ($row = @mysql_fetch_assoc($result)){
		  // Add to XML document node
		  $node = $dom->createElement("marker");
		  $newnode = $parnode->appendChild($node);
		  $newnode->setAttribute("WifiID",$row['WifiID']);
		  $newnode->setAttribute("Adress",$row['Adress']);
		  $newnode->setAttribute("Suburb", $row['Suburb']);
		  $newnode->setAttribute("Latitude", $row['Latitude']);
		  $newnode->setAttribute("Longitude", $row['Longitude']);
		}

		echo $dom->saveXML();
?>