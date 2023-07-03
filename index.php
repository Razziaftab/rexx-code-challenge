<?php

require_once "ParseJson.php";
require_once "DatabaseConnection.php";

$salesData = ParseJson::ParseJsonFile();

$db = Database::getInstance();
$pdo = $db->getConnection();

$dataInsertion = "INSERT INTO sales_data (sale_id, customer_name, customer_mail, product_id, product_name, product_price,
                  sale_date) VALUES(?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($dataInsertion);
$pdo->beginTransaction();

try {
    if (iterator_count($salesData) > 0) {
        foreach ($salesData as $key => $saleData) {
            $stmt->execute([
                $saleData->sale_id,
                $saleData->customer_name,
                $saleData->customer_mail,
                $saleData->product_id,
                $saleData->product_name,
                $saleData->product_price,
                $saleData->sale_date,
            ]);

        }
    }
    $pdo->commit();
    echo 'Data Insert successfully. </br>';
    echo '<a href="view.php">View Data</a>';
} catch (PDOException $e) {
    // Rollback the transaction if any query fails
    $pdo->rollback();
    echo 'Error: ' . $e->getMessage();
    die();
}
?>