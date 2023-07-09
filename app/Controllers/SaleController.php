<?php

namespace App\Controllers;

use App\Services\JsonParseService;
use config\DatabaseConnection;
use App\Models\Sale;
use Exception;
use PDO;

class SaleController
{
    private PDO $db;

    /**
     * Instantiate object with database connection
     */
    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getConnection();
    }

    public function index(): void
    {
        $filters = [];
        if (!empty($_GET["customer_name"])) {
            $filters['customer_name'] = filter_input(INPUT_GET, 'customer_name');
        }
        if (!empty($_GET["product_name"])) {
            $filters['product_name'] = filter_input(INPUT_GET, 'product_name');
        }
        if (!empty($_GET["product_price"])) {
            $filters['product_price'] = filter_input(INPUT_GET, 'product_price');
        }

        $sale = new Sale($this->db);
        $sales = $sale->getAll($filters);

        require_once __DIR__ . "/../../views/sale_view.php";
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function create(): bool
    {
        $jsonParse = new JsonParseService();
        $salesData = $jsonParse->ParseJsonFile();

        if (iterator_count($salesData) > 0) {
            $sale = new Sale($this->db);
            $sale->insert($salesData);
            return true;
        }
        return false;
    }
}