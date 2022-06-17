<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <p>Password was changed!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Change password</h2>
                        <form action="#" method="post">
                            <p>New password:</p>
                            <input type="password" name="password" placeholder="Password" value=""/>

                            <p>Repeat new password:</p>
                            <input type="password" name="password2" placeholder="Repeat password" value=""/>
                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Save" />
                        </form>
                    </div><!--/sign up form-->
                
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>