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

	public function getNewId($tblname)
	{
		global $conn;
		$row = $this->getData("SELECT * FROM $tblname ORDER BY id DESC");
		$id = $row['id'] + 1;
		return $id;
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
		// return $query;
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
		return mysqli_fetch_assoc($result);
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
		$ekstensi = strtolower(end(explode('.', $nama)));
		$allow = ['jpg','jpeg','png','bmp','svg','gif','tiff'];

		if ( in_array($ekstensi, $allow) ) {
			if ( $fileName == "random" ) {
				$newName = uniqid() . '.' . $ekstensi;
			} else {
				$newName = $fileName;
			}

			move_uploaded_file($tmpName, $destination . $newName);

			return $newName;
		}
	}

	public function filterWord($word)
	{
		global $conn;
		// $word = htmlspecialchars($word);
		$word = stripslashes($word);
		$word = mysqli_real_escape_string($conn, $word);
		return $word;
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
