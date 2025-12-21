<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;

// دالة مساعدة مختصرة
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

echo ( new Head('Categories', '') )->Render();

FlashMessage::init();
FlashMessage::display();

?>

<main class="all-categories">

    <?php foreach($rows as $row): ?>
        <section class="cat-section">
            <header class="cat-header">
                <h4><?= e($row['Name']) ?></h4>
                <nav class="cat-actions">
                    <a href="categories/<?= e($row['ID']) ?>/edit" class="btn-edit">Edit</a>
                    <a href="categories/<?= e($row['ID']) ?>/delete" class="btn-delete">Delete</a>
                </nav>
            </header>

            <div class="cat-items">
                <?php foreach($items as $item): ?>
                    <?php if($row['ID'] == $item['ICI']): ?>
                        <div class="cat-item"><?= e($item['Name']) ?></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <p class="cat-description"><?= e($row['Description']) ?></p>

            <ul class="cat-config">
                <li>Order: <?= e($row['Order']) ?></li>
                <li>Visibility: <?= e($row['Visibility']) ?></li>
                <li>Comments: <?= e($row['Allow_Comment']) ?></li>
                <li>Ads: <?= e($row['Allow_Ads']) ?></li>
            </ul>

            <footer class="cat-footer">
                <a href="categories/<?= e($row['ID']) ?>" class="cat-view">View</a>
            </footer>
        </section>
    <?php endforeach; ?>

</main>

<?php
echo ( new Footer('script', '') )->Render();
?>
