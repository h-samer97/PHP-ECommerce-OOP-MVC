<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;

 echo (new Head('Add Category', 'addMember'))->Render();

        FlashMessage::init();
        FlashMessage::display();

?>
<form class="container" method="POST" action="<?php echo BASE_URL . 'categories/add'; ?>">
<div class="card">
  <div class="card-header">
    <h2>Add a new Category</h2>
  </div>
  <!-- ضع العناصر التالية داخل هذه البطاقة -->
</div>
<div class="field">
  <label class="label">
    Category Name
    <span class="req" aria-hidden="true">*</span>
  </label>
  <input type="text" class="input" placeholder="" required name="name">
</div>
<div class="field">
  <label class="label">Description Category</label>
  <textarea class="textarea" rows="3" placeholder="Describe" name="description"></textarea>
</div>
<div class="field">
  <label class="label">Sort</label>
  <div class="number-wrap">
    <input type="number" class="input number-input" min="0" step="1" placeholder="ex: 10" name="order">
    <span class="suffix">#</span>
  </div>

</div>
<div class="field">
  <label class="label">Visibility</label>
  <div class="radio-group">
    <label class="radio-item">
      <input type="radio" name="visible" value="1" checked>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">Yes</span>
    </label>
    <label class="radio-item">
      <input type="radio" name="visible" value="0">
      <span class="switch"><span class="dot"></span></span>
      <span class="text">No</span>
    </label>
  </div>
</div>

<div class="field">
  <label class="label">Allow Comments </label>
  <div class="radio-group">
    <label class="radio-item">
      <input type="radio" name="comments" value="1" checked>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">Yes</span>
    </label>
    <label class="radio-item">
      <input type="radio" name="comments" value="0">
      <span class="switch"><span class="dot"></span></span>
      <span class="text">No</span>
    </label>
  </div>
</div>

<div class="field">
  <label class="label">Allow Ads </label>
  <div class="radio-group">
    <label class="radio-item">
      <input type="radio" name="ads" value="1" checked>
      <span class="switch"><span class="dot"></span></span>
      <span class="text">Yes</span>
    </label>
    <label class="radio-item">
      <input type="radio" name="ads" value="0">
      <span class="switch"><span class="dot"></span></span>
      <span class="text">No</span>
    </label>
  </div>
</div>
<div class="actions">
  <button type="submit" class="btn-primary">
    Add Category
  </button>
</div>
</form>
<?php 


    echo (new Footer('script', 'chart.umd.min'))->Render();


?>