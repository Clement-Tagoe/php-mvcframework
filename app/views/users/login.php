<?php
  require APP_ROOT . '/views/includes/head.php';
?>

<div class="navbar">
<?php
  require APP_ROOT . '/views/includes/navigation.php';
?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Sign in</h2>

        <form action="<?php echo URL_ROOT; ?>/users/login" method="POST">
            <input type="text" placeholder="Username *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>
            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Not registered yet? <a href="<?php echo URL_ROOT; ?>/users/register">Create an Account!</a></p>
        </form>
    </div>
</div>