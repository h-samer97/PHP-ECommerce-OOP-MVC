<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;
use Core\Helper\URL;

echo ( new Head('Items', 'item') )->Render();

FlashMessage::init();
FlashMessage::display();

include BASE_PATH . '/Views/Layouts/Sidebar.php';

?>

<div class="container py-5">
  <h1 class="mb-4 text-center">Items List</h1>

  <div class="text-center mb-4">
    <a href="/items/insert" class="btn btn-success">
      <i class="fa fa-plus"></i> Add New Item
    </a>
  </div>

  <div class="items-grid">
    <?php foreach ($items as $item): ?>
      <div class="card item-card shadow-sm">

        <img src="<?= $item['Image'] ?? URL::ico('unknown') ?>" 
             class="card-img-top item-image" 
             alt="<?= htmlspecialchars($item['Item_name']) ?>">
        
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($item['Item_name']) ?></h5>
          <p class="card-text"><?= htmlspecialchars($item['Item_description']) ?></p>
          <p class="price">$<?= $item['Price'] ?></p>
          
          <p class="rating">
            <?php for ($i = 0; $i < (int)$item['Rating']; $i++): ?>
              <i class="fa fa-star"></i>
            <?php endfor; ?>
          </p>
          
          <p class="category-badge">
            <?= htmlspecialchars($item['CategoryName'] ?? 'Not specified') ?>
          </p>
          
          <a href="/items/<?= $item['Item_id'] ?>/edit" class="btn btn-warning">
            <i class="fa fa-edit"></i> Edit
          </a>
          <a href="/items/<?= $item['Item_id'] ?>/delete" class="btn btn-danger">
            <i class="fa fa-trash"></i> Delete
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php
echo ( new Footer('script', '') )->Render();
?>
