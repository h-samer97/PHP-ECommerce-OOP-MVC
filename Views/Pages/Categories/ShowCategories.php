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

    <?php 
        foreach($rows as $row) {
            echo '<div class="cat-section">';
            echo '<h4>' . e($row['Name']) . '</h4>';
            echo '<a href="categories/' . e($row['ID']) . '/edit">edit</a> 
                  <a href="categories/' . e($row['ID']) . '/delete">delete</a>';
            
            echo '<div class="cat">';
            
            foreach($items as $item) {
                if($row['ID'] == $item['ICI']) {
                    echo '<div>' . e($item['Name']) . '</div>';
                }
            }

            echo '<p>' . e($row['Description']) . '</p>';
            
            echo '<div class="cat-config">';
                echo e($row['Order']);
                echo e($row['Visibility']);
                echo e($row['Allow_Comment']);
                echo e($row['Allow_Ads']);
            echo '</div>';

            echo '<a href="" class="cat-view">View</a>';
            echo '</div>';
        }      
    ?>
    </div>

</main>

<?php
echo ( new Footer('script', '') )->Render();
?>
