<?php

    use Core\Helper\URL;
use Services\LanguageLoader;
use Views\Layouts\Footer;
    use Views\Layouts\Head;
    echo (new Head('404', '404'))->Render();

?>
<aside>
    <i class="fa fa-bars side-br"></i>
    <span> <i class="fa fa-shopping-cart"></i> Ecomm</span>
    <ul class="side-list">
        <li class="active"><i class="fa fa-home"></i><a href="">Home</a></li>
        <li><i class="fa fa-home"></i><a href="/dashboard"><span><?php echo LanguageLoader::getKeyword('home') ?></span></a></li>
        <li><i class="fa fa-home"></i><a href="categories"><span><?php echo LanguageLoader::getKeyword('categories') ?></span></a></li>
        <li><i class="fa fa-home"></i><a href="memebrs"><span><?php echo LanguageLoader::getKeyword('members') ?></span></a></li>
        <li><i class="fa fa-home"></i><a href=""><span><?php echo LanguageLoader::getKeyword('logs') ?></span></a></li>
        <li><i class="fa fa-home"></i><a href="logout"><span><?php echo LanguageLoader::getKeyword('logout') ?></span></a></li>
    </ul>
    <a href="/logout">logout</a>
</aside>

<?php echo (new Footer('script', 'chart.umd.min'))->Render(); ?>