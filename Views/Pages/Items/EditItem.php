<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;

 echo (new Head('Add Category', 'addMember'))->Render();

?>
<div class="form-card">
  <h2><i class="fas fa-plus-circle"></i> Add New Item</h2>
  <form method="POST" action="<?php echo BASE_URL . 'items/' . $row['Item_id'] . '/update' ?>">
    <div class="form-group">
      <label for="item-name">Name of The Item</label>
      <div class="input-icon">
        <i class="fas fa-tag"></i>
        <input type="text" id="item-name" name="item-name" value="<?php echo $row['Item_name'] ?>" />
        <input type="hidden" id="item-name" name="item-id" value="<?php echo $row['Item_id'] ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="item-description">Description of The Item</label>
      <div class="input-icon">
        <i class="fas fa-align-left"></i>
        <textarea id="item-description" name="item-description"><?php echo $row['Item_description'] ?>
        </textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="item-price">Price of The Item</label>
      <div class="input-icon">
        <i class="fas fa-dollar-sign"></i>
        <input type="text" id="item-price" min="0" name="item-price" value="<?php echo $row['Price'] ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="item-country">Country of Made </label>
      <div class="input-icon">
        <i class="fas fa-globe"></i>
        <input type="text" id="item-country" name="item-country" value="<?php echo $row['Country_Made'] ?>" />
      </div>
    </div>

    <div class="form-group">
  <label for="item-status">Status</label>
  <div class="input-icon">
    <i class="fas fa-info-circle"></i>
    <select id="item-status" name="item-status" required>
      <option value="new" <?php echo ($row['Status_Item'] === 'new') ? 'selected' : ''; ?>>New</option>
      <option value="used" <?php echo ($row['Status_Item'] === 'used') ? 'selected' : ''; ?>>Used</option>
      <option value="refurbished" <?php echo ($row['Status_Item'] === 'refurbished') ? 'selected' : ''; ?>>Refurbished</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label for="item-rating">Rating</label>
  <div class="input-icon">
    <i class="fas fa-star"></i>
    <select id="item-rating" name="item-rating">
      <option value="0" <?php echo ($row['Rating'] == 0) ? 'selected' : ''; ?>>0 - No Rating</option>
      <option value="1" <?php echo ($row['Rating'] == 1) ? 'selected' : ''; ?>>1 - Poor</option>
      <option value="2" <?php echo ($row['Rating'] == 2) ? 'selected' : ''; ?>>2 - Fair</option>
      <option value="3" <?php echo ($row['Rating'] == 3) ? 'selected' : ''; ?>>3 - Good</option>
      <option value="4" <?php echo ($row['Rating'] == 4) ? 'selected' : ''; ?>>4 - Very Good</option>
      <option value="5" <?php echo ($row['Rating'] == 5) ? 'selected' : ''; ?>>5 - Excellent</option>
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

            foreach($Cats AS $Cat) {

              echo '<option value='.$Cat['ID'].'>' . $Cat['Name'] . '</option>';

            }

      ?>
      <!-- Add more categories dynamically from DB later -->
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

            foreach($Members AS $Member) {

              echo '<option value='.$Member['UserID'].'>' . $Member['Username'] . '</option>';

            }

      ?>

    </select>
  </div>
</div>


    <button type="submit" class="submit-btn">
      <i class="fas fa-edit"></i> Edit Item
    </button>
  </form>
</div>
