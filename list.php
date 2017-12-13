<?php
/**
 * Created by PhpStorm.
 * User: Linkyu
 * Date: 13/12/2017
 * Time: 09:54
 */

require "DB_Config.php";

// Create connection to app database
$app_conn = new mysqli($host_name, $user_name, $password, $db_app_name);
// Check connection
if ($app_conn->connect_error) {
    die("Connection failed: " . $app_conn->connect_error);
}
// Create connection to erp database
$erp_conn = new mysqli($host_name, $user_name, $password, $db_erp_name);
// Check connection
if ($erp_conn->connect_error) {
    die("Connection failed: " . $erp_conn->connect_error);
}

// Only get products that haven't been checked
$sql = "SELECT * from products where id NOT IN (select product_id from `linkyu_ikebois_app_db`.`conformite`)";
$result = $erp_conn->query($sql);

$products = array();

while($row = $result->fetch_assoc()) {
    array_push($products, array(
        "id"    =>  $row["id"],
        "name"  =>  $row["name"],
        "code"  =>  $row["code"]
    ));
}

$myJSON = json_encode($products);

header('Content-Type: application/json');
echo $myJSON;

$erp_conn->close();
$app_conn->close();