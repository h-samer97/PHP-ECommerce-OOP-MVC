<?php
use Views\Layouts\Head;
use Views\Layouts\Footer;

// دالة الحماية
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

echo (new Head('Category Items', 'categories'))->Render();
?>

<div class="container main-content">
    <div class="page-header">
        <h1>Items in: <span><?php echo isset($category) ? e($category->Name) : 'Unknown'; ?></span></h1>
        <a href="<?php echo BASE_URL . 'items/insert'; ?>" class="btn-add">Add New Item <i class="fas fa-plus"></i></a>
    </div>

    <?php if (empty($items)): ?>
        <div class="alert alert-info">No items found in this category.</div>
    <?php else: ?>
        <div class="items-grid">
            <?php foreach ($items as $item): ?>
                <div class="item-card">
                    <div class="item-img">
                        <?php if(!empty($item['Image'])): ?>
                             <img src="<?php echo BASE_URL . 'uploads/' . e($item['Image']); ?>" alt="Item Image">
                        <?php else: ?>
                             <div class="no-img">No Image</div>
                        <?php endif; ?>
                        <span class="price-tag">$<?php echo e($item['Price']); ?></span>
                    </div>
                    <div class="item-body">
                        <h3><?php echo e($item['Item_name']); ?></h3>
                        <p><?php echo substr(e($item['Item_description']), 0, 50) . '...'; ?></p>
                        <div class="item-meta">
                            <span class="date"><i class="far fa-clock"></i> <?php echo date('M d, Y', strtotime($item['Add_Date'])); ?></span>
                            <a href="<?php echo BASE_URL . 'items/' . e($item['Item_id']) . '/edit'; ?>" class="btn-edit-item">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    
</style>

<?php echo (new Footer('script', 'chart.umd.min'))->Render(); ?>