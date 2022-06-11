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
        <h2>Register</h2>

        <form action="<?php echo URL_ROOT; ?>/users/register" method="POST">
            <input type="text" placeholder="Username *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>
            <input type="email" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>
            <input type="password" placeholder="Confirm password *" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Not registered yet? <a href="<?php echo URL_ROOT; ?>/users/register">Create an Account!</a></p>
        </form>
    </div>
</div>