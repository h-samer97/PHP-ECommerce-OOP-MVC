<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;

 echo (new Head('Add Category', 'addMember'))->Render();

?>
<div class="form-card">
  <h2><i class="fas fa-plus-circle"></i> Add New Item</h2>
  <form method="POST" action="">
    <div class="form-group">
      <label for="item-name">Name of The Item <span>*</span></label>
      <div class="input-icon">
        <i class="fas fa-tag"></i>
        <input type="text" id="item-name" required name="item-name"/>
      </div>
    </div>

    <div class="form-group">
      <label for="item-description">Description of The Item <span>*</span></label>
      <div class="input-icon">
        <i class="fas fa-align-left"></i>
        <textarea id="item-description" required name="item-description"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="item-price">Price of The Item <span>*</span></label>
      <div class="input-icon">
        <i class="fas fa-dollar-sign"></i>
        <input type="number" id="item-price" min="0" required name="item-price"/>
      </div>
    </div>

    <div class="form-group">
      <label for="item-country">Country of Made <span>*</span></label>
      <div class="input-icon">
        <i class="fas fa-globe"></i>
        <input type="text" id="item-country" name="item-country" required />
      </div>
    </div>

    <div class="form-group">
      <label for="item-status">Status <span>*</span></label>
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
  <label for="item-rating">Rating <span>*</span></label>
  <div class="input-icon">
    <i class="fas fa-star"></i>
    <select id="item-rating" name="item-rating" required>
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
  <label for="cat-id">Category <span>*</span></label>
  <div class="input-icon">
    <i class="fas fa-folder-open"></i>
    <select id="cat-id" name="cat-id" required>
      <option value="">Select Category</option>
      <?php

            foreach($Cats AS $Cat) {

              echo '<option value='.$Cat['ID'].'>' . $Cat['Name'] . '</option>';

            }

      ?>
      <!-- Add more categories dynamically from DB later -->
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

            foreach($Members AS $Member) {

              echo '<option value='.$Member['UserID'].'>' . $Member['Username'] . '</option>';

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
