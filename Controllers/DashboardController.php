<?php

namespace Controllers;

use Core\Database\DBConnection;
use Core\Helper\Alert;
use Core\Helper\URL;
use Repositories\UserRepository;
use Services\SessionsServices;
use Views\Layouts\Footer;
use Views\Layouts\Head;
use Views\Layouts\Navbar;

class DashboardController {
    public function index() {
        $session = new SessionsServices();
        
        $sessionStatus = $session->has('username');
        if(!$sessionStatus) URL::redirect('login');
        
        $head = new Head('Dashboard', 'dashboard');
        echo $head->Render();


        include BASE_PATH . '/Views/Pages/Dashboard.php';

        echo (new Footer('script', 'chart.umd.min'))->Render();

        if ($session->has('username')) {
            
        } else {
            echo "No session found, please login.";
        }
    }

    public function searchBox() {

        include BASE_PATH . '/APIs/searchResulte.php';

    }

    public function getUsersWithDates() {

        include BASE_PATH . "/APIs/getUsersWithDates.php";

    }

    public function getCats() {

        include BASE_PATH . '/APIs/getItemsCountWithCats.php';

    }

    public function getCountryMade() {

        include BASE_PATH . '/APIs/getCountryMadeAPI.php';

    }


}
?>