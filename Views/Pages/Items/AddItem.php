<?php

use Core\Helper\FlashMessage;
use Views\Layouts\Footer;
use Views\Layouts\Head;

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

echo (new Head('Add Category', 'addMember'))->Render();

FlashMessage::init();
FlashMessage::display();

?>
<div class="form-card">
  <h2><i class="fas fa-plus-circle"></i> Add New Item</h2>
  <form method="POST" action="">
    <!-- باقي الحقول كما هي -->
    
    <div class="form-group">
      <label for="cat-id">Category <span>*</span></label>
      <div class="input-icon">
        <i class="fas fa-folder-open"></i>
        <select id="cat-id" name="cat-id" required>
          <option value="">Select Category</option>
          <?php
              foreach($Cats as $Cat) {
                  echo '<option value="' . e($Cat['ID']) . '">' . e($Cat['Name']) . '</option>';
              }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="member-id">Member <span>*</span></label>
      <div class="input-icon">
        <i class="fas fa-user"></i>
        <select id="member-id" name="member-id" required>
          <option value="">Select Member</option>
          <?php
              foreach($Members as $Member) {
                  echo '<option value="' . e($Member['UserID']) . '">' . e($Member['Username']) . '</option>';
              }
          ?>
        </select>
      </div>
    </div>

    <button type="submit" class="submit-btn">
      <i class="fas fa-plus"></i> Add Item
    </button>
  </form>
</div>
