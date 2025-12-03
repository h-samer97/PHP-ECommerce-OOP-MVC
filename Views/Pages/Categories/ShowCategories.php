<?php

use Core\Helper\URL;
use Views\Layouts\Footer;
use Views\Layouts\Head;

    echo ( new Head('Categories', '') )->Render(); ?>

    <main class="all-categories">
       

        <?php 
        
                  foreach($rows as $row) {
                    echo '<div class="cat-section">';
                    echo '<h4>' . $row['Name'] . '</h4>';
                        echo '<a href="categories/' . $row['ID'] . '/edit">edit</a> <a href="categories/' . $row['ID'] . '/delete">delete</a>';
                    echo '<div class="cat">';
                   
                    foreach($items as $item) {

                        if($row['ID'] == $item['ICI']) {
                            echo '<div>' . $item['Name'] . '</div>';
                        }

                    }

                    echo '<p>'. $row['Description'] .'</p>';
                    echo '<div class="cat-config">';
                        echo $row['Order'];
                        echo $row['Visibility'];
                        echo $row['Allow_Comment'];
                        echo $row['Allow_Ads'];
                    echo '</div>';

                    echo '<a href="" class="cat-view">View</a>';
                    echo ' </div>';

                  }      
        
        ?>
        </div>

    </main>



<?php

    echo ( new Footer('script', '') )->Render();

?>