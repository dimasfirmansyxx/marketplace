<?php

function query($query) 
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];

	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function exeQuery($query)
{
	global $conn;
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function softDelete($tblname, $key, $value)
{
	global $conn;
	$query = mysqli_query($conn, "UPDATE $tblname SET dlt = true WHERE $key = '$value'");
	return mysqli_affected_rows($conn);
}

function checkAvailability($query)
{
	global $conn;
	$query = mysqli_query($conn, $query);
	if ( mysqli_num_rows($query) > 0 ) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function getData($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	return mysqli_fetch_array($result);
}

function redirect($destination)
{
	echo "
		<script>
			window.location = '$destination';
		</script>
	";
}

function uploadFile($destination,$paramName,$fileName = "random")
{
	$nama = $_FILES[$paramName]['name'];
	$tmpName = $_FILES[$paramName]['tmp_name'];

	if ( $fileName == "random" ) {
		$newName = uniqid() . '.' . strtolower(end(explode('.', $nama)));
	} else {
		$newName = $fileName;
	}

	move_uploaded_file($tmpName, $destination . $newName);

	return $newName;
}

function numRows($query)
{
	global $conn;
	$query = mysqli_query($conn,$query);
	return mysqli_num_rows($query);
}

function setSession($name,$value)
{
	$_SESSION["$name"] = $value;
}

function unsetSession($name)
{
	unset($_SESSION["$name"]);
}