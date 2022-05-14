<?php
interface IEntityDB{
    
    public function fetchAll();

    public function fetchById($id);

    public function updateById($id, $field, $newValue);

    public function create($args);

    public function deleteById($id);
}
?>