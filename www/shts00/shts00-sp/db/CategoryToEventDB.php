<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class CategoryToEventDB extends DBConnection  {

    public function create($args){
        $sql = 'INSERT INTO category_to_event (category_category_id, event_event_id) VALUES (:category_category_id, :event_event_id)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'category_category_id' => $args['category_id'],
            'event_event_id' => $args['event_id']
        ]);

    }
}