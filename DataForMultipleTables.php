<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$host = 'localhost';
$username = 'root';
$password = '123';
$dbname = 'rexx_systems';

// Create a PDO connection
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

use \JsonMachine\Items;

require_once(__DIR__ . '/vendor/autoload.php');
$salesData = Items::fromFile('Code-Challenge(Sales).json');

//print_r($salesData);
//die();

$customersData = [];
$productsData = [];
$customerId = null;

foreach ($salesData as $key => $saleData)
{
    $customerEmailValue = array_column($customersData, 'email');
    if (!in_array($saleData->customer_mail, $customerEmailValue)) {
//        print_r($key);
        $customersData[] = [
            'email' => $saleData->customer_mail,
        ];

        // Insert into the customers table
        $customerQuery = 'INSERT INTO customers (name, email) VALUES (?, ?)';
        $customerStmt = $pdo->prepare($customerQuery);
        $customerStmt->execute([$saleData->customer_name, $saleData->customer_mail]);
        $customerId = $pdo->lastInsertId();
    }

    $productIdValue = array_column($productsData, 'id');
    if (!in_array($saleData->product_id, $productIdValue)) {
        $productsData[] = [
            'id' => $saleData->product_id,
        ];

        // Insert into the products table
        $productQuery = 'INSERT INTO products (id, name, price) VALUES (?, ?, ?)';
        $productStmt = $pdo->prepare($productQuery);
        $productStmt->execute([$saleData->product_id, $saleData->product_name, $saleData->product_price]);
//        $productId = $pdo->lastInsertId();
    }

    $productId = $saleData->product_id;
    $productName = $saleData->product_name;
    $productPrice = $saleData->product_price;
    $saleId = $saleData->sale_id;
    $saleDate = $saleData->sale_date;

    // Insert into the sales table
    $saleQuery = 'INSERT INTO sales (id, customer_id, sale_date, total_price) VALUES (?, ?, ?, ?)';
    $saleStmt = $pdo->prepare($saleQuery);
    $saleStmt->execute([$saleId, $customerId, $saleDate, $productPrice]);
//    $saleId = $pdo->lastInsertId();

    // Insert into the sale_products table
    $saleProductsQuery = 'INSERT INTO sale_products (sale_id, product_id, price) VALUES (?, ?, ?)';
    $saleProductsStmt = $pdo->prepare($saleProductsQuery);
    $saleProductsStmt->execute([$saleId, $productId, $productPrice]);
}

//echo "<pre>";
////print_r(array_unique($customersData, SORT_REGULAR));
//print_r($customersData);
//print_r($productsData);
//
//echo 'Data inserted successfully!';
//die();

?>