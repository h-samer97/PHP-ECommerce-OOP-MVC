<?php

use Services\LanguageLoader;

?>
<aside class="hide">
    <i class="fa fa-bars side-br"></i>
    <span> <i class="fa fa-shopping-cart"></i> Ecomm</span>
    <ul class="side-list">
        <li><a href="dashboard"><i class="fa fa-tachometer-alt active"></i> <span><?php echo LanguageLoader::getKeyword('home') ?></span></a></li>
        <li><a href="categories"><i class="fa fa-list"></i> <span><?php echo LanguageLoader::getKeyword('categories') ?></span></a></li>
        <li><a href="members"><i class="fa fa-users"></i> <span><?php echo LanguageLoader::getKeyword('members') ?></span></a></li>
        <li><a href="comments"><i class="fa fa-comments"></i> <span><?php echo LanguageLoader::getKeyword('comments') ?></span></a></li>
        <li><a href="items"><i class="fa fa-box"></i> <span><?php echo LanguageLoader::getKeyword('items') ?></span></a></li>
        <li><a href="logout"><i class="fa fa-sign-out-alt"></i> <span><?php echo LanguageLoader::getKeyword('logout') ?></span></a></li>
    </ul>
</aside>
