<?php

    use Views\Layouts\Head;
    use Views\Layouts\Footer;

    echo (new Head('Add Member', 'addMember'))->Render();
?>

    <div class="curr-main">

        <div class="curr-nav">
            <h3>converter</h3>

            <div class="curr-nav-time">
                <span class="curr-h">00</span>
                <span class="curr-m">00</span>
                <span class="curr-s">00</span>
            </div>
            <div class="curr-last-update">
                last Update
                <div class="clu-l">
                    2010-01-01
                </div>
            </div>

        </div>

    </div>

<?php

    echo (new Footer('script', 'chart.umd.min'))->Render();

?>