<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class DeliveryDB extends Database
{
    protected $tableName = 'sp_delivery';

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE delivery_type_id = :id;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function create($args)
    {
    }

    public function deleteById($id)
    {
    }

    public function updateById($id, $field, $newValue)
    {
    }
}


?>