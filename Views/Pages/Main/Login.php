<?php

    if(!empty($alertMessage)) echo $alertMessage;

?>

<form action="<?php echo BASE_URL . 'login'; ?>" method="post" class="login">
        <h2>login system</h2>
        <input type="text" placeholder="username" name="username" class="username">
        <input type="password" placeholder="password" name="password" class="password">
        <div class="password-box">
            <i class="fa fa-eye" id="eye"></i> show password
        </div>
        <input type="submit" value="Login" class="input-button">
        <div class="login-icon">
            <i class="fab fa-facebook"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-tiktok"></i>
        </div>
</form>