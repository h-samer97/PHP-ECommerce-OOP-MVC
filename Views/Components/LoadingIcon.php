<?php

    namespace Views\Components;

    use Core\Abstracts\AbstractLayouts;
    use Core\Interfaces\ILayouts;
    use Core\Helper\URL;

    class LoadingIcon extends AbstractLayouts implements ILayouts {

        protected string $title  = 'Defualt';
        protected $css;
        protected $fontAwesome;
        protected $favicon;

        public function __construct($title, $ico)
        {
            
        }

                public function Render() : string {
        
                    return <<< HTML
                        
                            <div class='.load-icon'>
                                <img src="{URL::}" alt="">
                            </div>

                        HTML;
                }

    }





?>