<?php

require_once 'vendor/autoload.php';
require_once 'config/DatabaseConnection.php';

use App\Controllers\SaleController;
use config\DatabaseConnection;

$sale = new SaleController(DatabaseConnection::getInstance());
$sale->index();
