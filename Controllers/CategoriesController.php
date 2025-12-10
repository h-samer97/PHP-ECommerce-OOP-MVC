<?php 

namespace Controllers;

use Core\Helper\FlashMessage;
use Core\Helper\URL;
use Repositories\CategoryRepository;
use Repositories\ItemRepository;
use Services\SessionsServices;
use Services\CSRFToken;
use Exception;

class CategoriesController {

    public function __construct()
    {
            new SessionsServices();
    }

    public function index() {
        // $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );
        // $rows = $repo->findById(1);

        $repo = new CategoryRepository();
        $rows = $repo->showAllCategories('DESC');

        $repoItem = new ItemRepository();
        $items = $repoItem->getItemFromCategories();

        include BASE_PATH . '/Views/Pages/Categories/ShowCategories.php';
    }

    public function insert() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryData = [
            'name'        => trim($_POST['name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'order'       => (int)($_POST['order'] ?? 0),
            'visible'     => (int)($_POST['visible'] ?? 1),
            'comments'    => (int)($_POST['comments'] ?? 1),
            'ads'         => (int)($_POST['ads'] ?? 1),
        ];

        $repo = new CategoryRepository();

        if ($repo->isExist($categoryData['name'])) {
            FlashMessage::init();
            FlashMessage::warning('This Category Already Exists');
            URL::redirect('categories/add');
        } else {
            $status = $repo->insert($categoryData);
            if ($status) {
                FlashMessage::init();
                FlashMessage::success("Category Added");
                URL::redirect('categories');
            } else {
                FlashMessage::init();
                FlashMessage::error('Error adding category');
                URL::redirect('categories/add');
            }
        }
    }

    include BASE_PATH . '/Views/Pages/Categories/AddCategory.php';
}


    public function edit($id) {

        $repo = new CategoryRepository();
        $rows = $repo->findById($id);

        include BASE_PATH . '/Views/Pages/Categories/EditCategory.php';

    }

    public function update($id) {

         $csrf = new CSRFToken();
        
        if(!$csrf->validateRequest($_SERVER, $_POST)) {
            http_response_code(419);
            FlashMessage::init();
            FlashMessage::error('Page Expired! - ERROR 419');
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
             $repo = new CategoryRepository();

                if($repo->isExist($_POST['name'], $id)) {
                    FlashMessage::init();
                    FlashMessage::warning('This Category Already Exists');
                } else {
                    $repo->update($_POST);
                }
        }
    }

        public function delete($id) {
            try {
                $repo = new CategoryRepository();

                if ($repo->delete($id)) {
                    FlashMessage::init();
                    FlashMessage::success('Category deleted successfully!');
                    URL::redirect('categories');
                } else {
                    FlashMessage::init();
                    FlashMessage::error('Failed to delete category.');
                    URL::redirect('categories');
                }
            } catch (Exception $e) {
                FlashMessage::init();
                FlashMessage::error('Error: ' . $e->getMessage());
                URL::redirect('categories');
            }
        }

}

?>