<?php

require_once __DIR__ . '/db.php';

class PropertyDB extends DB
{
    protected $tableName = 'property';

    public function fetchAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE property_id = :property_id LIMIT 1");
        $statement->execute(['property_id' => $id]);
        $result = $statement->fetchAll();
        return isset($result[0]) ? $result[0] : '';
    }

    public function fetchByUser($userId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE fk_user_id = :fk_user_id LIMIT 1");
        $statement->execute(['fk_user_id' => $userId]);
        $result = $statement->fetchAll();
        return isset($result[0]) ? $result[0] : '';
    }

    public function fetchByCreator($userId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE fk_user_id = :fk_user_id");
        $statement->execute(['fk_user_id' => $userId]);
        return $statement->fetchAll();
    }

    public function searchByCategory($category)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE fk_category_id LIKE :fk_category_id");
        $statement->execute(['fk_category_id' => $category]);
        return $statement->fetchAll();
    }

    public function fetchByFavourites($user)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE property_id IN (SELECT fk_property_id from favourites WHERE fk_user_id = :user)");
        $statement->execute(['user' => $user]);
        return $statement->fetchAll();
    }

    public function fetchCount()
    {
        $statement = $this->pdo->query("SELECT COUNT(property_id) FROM $this->tableName");
        return $statement->fetchColumn();
    }

    public function fetchPagination($limit, $offset)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE property_id > 0 ORDER BY property_id ASC LIMIT ? OFFSET ?");
        $statement->bindParam(1, $limit, PDO::PARAM_INT);
        $statement->bindParam(2, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function insert($userId, $category, $description, $price, $owner, $phone, $email, $photo, $address)
    {
        $statement = $this->pdo->prepare("INSERT INTO
      $this->tableName (fk_user_id, fk_category_id, description, price, owner, phone, email, photo, address)
      VALUES (:fk_user_id, :fk_category_id, :description, :price, :owner, :phone, :email, :photo, :address)");
        $statement->execute([
            'fk_user_id' => $userId,
            'fk_category_id' => $category,
            'description' => $description,
            'price' => $price,
            'owner' => $owner,
            'phone' => $phone,
            'email' => $email,
            'photo' => $photo,
            'address' => $address
        ]);
    }

    public function update($userId, $category, $description, $price, $owner, $phone, $email, $photo, $address, $id)
    {
        $statement = $this->pdo->prepare("UPDATE $this->tableName
      SET fk_user_id = :fk_user_id, fk_category_id = :fk_category_id, description = :description, price = :price, owner = :owner, phone = :phone,
      email = :email, photo = :photo, address = :address
      WHERE property_id = :property_id");
        $statement->execute([
            'fk_user_id' => $userId,
            'fk_category_id' => $category,
            'description' => $description,
            'price' => $price,
            'owner' => $owner,
            'phone' => $phone,
            'email' => $email,
            'photo' => $photo,
            'address' => $address,
            'property_id' => $id
        ]);
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->tableName WHERE property_id = :property_id");
        $statement->execute(['property_id' => $id]);
    }
}
