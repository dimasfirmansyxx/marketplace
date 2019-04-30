<?php

include '../../require.php';

$myFunc = new AllFunction();

$table = 'tblproduk';
$primaryKey = 'id';
$columns = ['nama','kategori_id','harga'];


echo json_encode( 
	$myFunc->getDataTable($table,$primaryKey,$columns)
);

// $columns = array(
//     array( 'db' => 'nama','dt' => 0 ),
//     array( 'db' => 'kategori_id','dt' => 1 ),
//     array( 'db' => 'harga','dt' => 2 ),
// );

// $sql_details = array(
//     'user' => $userDB,
//     'pass' => $passDB,
//     'db'   => $selectDB,
//     'host' => $hostDB
// );


// echo json_encode(
//     SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
// );

