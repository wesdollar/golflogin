<?php

include_once('Connect.php');

// grab the connection
$connect = new Connect();

// query information_schema for databases
$cxn = $connect->cxn('information_schema');

$sql = "SELECT SCHEMA_NAME FROM SCHEMATA WHERE SCHEMA_NAME NOT IN ('information_schema', 'mysql', 'performance_schema')";
$query = mysqli_query($cxn, $sql) or die ('Query Failed. ' . mysqli_error($cxn));

// build database array to store databases
$databases = array();
$i = 0;
while ($row = mysqli_fetch_assoc($query)) {
    $databases[$i] = $row['SCHEMA_NAME'];
    $i++;
}

mysqli_close($cxn);

// loop through databases searching for string
$str = 'dbellefeuille@gmail.com';
$replace = 'NULL';
$tbl = 'gtm_users';

$sql = "SELECT id, email FROM $tbl WHERE email='$str'";

$targets = array();

foreach ($databases as $database) {
    $cxn = $connect->cxn($database);
    $query = mysqli_query($cxn, $sql);

    if ($query != null) {
        // add each result to the targets array
        $i = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            $targets[$i] = array('user_id' => $row['id'], 'email' => $row['email'], 'database' => $database);
        }
    }

    mysqli_close($cxn);

}

echo '<p><pre>';
print_r($targets);
echo '</pre></p>';

$j = 0;
// perform task when string is found
foreach ($targets as $target) {
    $id = $target['user_id'];
    $database = $target['database'];

    $cxn = $connect->cxn($database);
    $sql = "UPDATE $tbl SET email='$replace' WHERE id='$id'";
    $query = mysqli_query($cxn, $sql);

    if ($query != null) {
        $j++;
    }

}

$records = ($j == 1) ? 'record' : 'records';
$have = ($j == 1) ? 'has' : 'have';

echo '<p><strong>' .$j. '</strong> '. $records .' '.$have.' been updated.</p>';