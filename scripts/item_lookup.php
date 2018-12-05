<?php


/*  
 Author: Alex Wenger
 Date: 12/04/2018
 Name: item_lookup.php
 Description: Server Script the returns query results from item_lookup.class.php
*/  


//load application settings
require_once ("application/config.php");

//load autoloader
require_once ("vendor/autoload.php");
echo "test";
$inventory = new InventoryModel();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    echo json_encode($inventory->GetItem($id));
}
    
