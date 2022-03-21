<?php

require('../Model/db.php');


function insert($order)
{
	$conn = getConnection();
	$sql = "insert into settings values( '')";

	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
		return false;
	}
}

function getAll()
{
	$conn = getConnection();
	$sql = "select * from settings";
	$result = mysqli_query($conn, $sql);
	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		array_push($data, $row);
	}

	return $data;
}
