<?php

namespace App;

use PDO;
use PDOException;

class Repository
{
    private PDO $pdo;

    public function __construct()//функция для создания объекта
    {
        try {
            $config = require 'config.php';
            $this->pdo = new PDO($config['database']['db'], $config['database']['user'], $config['database']['password']); //присваивает пдо значение нью пдо
        } catch (PDOException $e) {
            error_log('Ошибка подключения к БД ');
            throw $e;
        }
    }

    //---------------- shoppers --------------------------------------

    public function shopperExists(int $shopperId): bool//проверяет существует ли шопер с переданным айдишником
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
SELECT COUNT(*) AS 'count'
FROM shopper
WHERE id = :product_id;
EOD
            );
            $query->bindValue(':product_id', $shopperId);
            $query->execute();
            $res = $query->fetch(PDO::FETCH_ASSOC);

            return $res['count'] === '1';
        } catch (PDOException $e) {
            error_log('Ошибка запроса к БД ');
            throw $e;
        }
    }

    public function getAllshoppers(): array//достаёт все строки из таблцы шопер
    {
        try {
            $query = $this->pdo->query(<<<EOD
SELECT id, city, belivable, money, is_active
FROM shopper;
EOD
            );

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Ошибка запроса к БД ');
            throw $e;
        }
    }

    public function updateshopper(array $shopper): void//обновление данных в шоппере
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
UPDATE shopper
SET
    money = /*'';drop database db;*/:money,
    is_active = :is_active,/*мы ставим двоеточие чтобы инъекции не было ((незапланированного удаления таблиц))*/
    city = :city,
    belivable = :belivable
