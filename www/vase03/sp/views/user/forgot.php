<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result) : ?>
                    <p>We sent new password on your email!</p>
                <?php else : ?>
                    <?php if (isset($errors) && is_array($errors)) : ?>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>Enter your email for password recovery</h2>
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>" />
                            <input type="submit" name="submit" class="btn btn-default" value="Done" />
                        </form>
                    </div>
                    <!--/sign up form-->

                <?php endif; ?>
                <br />
                <br />
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>
