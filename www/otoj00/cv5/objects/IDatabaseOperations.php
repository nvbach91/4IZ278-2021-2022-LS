<?php

interface IDatabaseOperations
{
    //Interface functions are always public, no need to specify further
    function create($args);

    function fetch(string $number);

    function save();

    function delete(string $number);
}