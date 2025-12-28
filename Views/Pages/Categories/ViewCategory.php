<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

echo ( new Head('Category View', '') )->Render();

FlashMessage::init();
FlashMessage::display();

include BASE_PATH . '/Views/Layouts/Sidebar.php';

?>

<main class="category-view">

    <section class="category-card">
        <header class="category-header">
            <h2><?= e($category['Name']) ?></h2>
            <nav class="category-actions">
                <a href="categories/<?= e($category['ID']) ?>/edit" class="btn-edit">Edit</a>
                <a href="categories/<?= e($category['ID']) ?>/delete" class="btn-delete">Delete</a>
                <a href="categories" class="btn-back">Back</a>
            </nav>
        </header>

        <p class="category-description"><?= e($category['Description']) ?></p>

        <ul class="category-config">
            <li>Order: <?= e($category['Order']) ?></li>
            <li>Visibility: <?= e($category['Visibility']) ?></li>
            <li>Comments: <?= e($category['Allow_Comment']) ?></li>
            <li>Ads: <?= e($category['Allow_Ads']) ?></li>
        </ul>

        <div class="items-grid">
            <?php foreach($items as $item): ?>
                <?php if($category['ID'] == $item['ICI']): ?>
                    <div class="item-card">
                        <h4><?= e($item['Name']) ?></h4>
                        <p><?= e($item['Description']) ?></p>
                        <span class="item-meta">Price: <?= e($item['Price']) ?>$</span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php
echo ( new Footer('script', '') )->Render();
?>
