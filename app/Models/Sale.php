<?php

namespace App\Models;

use Exception;
use PDOException;

class Sale
{
    private $table = "sales";
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Bulk insert
     *
     * @param $salesData
     * @return bool
     * @throws Exception
     */
    public function insert($salesData): bool
    {
        try {
            $this->connection->beginTransaction();

            $data = $questionMarks = [];

            foreach ($salesData as $saleData) {
                $questionMarks[] = '(?,?,?,?,?,?,?)';
                $data[] = $saleData->sale_id;
                $data[] = $saleData->customer_name;
                $data[] = $saleData->customer_mail;
                $data[] = $saleData->product_id;
                $data[] = $saleData->product_name;
                $data[] = $saleData->product_price;
                $data[] = $saleData->sale_date;
            }
            $query = "INSERT INTO " . $this->table . " (sale_id, customer_name, customer_mail, product_id, product_name, 
                    product_price, sale_date) VALUES " . implode(',', $questionMarks);
            $stmt = $this->connection->prepare($query);
            $stmt->execute($data);
            $this->connection->commit();
            return true;
        } catch (PDOException $e) {
            $this->connection->rollback();
            throw new Exception("Failed to insert Data: " . $e->getMessage());
        }
    }

    /**
     * Get All Data
     *
     * @param array $filters
     * @return mixed
     */
    public function getAll(array $filters)
    {
        $params = [];
        $query = "SELECT * FROM " . $this->table . " WHERE true ";
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                $query .= "AND {$key} LIKE ?";
                $params[] = "%{$filter}%";
            }
        }
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        $salesResult = $stmt->fetchAll();
        $this->connection = null;
        return $salesResult;
    }

}

