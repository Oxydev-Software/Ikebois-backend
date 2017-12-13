<?php
/**
 * Created by PhpStorm.
 * User: Linkyu
 * Date: 13/12/2017
 * Time: 09:54
 */
$myObj = null;
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myJSON = json_encode($myObj);

echo $myJSON;