<?php

namespace Controllers;

use Services\APIServices;
use Views\Layouts\Footer;
use Views\Layouts\Head;

class DashboardController {
    private APIServices $api;

    public function __construct() {
        $this->api = new APIServices();
    }

    public function index() {
        echo (new Head('Dashboard', 'dashboard'))->Render();
        include BASE_PATH . '/Views/Pages/Dashboard.php';
        echo (new Footer('script', 'chart.umd.min'))->Render();
    }

    private function jsonResponse($data): void {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getUsersWithDates(): void {
        $this->jsonResponse($this->api->getUsersWithDates());
    }

    public function getCats(): void {
        $this->jsonResponse($this->api->getItemsCountWithCats());
    }

    public function getCountryMade(): void {
        $this->jsonResponse($this->api->getCountryMade());
    }

    public function searchBox(): void {
        $q = $_GET['q'] ?? '';
        $this->jsonResponse($this->api->searchData($q));
    }
}
