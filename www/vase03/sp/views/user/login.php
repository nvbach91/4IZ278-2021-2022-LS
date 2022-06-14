<?php include ROOT . '/views/layout/header.php'; ?>
<?php include ROOT . '/config/config_fb.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="signup-form"><!--sign up form-->
                    <h2>Sign in</h2>
                    <a href="/~vase03/sp/user/forgot" class="btn btn-link">Forgot your password?</a>
                    <form action="#" method="post">
                        <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>"/>
                        <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>"/>
                        <input type="submit" name="submit" class="btn btn-default" value="Login" />
                    </form>
                    <div class="text-center">
                            <h4>or</h4>
                    </div>
                    <a href="https://www.facebook.com/v14.0/dialog/oauth?client_id=<?=ID?>&redirect_uri=<?=RE_URL?>&response_type=code&scope=public_profile,email" class="btn btn-primary btn-lg btn-block" role="button">use Facebook</a>
                </div><!--/sign up form-->


                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>