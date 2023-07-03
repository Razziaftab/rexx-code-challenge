<?php

require_once "DatabaseConnection.php";

$db = Database::getInstance();
$pdo = $db->getConnection();

$searchQuery = "SELECT * FROM sales_data ";

$conditions=array();
if(!empty($_GET["customer_name"]))
{
    $customerName = $_GET['customer_name'];
    $conditions[]= " customer_name LIKE '%$customerName%'";
}
if(!empty($_GET["product_name"]))
{
    $productName = $_GET['product_name'];
    $conditions[]= "product_name LIKE '%$productName%'";
}
if(!empty($_GET["product_price"]))
{
    $productPrice = $_GET['product_price'];
    $conditions[]= "product_price LIKE '%$productPrice%'";
}

if ($conditions)
{
    $searchQuery .= " WHERE ".implode(" AND ", $conditions);
}

$stmt = $pdo->prepare($searchQuery);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Code Challenge</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body
        {
            padding:20px;
            margin:20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <h2>Sale Data Filtering </h2>
        <div class="col-12">
            <form method="Get">
                <label>Customer Name: </label>
                <p><input type="text" name="customer_name"></p>
                <label>Product Name: </label>
                <p><input type="text" name="product_name"></p>
                <label>Product Price: </label>
                <p><input type="number" min="1" name="product_price"></p>
                <input type="submit" value="search">
            </form>
        </div>
        <br /><br />
        <?php

        //Code for Displaying Data

        echo('<div class="col-12 m-10" >');
        echo('<table class="table table-borderless m-4"  >');
        echo('<thead class="thead-light ">');
        echo('<tr><th>Sales Id</th>');
        echo('<th>Customer Name</th>');
        echo('<th>Customer Email</th>');
        echo('<th>Product Id</th>');
        echo('<th>Product Name</th>');
        echo('<th>Product Price</th>');
        echo('<th>Sale Date</th></tr>');
        echo('</thead>');

        if (!empty($rows)) {
            $totalFees=0;
            foreach ($rows as $row) {

                echo "<tr><td>";
                echo(htmlentities($row['sale_id']));
                echo("</td><td>");
                echo(htmlentities($row['customer_name']));
                echo("</td><td>");
                echo(htmlentities($row['customer_mail']));
                echo("</td><td>");
                echo(htmlentities($row['product_id']));
                echo("</td><td>");
                echo(htmlentities($row['product_name']));
                echo("</td><td>");
                echo(htmlentities($row['product_price']));
                echo("</td><td>");
                echo(htmlentities($row['sale_date']));
                echo("</td>");
                echo("</tr>");
                $totalFees += $row['product_price'];

            }
            echo("<tr><td colspan='5'> <b>Total Product Price </b></td>");
            echo("<td colspan='2'>" . $totalFees . "</td></tr>");
        } else {
            echo("<tr><td colspan='5'> <b>Data not found. </b></td>");
        }
        echo("</table>");
        echo('</div>');
        ?>
    </div>
</div>
</body>