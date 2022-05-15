<?php

interface DatabaseOperations {
    public function fetchAll();
    public function fetchById($id);
    public function create($args);
    public function update($id, $field, $data);
    public function delete($id);
}

?>