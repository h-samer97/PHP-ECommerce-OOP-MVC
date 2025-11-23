<?php

    namespace Views\Layouts;

    use Core\Abstracts\AbstractLayouts;
    use Core\Interfaces\ILayouts;
    use Core\Helper\URL;

    class Head extends AbstractLayouts implements ILayouts {

        protected string $title  = 'Defualt';
        protected $css;
        protected $fontAwesome;
        protected $favicon;

        public function __construct($title, $ico)
        {
            // $this->url = ;
            $this->title = $title;
            $this->css = URL::css('style');
            $this->fontAwesome = URL::css('all.min');
            $this->favicon = URL::ico($ico);
        }

                public function Render() : string {
        
                    return <<< HTML
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="{$this->css}">
                            <link rel="stylesheet" href="{$this->fontAwesome}">
                            <link rel="shortcut icon" href="{$this->favicon}" type="image/x-icon">
                            <title>{$this->title}</title>
                        </head>
                        <body>
                        
                        HTML;
                }

    }





?>