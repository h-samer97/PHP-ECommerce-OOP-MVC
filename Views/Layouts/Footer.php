<?php

    namespace Views\Layouts;

use Core\Helper\URL;
use Core\Interfaces\ILayouts;

    class Footer implements ILayouts {

        // protected ?string $path1 = null;
        protected string $js;
        protected string $charts;

        public function __construct(?string $path1, ?string $path2)
        {
                $this->charts   = URL::js($path1);
                $this->js       = URL::js($path2);
        }

        public function Render(): string
        {
            return <<< HTML
            </body>
                <script src="{$this->charts}" type="module" defer></script>
                <script src="{$this->js}" type="module" defer></script>
            </html>
            HTML;    
        }

    }






?>