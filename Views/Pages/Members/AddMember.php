<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;
use Services\CSRFToken;

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

echo (new Head('Add Member', 'addMember'))->Render();

FlashMessage::init();
FlashMessage::display();

?>
<form class="edit-form" method="POST" action="<?php echo BASE_URL . 'members/insert'; ?>">
  <h2><i class="fa fa-user-edit"></i> Add a Member</h2>

  <div class="form-group">
    <label for="username" class="required">Username</label>
    <input type="text" id="username" placeholder="Enter username" name="username" 
           value="<?php echo isset($row['Username']) ? e($row['Username']) : '' ?>" required>
           <?php
                $token = new CSRFToken();
                $token->generateFieldToken();
            ?>
  </div>

  <div class="form-group">
    <label for="password" class="required">Password</label>
    <input type="password" id="password" placeholder="Enter password" 
           name="newPassword" value="">
  </div>

  <div class="form-group">
    <label for="email" class="required">Email</label>
    <input type="email" id="email" placeholder="Enter email" name="email" 
           value="<?php echo isset($row['Email']) ? e($row['Email']) : '' ?>" required>
  </div>

  <div class="form-group">
    <label for="fullname" class="required">Full Name</label>
    <input type="text" id="fullname" placeholder="Enter full name" name="fullName" 
           value="<?php echo isset($row['FullName']) ? e($row['FullName']) : '' ?>">
  </div>

  <button type="submit" class="btn-save"><i class="fa fa-save"></i> Save</button>
</form>

<?php 
echo (new Footer('script', 'chart.umd.min'))->Render();
?>
