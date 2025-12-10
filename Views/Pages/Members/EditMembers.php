<?php

use Services\CSRFToken;
use Views\Layouts\Footer;
use Views\Layouts\Head;

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
echo ( new Head('Edit Member', 'edit') )->Render();
?>
<form class="edit-form" method="POST" action="<?php echo BASE_URL . 'members/update'; ?>">
    <h2><i class="fa fa-user-edit"></i> Edit Member</h2>

    <div class="form-group">
      <label for="username" class="required">Username</label>
      <input type="hidden" name="userid" value="<?php echo e($userRecord->userID) ?>">
      <input type="text" id="username" placeholder="Enter username" name="username" 
             value="<?php echo e($userRecord->username) ?>" required>

             <?php
                $token = new CSRFToken();
               echo $token->generateFieldToken();
            ?>

    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" placeholder="Enter password" value="" name="newPassword">
      <input type="hidden" name="oldPassword" value="<?php echo e($userRecord->password) ?>">
    </div>

    <div class="form-group">
      <label for="email" class="required">Email</label>
      <input type="email" id="email" placeholder="Enter email" 
             value="<?php echo e($userRecord->email) ?>" name="email" required>
    </div>

    <div class="form-group">
      <label for="fullname" class="required">Full Name</label>
      <input type="text" id="fullname" placeholder="Enter full name" 
             value="<?php echo e($userRecord->fullName) ?>" name="fullName">
    </div>

    <button type="submit" class="btn-save"><i class="fa fa-save"></i> Save</button>
</form>
<?php

    echo ( new Footer('script', '') )->Render();

?>