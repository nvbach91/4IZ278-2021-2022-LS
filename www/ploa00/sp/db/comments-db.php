<?php

require_once __DIR__ . '/db.php';

class CommentsDB extends DB
{
    protected $tableName = 'comments';

    public function fetchAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE comment_id = :comment_id LIMIT 1");
        $statement->execute(['comment_id' => $id]);
        $result = $statement->fetchAll();
        return isset($result[0]) ? $result[0] : '';
    }

    public function fetchByProperty($property)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE fk_property_id = :fk_property_id LIMIT 1");
        $statement->execute(['fk_property_id' => $property]);
        $result = $statement->fetchAll();
        return isset($result[0]) ? $result[0] : '';
    }

    public function countRaiting()
    {
        $statement = $this->pdo->query("SELECT COUNT(comment_id) FROM $this->tableName");
        return $statement->fetchColumn();
    }

    public function insert($propertyId, $content, $username, $rating)
    {
        $statement = $this->pdo->prepare("INSERT INTO
      $this->tableName (fk_property_id, content, username, rating)
      VALUES (:fk_property_id, :content, :username, :rating)");
        $statement->execute([
            'fk_property_id' => $propertyId,
            'content' => $content,
            'username' => $username,
            'rating' => $rating
        ]);
    }

    public function update($propertyId, $content, $user, $rating, $id)
    {
        $statement = $this->pdo->prepare("UPDATE $this->tableName SET fk_property_id = :fk_property_id, content = :content, username = :username, rating = :rating WHERE comment_id = :comment_id");
        $statement->execute([
            'fk_property_id' => $propertyId,
            'content' => $content,
            'username' => $user,
            'rating' => $rating,
            'comment_id' => $id
        ]);
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->tableName WHERE comment_id = :comment_id");
        $statement->execute([
            'comment_id' => $id
        ]);
    }
}
