<?php
include "include/header.php";

if (empty($_SESSION["login_id"])) header("Location: ./");
if ($_SESSION["login_role"] != 1) header("Location: ./"); 
?>

<h1 class="text-center text-black mt-5">Admin Panel</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-md-5">
            <div class="card my-5">
                <div class="m-3">
                    <a class="btn btn-lg btn-primary w-75" href="./sales">Sales</a>
                </div>
                <div class="m-3">
                    <a class="btn btn-lg btn-primary w-75" href="./users">Users</a>
                </div>
                <div class="m-3">
                    <a class="btn btn-lg btn-primary w-75" href="./orders">Orders</a>
                </div>
                <div class="m-3">
                    <a class="btn btn-lg btn-primary w-75" href="./addProduct">Add Product</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>