WHERE id = :id;
EOD
            );

            $query->bindValue(':id', $shopper['id']);
            $query->bindValue(':money', $shopper['money']);//из массива шоппер берёт то что прислал пользователь (( экранирует чтобы значение поставлиось ))
            $query->bindValue(':is_active', $shopper['is_active']);
            $query->bindValue(':city', $shopper['city']);
            $query->bindValue(':belivable', $shopper['belivable']);

            $query->execute();
        } catch (PDOException $e) {
            error_log('Ошибка запроса к базе ');
            throw $e;
        }
    }

    public function addshopper(array $shopper): false|string
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
INSERT INTO shopper(city, belivable, money, is_active)
VALUES (:city, :belivable, :money, :is_active);
EOD
            );

            $query->bindValue(':money', $shopper['money']);
            $query->bindValue(':is_active', $shopper['is_active']);
            $query->bindValue(':city', $shopper['city']);
            $query->bindValue(':belivable', $shopper['belivable']);

            $query->execute();

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log('Ошибка запроса к базе ');
            throw $e;
        }
    }

    public function deleteshopper(string $id): void
    {
        $query = $this->pdo->prepare(<<<EOD
DELETE FROM products_sold
WHERE shopper_id = :shopper_id;
EOD
        );
        $query->bindValue(':shopper_id', $id);
        $query->execute();

        $query = $this->pdo->prepare(<<<EOD
DELETE FROM shopper
WHERE id = :id;
EOD
        );
        $query->bindValue(':id', $id);
        $query->execute();
    }

    //-------------------- products ------------------------

    public function productExists(int $productId): bool
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
SELECT COUNT(*) AS 'count'
FROM product
WHERE id = :product_id;
EOD
            );
            $query->bindValue(':product_id', $productId);
            $query->execute();
            $res = $query->fetch(PDO::FETCH_ASSOC);

            return (string)$res['count'] === '1';
        } catch (PDOException $e) {
            error_log('Ошибка запроса к БД ');
            throw $e;
        }
    }

    public function getAllproducts(array $data): array
    {
        try {
            $sql = <<<EOD
SELECT 
       c.id,
       c.category,
       c.price,
       
       tp.id AS 'tp.id',
       tp.country AS 'tp.country',
       tp.region AS 'tp.region',
       tp.license_from AS 'tp.license_from',
       tp.belivable AS 'tp.belivable',
       
       m.id AS 'm.id',
       m.name AS 'm.name',
       m.region AS 'm.region',
       m.belivable AS  'm.belivable',
       m.license_from AS 'm.license_from'
FROM product c
LEFT JOIN quality_control tp ON tp.id = c.quality_control_id
LEFT JOIN supplier m ON m.id = c.supplier_id
WHERE 1=1
EOD;

            if (!empty($data['product_id'])) {
                $sql .= ' AND c.id = :product_id';
            }
            if (!empty($data['category'])) {
                $sql .= ' AND c.category LIKE :category';
            }
            if (!empty($data['tp_id'])) {
                $sql .= ' AND tp.id = :tp_id';
            }
            if (!empty($data['tp_region'])) {
                $sql .= ' AND tp.region LIKE :tp_region';
            }
            if (!empty($data['m_id'])) {
                $sql .= ' AND m.id = :m_id';
            }
            if (!empty($data['m_name'])) {
                $sql .= ' AND m.name LIKE :m_name';
            }

            $limit = empty($data['items_per_page']) ? 30 : (int)$data['items_per_page'];
            $offset = empty($data['page_number']) ? 0 : ($data['page_number'] - 1) * $limit;

            $sql .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;

            $query = $this->pdo->prepare($sql);

            if (!empty($data['product_id'])) {
                $query->bindValue(':product_id', $data['product_id']);
            }
            if (!empty($data['category'])) {
                $query->bindValue(':category', $data['category'] . '%');
            }
            if (!empty($data['tp_id'])) {
                $query->bindValue(':tp_id', $data['tp_id']);
            }
            if (!empty($data['tp_region'])) {
                $query->bindValue(':tp_region', $data['tp_region'] . '%');
            }
            if (!empty($data['m_id'])) {
                $query->bindValue(':m_id', $data['m_id']);
            }
            if (!empty($data['m_name'])) {
                $query->bindValue(':m_name', $data['m_name'] . '%');
            }

            $query->execute();
            $products = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as &$product) {
                self::setupproduct($product);
            }
            unset($product);

            return $products;
        } catch (PDOException $e) {
            error_log('Ошибка запроса к базе ');
            throw $e;
        }
    }

    private static function setupproduct(array &$product): void
    {
        $product['quality_control'] = [
            'id' => $product['tp.id'],
            'country' => $product['tp.country'],
            'region' => $product['tp.region'],
            'license_from' => $product['tp.license_from'],
            'belivable' => $product['tp.belivable'],
        ];
        unset($product['tp.id'], $product['tp.country'], $product['tp.region'], $product['tp.license_from'], $product['tp.belivable']);

        $product['supplier'] = [
            'id' => $product['m.id'],
            'name' => $product['m.name'],
            'region' => $product['m.region'],
            'belivable' => $product['m.belivable'],
            'license_from' => $product['m.license_from'],
        ];
        unset($product['m.id'], $product['m.name'], $product['m.region'], $product['m.belivable'], $product['m.license_from']);
    }

    public function updateproduct(array $product): void
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
UPDATE product
SET
    price = :price,
    category = :category,
    supplier_id = :supplier_id,
    quality_control_id = :quality_control_id
WHERE id = :id;
EOD
            );

            $query->bindValue(':id', $product['id']);
            $query->bindValue(':price', $product['price']);
            $query->bindValue(':category', $product['category']);
            $query->bindValue(':supplier_id', $product['supplier_id']);
            $query->bindValue(':quality_control_id', $product['quality_control_id']);

            $query->execute();
        } catch (PDOException $e) {
            error_log('Ошибка запроса к базе ');
            throw $e;
        }
    }

    public function getproductInfoById(string $id): array
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
SELECT 
       c.id,
       c.category,
       c.price,
       
       tp.id AS 'tp.id',
       tp.country AS 'tp.country',
       tp.region AS 'tp.region',
       tp.license_from AS 'tp.license_from',
       tp.belivable AS 'tp.belivable',
       
       m.id AS 'm.id',
       m.name AS 'm.name',
       m.region AS 'm.region',
       m.belivable AS  'm.belivable',
       m.license_from AS 'm.license_from'
