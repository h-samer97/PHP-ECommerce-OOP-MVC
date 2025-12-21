<?php
use Views\Layouts\Head;
use Views\Layouts\Footer;

echo (new Head('عرض العناصر', 'categories'))->Render();
?>
<link rel="stylesheet" href="/css/category-items.css">

<div class="category-items-container">
    <div class="category-header">
        <h2>عناصر الفئة: <?php echo htmlspecialchars($categoryName); ?></h2>
    </div>

    <div class="items-grid">
        <?php foreach ($items as $item): ?>
            <div class="item-card">
                <div class="item-img">
                    <img src="/uploads/<?php echo $item['Image'] ?: 'default.png'; ?>" alt="">
                    <span class="item-price"><?php echo $item['Price']; ?>$</span>
                </div>
                <div class="item-content">
                    <h3><?php echo htmlspecialchars($item['Item_name']); ?></h3>
                    <div class="item-actions">
                        <span><?php echo $item['Add_Date']; ?></span>
                        <a href="/items/<?php echo $item['Item_id']; ?>/edit" class="btn-edit-link">
                             تعديل <i class="fa fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php echo (new Footer('script', ''))->Render(); ?>