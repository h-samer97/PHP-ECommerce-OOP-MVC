<?php

    namespace Core\Abstracts;

    use Exception;

    abstract class AbstractLanguage {

        protected static array $language = [];


        public static function getKeyword($key) : string {

            return self::$language[$key];

        }

        public function __construct(string $file = 'en') {

            $langFilePath = BASE_PATH . '/Language/' . $file . '.php';

            if(file_exists($langFilePath)) {

                $translations = include $langFilePath;

                    if(is_array($translations)) {

                        self::$language = $translations;

                    } else {

                        throw new Exception('The language file does not contain a valid array !');

                    }

            } else {

                        throw new Exception('The Language File does NOT Exist');

            }

        }

    }

?>