<?php

interface DatabaseOperations {
    public function fetchAll();
    public function fetchById($id);
    public function create($args);
    public function updateById($id, $field, $data);
    public function deleteById($id);
}

?>
