<?php

interface DatabaseOperations {

    //create
    public function create($args);
    //read
    public function fetch($id);
    //update
    public function save($args);
    //delete
    public function delete($id);

}

?>