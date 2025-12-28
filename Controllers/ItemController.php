<?php

namespace Controllers;

use Core\Helper\FlashMessage;
use Core\Helper\URL;
use Repositories\ItemRepository;
use Repositories\CategoryRepository;
use Repositories\UserRepository;
use Services\SessionsServices;
use Services\CSRFToken;

class ItemController {

    private SessionsServices $session;

    public function __construct()
    {
        $this->session = new SessionsServices();
            if(!$this->session->checkIfExist()) {
                URL::redirect('login');
                return;
            }
    }

    public function index() {

    $repo = new ItemRepository();

    $items = $repo->getItemsByCategoryId(1);

    include BASE_PATH . '/Views/Pages/Items/ItemsByCategory.php';
}


    private function getItemDataFromPost(): array
    {
        return [
            'id'          => isset($_POST['item-id']) ? (int) $_POST['item-id'] : 0,
            'name'        => trim($_POST['item-name'] ?? ''),
            'description' => trim($_POST['item-description'] ?? ''),
            'price'       => (float) ($_POST['item-price'] ?? 0),
            'country'     => trim($_POST['item-country'] ?? ''),
            'status'      => (int) ($_POST['item-status'] ?? 0),
            'rating'      => (int) ($_POST['item-rating'] ?? 0),
            'catId'       => (int) ($_POST['cat-id'] ?? 0),
            'memberId'    => (int) ($_POST['member-id'] ?? 0),
        ];
    }

    public function insert() {
        $repo = new ItemRepository();
        $Cats = $repo->getCategoriesNameAID();
        $Members = $repo->getUsersWithID();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = ['item-name', 'item-description', 'item-price', 'item-country', 'item-status', 'item-rating', 'cat-id', 'member-id'];

            foreach ($required as $req) {
                if (empty($_POST[$req])) {
                    FlashMessage::init();
                    FlashMessage::error('Please fill all fields');
                    URL::redirect('items');
                    return;
                }
            }

            $data = $this->getItemDataFromPost();

            if ($data['price'] < 0) {
                FlashMessage::init();
                FlashMessage::error('Invalid price');
                URL::redirect('items/insert');
                return;
            }

            $status = $repo->insert(
                $data['name'], $data['description'], $data['price'], $data['country'],
                $data['status'], $data['rating'], $data['catId'], $data['memberId']
            );

            FlashMessage::init();
            if ($status) {
                FlashMessage::success('Item inserted successfully!');
                URL::redirect('items');
            } else {
                FlashMessage::error('Failed to insert item');
                URL::redirect('items');
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

         $csrf = new CSRFToken();
        
        if(!$csrf->validateRequest($_SERVER, $_POST)) {
            http_response_code(419);
            FlashMessage::init();
            FlashMessage::error('Page Expired! - ERROR 419');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getItemDataFromPost();

            if ($data['price'] < 0) {
                FlashMessage::init();
                FlashMessage::error('Invalid price');
                URL::redirect('items/edit/' . $data['id']);
                return;
            }

            $repo = new ItemRepository();
            $status = $repo->update(
                $data['id'], $data['name'], $data['description'], $data['price'],
                $data['country'], $data['status'], $data['rating'], $data['catId'], $data['memberId']
            );

            FlashMessage::init();
            if ($status) {
                FlashMessage::init();
                FlashMessage::success('Item updated successfully!');
                URL::redirect('items');
            } else {
                FlashMessage::init();
                FlashMessage::error('Failed to update item');
                URL::redirect('items');
            }
        }
    }

    public function delete($id) {
        $repo = new ItemRepository();
        $status = $repo->delete($id);

        FlashMessage::init();
        if ($status) {
            FlashMessage::success('Item deleted successfully!');
        } else {
            FlashMessage::error('Failed to delete item');
        }
        URL::redirect('items');
    }
}

?>
