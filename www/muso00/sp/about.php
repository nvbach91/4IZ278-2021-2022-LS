<?php
$title = 'About us';
$pageActive = 3;
session_start();
?>
<?php require __DIR__ . '/incl/head.php'; ?>
<?php require __DIR__ . '/incl/nav.php'; ?>
<main>
    <h1 class="text-center">About us</h1>
    <section>
        <div class="container w-50 mx-auto mt-5">
            <div class="row text-center text-secondary fs-4">
                    Liquor Town delivers your favorite liquor to your door. Choose from our large selection of popular spirits
                    and hard to find rare liquors from the comfort of your own home. We are your one stop shop for all your alcohol needs. Whether you are looking for whisky, tequila,
                    rum, vodka, or any other type of spirits we got you covered.
            </div>
            <div class="row w-25 mx-auto mt-5">
                <a class="btn btn-outline-warning p-2" href="./products.php">Start shopping</a>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/incl/foot.php'; ?>