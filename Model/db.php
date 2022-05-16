<?php

$dbname = "protgmih_db";
$dbuser = "protgmih_asif";
$dbpass = "Iamboss@007";
$host	= "localhost";


function getConnection()
{
	global $dbname, $dbpass, $host, $dbuser;

	$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);
	return $conn;
}
