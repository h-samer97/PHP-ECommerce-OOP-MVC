<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;

 echo (new Head('Add Member', 'addMember'))->Render();

?>
  <form class="edit-form" method="POST" action="<?php echo BASE_URL . 'members/insert'; ?>">
    <h2><i class="fa fa-user-edit"></i> Add a Member</h2>

    <div class="form-group">
      <label for="username" class="required">Username</label>
      <input type="text" id="username" placeholder="Enter username" name="username" value="" required>
    </div>

    <div class="form-group">
      <label for="password" class="required">Password</label>
      <input type="password" id="password" placeholder="Enter password" value="" name="newPassword">
    </div>

    <div class="form-group">
      <label for="email" class="required">Email</label>
      <input type="email" id="email" placeholder="Enter email" value="" name="email" required>
    </div>

    <div class="form-group">
      <label for="fullname" class="required">Full Name</label>
      <input type="text" id="fullname" placeholder="Enter full name" value="" name="fullName">
    </div>

    <button type="submit" class="btn-save"><i class="fa fa-save"></i> Save</button>
  </form>
<?php 


    echo (new Footer('script', 'chart.umd.min'))->Render();


?>