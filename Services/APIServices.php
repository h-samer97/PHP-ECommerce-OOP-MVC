<?php
namespace Services;

use Repositories\UserRepository;
use Core\Database\DBConnection;
use Repositories\CategoryRepository;
use Repositories\ItemRepository;
use PDO;
use Repositories\APIRepository;

class APIServices {
    private UserRepository $userRepo;
    private ItemRepository $itemRepo;
    private CategoryRepository $categoryRepo;
    private APIRepository $API;

    public function __construct() {
        $this->userRepo = new UserRepository((new DBConnection())->getConnection());
        $this->itemRepo = new ItemRepository((new DBConnection())->getConnection());
        $this->categoryRepo = new CategoryRepository((new DBConnection())->getConnection());
        $this->API = new APIRepository();
    }

    public function getUsersWithDates(): array {
        return $this->userRepo->getUsersAndDates();
    }

    public function getItemsCountWithCats(): array {
        return $this->itemRepo->getItemsCountWithCats();
    }

    public function getCountryMade(): array {
        return $this->itemRepo->getCountryMadeAPI();
    }

    public function analiysRating() : array {
        return $this->itemRepo->analiysRating();
    }

     public function analiysApprovedItems() : array {
        return $this->itemRepo->analiysApprovedItems();
    }

    public function getTotalItemsInCats() : array {
        return $this->categoryRepo->getTotalItemsInCats();
    }

    public function monthlyRegistrationCount(): array {
        return $this->userRepo->monthlyRegistrationCount();
    }
    public function getNotifs() {
        $session = new SessionsServices();
        return $this->API->getNotification($session->get('UserID'));
    }

    public function getInformationToDashboard() : array {
        $session = new SessionsServices();
        $id = $session->get('UserID');
        return $this->API->getInformationToDashboard($id);
    }

    public function searchData(): array {
                
        $Conn = (new DBConnection())->getConnection();
        $q    = $_GET['q'] ?? '';
        $resulte = [];
        $SQL1 = 'SELECT `Username`, `UserID` FROM users WHERE Username LIKE ?';
        $SQL2 = 'SELECT `Name`, `ID` FROM categories WHERE `Name` LIKE ?';
        $SQL3 = 'SELECT `Item_name`, `Item_id` FROM items WHERE `Item_name` LIKE ?';

        $stmt = $Conn->prepare($SQL1);
        $stmt->execute(["%{$q}%"]);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt2 = $Conn->prepare($SQL2);
        $stmt2->execute(["%{$q}%"]);
        $categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $stmt3 = $Conn->prepare($SQL3);
        $stmt3->execute(["%{$q}%"]);
        $items = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        $resulte = [
        "users" => $users,
        "categories" => $categories,
        "items" => $items
        ];

        return $resulte;

    }
}


?>