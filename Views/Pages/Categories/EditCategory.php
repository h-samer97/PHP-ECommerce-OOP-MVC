<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;

 echo (new Head('Add Category', 'addMember'))->Render();

?>
<form class="container" method="POST" action="<?php echo BASE_URL . 'categories/' . $rows->ID . '/update' ?>">
<div class="card">
  <div class="card-header">
    <h2>Edit Category</h2>
  </div>
  <!-- ضع العناصر التالية داخل هذه البطاقة -->
</div>
<div class="field">
  <label class="label">
    Category Name
    <span class="req" aria-hidden="true">*</span>
  </label>
  <input type="text" class="input" placeholder="" name="name" value="<?php echo $rows->Name ?>">
  <input type="hidden" name="id" value="<?php echo $rows->ID ?>">
</div>
<div class="field">
  <label class="label">Description Category</label>
  <textarea class="textarea" rows="3" placeholder="Describe" name="description">
    <?php echo $rows->Description ?></textarea>
</div>
<div class="field">
  <label class="label">Sort</label>
  <div class="number-wrap">
    <input type="number" class="input number-input" min="0" step="1" placeholder="ex: 10" name="order" value="<?php echo $rows->Order ?>">
    <span class="suffix">#</span>
  </div>

</div>
<div class="field">
  <label class="label">Visibility</label>
  <div class="radio-group">
    <label class="radio-item">
      <input type="radio" name="visible" value="1" <?php if($rows->Visibility == 1) echo 'checked' ?>>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">Yes</span>
    </label>
    <label class="radio-item">
      <input type="radio" name="visible" value="0" <?php if($rows->Visibility == 0) echo 'checked' ?>>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">No</span>
    </label>
  </div>
</div>

<div class="field">
  <label class="label">Allow Comments </label>
  <div class="radio-group">
    <label class="radio-item">
      <input type="radio" name="comments" value="1" <?php if($rows->Allow_Comment == 1) echo 'checked' ?>>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">Yes</span>
    </label>
    <label class="radio-item">
      <input type="radio" name="comments" value="0" <?php if($rows->Allow_Comment == 0) echo 'checked' ?>>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">No</span>
    </label>
  </div>
</div>

<div class="field">
  <label class="label">Allow Ads </label>
  <div class="radio-group">
    <label class="radio-item">
      <input type="radio" name="ads" value="1" <?php if($rows->Allow_Ads == 1) echo 'checked' ?>>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">Yes</span>
    </label>
    <label class="radio-item">
      <input type="radio" name="ads" value="0" <?php if($rows->Allow_Ads == 0) echo 'checked' ?>>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">No</span>
    </label>
  </div>
</div>
<div class="actions">
  <button type="submit" class="btn-primary">
    Update Category
  </button>
</div>
</form>
<?php 


    echo (new Footer('script', 'chart.umd.min'))->Render();


?>