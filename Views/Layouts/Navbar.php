<?php

    namespace Views\Layouts;

use Core\Database\DBConnection;
use Core\Interfaces\ILayouts;
use Repositories\UserRepository;
use Services\LanguageLoader;

    class Navbar implements ILayouts {

        private LanguageLoader $language;
        private UserRepository $getUsername;
        private $Username;
        private string $urlLogout = BASE_URL . 'logout';

        public function Render(): string
        {
            $this->language = new LanguageLoader('en');
            $this->getUsername = new UserRepository( (new DBConnection())->getConnection() );
            $this->Username = $this->getUsername->findById($_SESSION['UserID']);
            $editUrl = BASE_URL . 'members?do=edit&userid=' . $_SESSION['UserID'];

            return <<< HTML

            <nav class='main-nav-bar'>

                <div class="container">
                    <ul class='mnb-list'>
                        <li>
                            <a href="dashboard">{$this->language::getKeyword('dashboard')}</a>
                        </li>

                        <li>
                            <a href="/categories">{$this->language::getKeyword('categories')}</a>
                        </li>

                        <li>
                            <a href="members">{$this->language::getKeyword('members')}</a>
                        </li>

                        <li>
                            <a href="items">{$this->language::getKeyword('items')}</a>
                        </li>

                        <li>
                            <a href="comments">{$this->language::getKeyword('comments')}</a>
                        </li>

                    </ul>

                    <div class="nav-drop-down">
                        <span>{$this->Username->getUsername()}</span>
                            <ul class="ndd-list">
                                <li>
                                    <a href="{$editUrl}"><i class=''></i> {$this->language::getKeyword('editmember')} </a>
                                </li>

                                <li>
                                    <a href=""><i class=''></i> {$this->language::getKeyword('settings')} </a>
                                </li>

                                <li>
                                    <a href="{$this->urlLogout}"><i class=''></i> {$this->language::getKeyword('logout')} </a>
                                </li>
                            </ul>
                    </div>

                </div>

            </nav>


            HTML;
        }

    }