FROM product c
LEFT JOIN quality_control tp ON tp.id = c.quality_control_id
LEFT JOIN supplier m ON m.id = c.supplier_id
WHERE c.id = :id;
EOD
            );
            $query->bindValue(':id', $id);
            $query->execute();
            $product = $query->fetch(PDO::FETCH_ASSOC);

            self::setupproduct($product);
            $this->addproductFullInfo($product);

            return $product;
        } catch (PDOException $e) {
            error_log('Ошибка запроса к базе ');
            throw $e;
        }
    }

    private function addproductFullInfo(array &$product): void
    {
        $query = $this->pdo->prepare(<<<EOD
SELECT
    cs.id,
    cs.quantity,
    d.id AS 'd.id',
    d.belivable AS 'd.belivable',
    d.city AS 'd.city',
    d.is_active AS 'd.is_active',
    d.money AS 'd.money'
FROM products_sold cs
LEFT JOIN shopper d ON d.id = cs.shopper_id
WHERE cs.product_id = :product_id;
EOD
        );

        $query->bindValue(':product_id', $product['id']);
        $query->execute();
        $productsSold = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($productsSold as &$productSold) {
            self::setupproductSold($productSold);
        }
        unset($productSold);
        $product['products_sold'] = $productsSold;
    }

    private static function setupproductSold(array &$productSold): void
    {
        $productSold['shopper'] = [
            'id' => $productSold['d.id'],
            'belivable' => $productSold['d.belivable'],
            'city' => $productSold['d.city'],
            'is_active' => $productSold['d.is_active'],
            'money' => $productSold['d.money'],
        ];

        unset($productSold['d.id'], $productSold['d.belivable'], $productSold['d.city'], $productSold['d.is_active'], $productSold['d.money']);
    }

    public function addproduct(array $product): false|string
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
INSERT INTO product(supplier_id, quality_control_id, price, category)
VALUES (:supplier_id, :quality_control_id, :price, :category)
EOD
            );

            $query->bindValue(':price', $product['price']);
            $query->bindValue(':category', $product['category']);
            $query->bindValue(':supplier_id', $product['supplier_id']);
            $query->bindValue(':quality_control_id', $product['quality_control_id']);

            $query->execute();

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log('Ошибка запроса к базе ');
            throw $e;
        }
    }

    public function deleteproduct(string $id): void
    {
        $query = $this->pdo->prepare(<<<EOD
DELETE FROM products_sold
WHERE product_id = :product_id;
EOD
        );
        $query->bindValue(':product_id', $id);
        $query->execute();

        $query = $this->pdo->prepare(<<<EOD
DELETE FROM product
WHERE id = :id;
EOD
        );
        $query->bindValue(':id', $id);
        $query->execute();
    }

    //-------------------- productSold -------------------------

    public function deleteFromproduct(string $id): void
    {
        $query = $this->pdo->prepare(<<<EOD
DELETE FROM product
WHERE id = :id;
EOD
        );
        $query->bindValue(':id', $id);
        $query->execute();
    }

    public function addproductSold(array $productSold): false|string
    {
        try {
            $query = $this->pdo->prepare(<<<EOD
INSERT INTO products_sold(product_id, shopper_id, quantity)
VALUES (:product_id, :shopper_id, :quantity);
EOD
            );

            $query->bindValue(':product_id', $productSold['product_id']);
            $query->bindValue(':shopper_id', $productSold['shopper_id']);
            $query->bindValue(':quantity', $productSold['quantity']);

            $query->execute();

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log('Ошибка запроса к базе ');
            throw $e;
        }
    }

    //-------------------------------users-------------------------------------

    public function getUserByLogin(string $login): array|bool
    {
        $query = $this->pdo->prepare(<<<EOD
SELECT * FROM users
WHERE login = :login
EOD
        );

        $query->bindValue(':login', $login);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
