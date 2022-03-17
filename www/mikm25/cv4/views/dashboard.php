<?php

require_once __DIR__ . '/../db/UserDatabase.php';

$users = (new UserDatabase())->fetchUsers();

?>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <h1 class="text-center">Dashboard</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <div class="alert alert-success" role="alert">
            You have been successfully logged in!
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $index => $user): ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <div class="d-grid gap-2">
            <a href="./" class="btn btn-secondary btn-block">Home</a>
        </div>
    </div>
</div>