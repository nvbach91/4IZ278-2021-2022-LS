<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class OrdersDB extends Database
{
    protected $tableName = 'sp_orders';

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :id ORDER BY date DESC LIMIT 1;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function fetchByAnyId($id, $value)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE $id = :value ORDER BY date DESC;");
        $stmt->execute(['value' => $value,]);
        return $stmt;
    }

    public function create($args)
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (date, user_id, full_name, address, phone, payment, delivery_type_id) " . " VALUES (:date, :user_id, :full_name, :address, :phone, :payment, :delivery_type_id);");
        $stmt->execute([
            'date' => $args['date'],
            'user_id' => $args['userId'],
            'full_name' => $args['fullName'],
            'address' => $args['address'],
            'phone' => $args['phone'],
            'payment' => $args['payment'],
            'delivery_type_id' => $args['deliveryTypeId'],
        ]);
    }

    public function deleteById($id)
    {
    }

    public function updateById($id, $field, $newValue)
    {
    }
}


?>