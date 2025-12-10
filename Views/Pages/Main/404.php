<?php

use Core\Helper\URL;
use Views\Layouts\Footer;
use Views\Layouts\Head;

echo (new Head('404', '404'))->Render(); ?>

<img src="<?php echo URL::ico('404') ?>" alt="error404" class="E404">

<?php echo (new Footer('script', 'echarts.min'))->Render(); ?>