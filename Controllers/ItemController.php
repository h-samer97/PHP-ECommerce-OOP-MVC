<?php


    namespace Controllers;

use Core\Helper\Alert;
use Core\Helper\FlashMessage;
use Core\Helper\URL as HelperURL;
use Repositories\ItemRepository;
use Services\SessionsServices;
use Core\Helper\URL;
use Repositories\CategoryRepository;
use Repositories\UserRepository;
use Soap\Url as SoapUrl;

    class ItemController {

        public function __construct()
        {
            new SessionsServices();
        }

        public function insert() {
            
            $repo = new ItemRepository();
            $Cats = $repo->getCategoriesNameAID();
            $Members = $repo->getUsersWithID();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $required = ['item-name', 'item-description', 'item-price', 'item-country', 'item-status', 'item-rating', 'cat-id', 'member-id'];

                foreach($required as $req) {
                    if(empty($_POST[$req])) {
                        FlashMessage::init();
                        FlashMessage::error('Please Fill all Fields');
                        exit;
                    }
                }

                    $itemName = trim($_POST['item-name']);
                    $itemDescription = trim($_POST['item-description']);
                    $itemPrice = (float) $_POST['item-price'];
                    $itemCountry = trim($_POST['item-country']);
                    $itemStatus = (int) $_POST['item-status'];
                    $itemRating = (int) $_POST['item-rating'];
                    $catId = (int) $_POST['cat-id'];
                    $memberId = (int) $_POST['member-id'];

                if(!is_numeric($_POST['item-price']) or $_POST['item-price'] < 0) {
                    Alert::Print('invalid price');
                    exit;
                }

                 $repo = new ItemRepository();
                $status = $repo->insert($itemName, $itemDescription, $itemPrice, $itemCountry, $itemStatus, $itemRating, $catId, $memberId);

                if($status) {
                    FlashMessage::init();
                    FlashMessage::success('the item was inserted');
                    FlashMessage::display();
                    URL::redirect('items');
                    exit;
                }

                }

            include BASE_PATH . '/Views/Pages/Items/AddItem.php';

        }

        public function edit($id) {

            $repo = new ItemRepository();
            $row = $repo->findById($id);

            $repo2 = new CategoryRepository();
            $Cats = $repo2->showAllCategories();

            $repo3 = new UserRepository();
            $Members = $repo3->getAllMembers();

            include BASE_PATH . '/Views/Pages/Items/EditItem.php';

        }

        public function update() {

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                 $itemName = trim($_POST['item-name']);
                    $itemDescription = trim($_POST['item-description']);
                    $itemPrice = (float) $_POST['item-price'];
                    $itemCountry = trim($_POST['item-country']);
                    $itemStatus = (int) $_POST['item-status'];
                    $itemRating = (int) $_POST['item-rating'];
                    $catId = (int) $_POST['cat-id'];
                    $memberId = (int) $_POST['member-id'];

                    // read the item id (expected from a hidden input in the edit form)
                    $itemId = isset($_POST['item-id']) ? (int) $_POST['item-id'] : 0;

                if(!is_numeric($_POST['item-price']) or $_POST['item-price'] < 0) {
                    Alert::Print('invalid price');
                    exit;
                }

                $repo = new ItemRepository();
                $status = $repo->update($itemId, $itemName, $itemDescription, $itemPrice, $itemCountry, $itemStatus, $itemRating, $catId, $memberId);

                if($status) {

                    FlashMessage::init();
                    FlashMessage::success('this item had Updated!');
                    FlashMessage::display();
                    URL::redirect('items');

                }

            }

        }

        public function delete($id) {

            $repo = new ItemRepository();
            $repo->delete($id);

            FlashMessage::init();
            FlashMessage::success('item had deleted');

        }

    }

























?>