<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result): ?>
                    <p>Message sent! We will reply you to your email.</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Feedback</h2>
                        <h5>Have a question? Write to us</h5>
                        <br/>
                        <form action="#" method="post">
                            <p>Your email</p>
                            <input type="email" name="userEmail" placeholder="E-mail" value="<?php echo htmlspecialchars($userEmail); ?>"/>
                            <p>Message</p>
                            <input type="text" name="userText" placeholder="Message" value="<?php echo htmlspecialchars($userText); ?>"/>
                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Sent" />
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