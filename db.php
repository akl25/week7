<?php
$hostname = "sql2.njit.edu";
$username = "akl25";
$password = "9TCE4kP41";
$conn = NULL;
try 
{
    $conn = new PDO("mysql:host=$hostname;dbname=akl25",
    $username, $password);
    echo "<p>Connected successfully<br></p>";
}
catch(PDOException $e)
{
	// echo "Connection failed: " . $e->getMessage();
	http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage().'<br>');
}

// Runs SQL query and returns results (if valid)
function runQuery($query) {
	global $conn;
    try {
		$q = $conn->prepare($query);
		$q->execute();
		$results = $q->fetchAll();
		$q->closeCursor();
		return $results;	
	} catch (PDOException $e) {
		http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
	}	  
}

function http_error($message) 
{
	header("Content-type: text/plain");
	die($message);
}

?>