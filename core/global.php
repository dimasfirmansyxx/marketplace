<?php

class GlobalFunction{

	public function query($query) 
	{
		global $conn;
		$result = mysqli_query($conn, $query);
		$rows = [];

		while ( $row = mysqli_fetch_assoc($result) ) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function exeQuery($query)
	{
		global $conn;
		mysqli_query($conn,$query);
		return mysqli_affected_rows($conn);
	}

	public function softDelete($tblname, $key, $value)
	{
		global $conn;
		$query = mysqli_query($conn, "UPDATE $tblname SET dlt = true WHERE $key = '$value'");
		return mysqli_affected_rows($conn);
	}

	public function checkAvailability($query)
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

	public function getData($query)
	{
		global $conn;
		$result = mysqli_query($conn, $query);
		return mysqli_fetch_array($result);
	}

	public function redirect($destination)
	{
		echo "
			<script>
				window.location = '$destination';
			</script>
		";
	}

	public function uploadFile($destination,$paramName,$fileName = "random")
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

	public function numRows($query)
	{
		global $conn;
		$query = mysqli_query($conn,$query);
		return mysqli_num_rows($query);
	}

	public function setSession($name,$value)
	{
		$_SESSION["$name"] = $value;
	}

	public function unsetSession($name)
	{
		unset($_SESSION["$name"]);
	}

}
