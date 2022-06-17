<?php include ROOT . '/views/layout/header.php'; ?>
<?php include ROOT . '/config/config_fb.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result) : ?>
                    <p>You have been registered!</p>
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
                        <h2>Registration on the site</h2>
                        <form action="#" method="post">
                            <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>" />
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>" />
                            <input type="password" name="password" placeholder="Password" value="<?echo htmlspecialchars($password); ?>" />
                            <input type="submit" name="submit" class="btn btn-default" value="Register" />
                        </form>
                        <div class="text-center">
                            <h4>or</h4>
                        </div>
                        <a href="https://www.facebook.com/v14.0/dialog/oauth?client_id=<?=ID?>&redirect_uri=<?=RE_URL?>&response_type=code&scope=public_profile,email" class="btn btn-primary btn-lg btn-block" role="button">Login with Facebook</a>
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