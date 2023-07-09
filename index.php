<?php

require_once 'vendor/autoload.php';
require_once 'config/DatabaseConnection.php';

use App\Controllers\SaleController;
use config\DatabaseConnection;

$sale = new SaleController(DatabaseConnection::getInstance());
try {
    $saleCreate = $sale->create();
    if ($saleCreate) {
        echo "Data Inserted successfully.";
    } else {
        echo "Something went wrong!";
    }
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

echo '<br><a href="sale_view.php">View Data</a>';
