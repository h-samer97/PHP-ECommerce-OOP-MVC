<?php

namespace Controllers;

use Services\APIServices;
use Services\CommentServices;
use Services\SessionsServices;
use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\URL;

class DashboardController {
    private APIServices $api;
    private CommentServices $comments;
    private SessionsServices $session;

    public function __construct() {

        $this->session = new SessionsServices();
        if(!$this->session->checkIfExist()) {
            URL::redirect('login');
            return;
        }

        $this->api = new APIServices();
        $this->comments = new CommentServices();
    }

    public function index() {
        echo (new Head('Dashboard', 'dashboard'))->Render();
        $comments = $this->comments->getLatestComments();
        include BASE_PATH . '/Views/Pages/Main/Dashboard.php';
        echo (new Footer('script', 'chart.umd.min'))->Render();
    }

    private function jsonResponse($data): void {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getUsersWithDates(): void {
        $this->jsonResponse($this->api->getUsersWithDates());
    }
    public function fetchNotifs() {
       print_r($this->jsonResponse($this->api->getNotifs()));
    }

    public function getCats(): void {
        $this->jsonResponse($this->api->getItemsCountWithCats());
    }

    public function monthlyRegistrationCount() : void {
        $this->jsonResponse($this->api->monthlyRegistrationCount());
    }

    public function getCountryMade(): void {
        $this->jsonResponse($this->api->getCountryMade());
    }

     public function analiysRating(): void {
        $this->jsonResponse($this->api->analiysRating());
    }

    public function analiysApprovedItems(): void {
        $this->jsonResponse($this->api->analiysApprovedItems());
    }

     public function getTotalItemsInCats(): void {
        $this->jsonResponse($this->api->getTotalItemsInCats());
    }

    public function getInformationToDashboard() : void {

       $this->jsonResponse($this->api->getInformationToDashboard());

    }

    public function searchBox(): void {
        $q = $_GET['q'] ?? '';
        $this->jsonResponse($this->api->searchData($q));
    }
}
