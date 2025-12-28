<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;
use Services\CSRFToken;

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

echo (new Head('Add Item', 'item'))->Render();

FlashMessage::init();
FlashMessage::display();
include BASE_PATH . '/Views/Layouts/Sidebar.php';
?>
<div class="form-card">
  <h2><i class="fas fa-plus-circle"></i> Add New Item</h2>
  <form method="POST" action="items/insert">
    <div class="form-group">
      <label for="item-name">Name of The Item</label>
      <div class="input-icon">
        <i class="fas fa-tag"></i>
        <input type="text" id="item-name" name="item-name" value="" />
        <?php
            $csrf = new CSRFToken();
            echo $csrf->generateFieldToken();
        ?>
      </div>
    </div>

    <div class="form-group">
      <label for="item-description">Description of The Item</label>
      <div class="input-icon">
        <i class="fas fa-align-left"></i>
        <textarea id="item-description" name="item-description"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="item-price">Price of The Item</label>
      <div class="input-icon">
        <i class="fas fa-dollar-sign"></i>
        <input type="text" id="item-price" min="0" name="item-price" value=""/>
      </div>
    </div>

    <div class="form-group">
      <label for="item-country">Country of Made </label>
      <div class="input-icon">
        <i class="fas fa-globe"></i>
        <input type="text" id="item-country" name="item-country" value="" />
      </div>
    </div>

    <div class="form-group">
      <label for="item-status">Status</label>
      <div class="input-icon">
        <i class="fas fa-info-circle"></i>
        <select id="item-status" name="item-status" required>
          <option value="new">New</option>
          <option value="used">Used</option>
          <option value="refurbished">Refurbished</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="item-rating">Rating</label>
      <div class="input-icon">
        <i class="fas fa-star"></i>
        <select id="item-rating" name="item-rating">
          <option value="0">0 - No Rating</option>
          <option value="1">1 - Poor</option>
          <option value="2">2 - Fair</option>
          <option value="3">3 - Good</option>
          <option value="4">4 - Very Good</option>
          <option value="5">5 - Excellent</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="cat-id">Category</label>
      <div class="input-icon">
        <i class="fas fa-folder-open"></i>
        <select id="cat-id" name="cat-id">
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
      <label for="member-id">Member</label>
      <div class="input-icon">
        <i class="fas fa-user"></i>
        <select id="member-id" name="member-id">
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
      <i class="fas fa-plus-circle"></i> Add Item
    </button>
  </form>
</div>

<?php
echo (new Footer('script', 'chart.umd.min'))->Render();
?>
