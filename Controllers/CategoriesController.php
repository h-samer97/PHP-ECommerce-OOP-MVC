<?php 

namespace Controllers;

use Core\Database\DBConnection;
use Core\Helper\FlashMessage;
use Core\Helper\URL;
use Model\Category;
use Repositories\CategoryRepository;
use Repositories\ItemRepository;
use Services\SessionsServices;
use Exception;

class CategoriesController {




    public function __construct()
    {
            new SessionsServices();
    }

    public function index() {
        // $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );
        // $rows = $repo->findById(1);

        FlashMessage::init();
        FlashMessage::display();

        $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );
        $rows = $repo->showAllCategories('DESC');

        $repoItem = new ItemRepository();
        $items = $repoItem->getItemFromCategories();

        include BASE_PATH . '/Views/Pages/Categories/ShowCategories.php';
    }

    public function insert() {
        
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $categoryData = [
                'name'        => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'order'       => (int)($_POST['order'] ?? 0),
                'visible'     => (int)($_POST['visible'] ?? 1),
                'comments'    => (int)($_POST['comments'] ?? 1),
                'ads'         => (int)($_POST['ads'] ?? 1),
            ];
            
            $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );
            if($repo->isExist($categoryData['name'])) {
                    FlashMessage::init();
                    FlashMessage::warning('This Category Already Exists');
                    FlashMessage::display();
                    echo 'Samer 404';
            } else {
                $status = $repo->insert($categoryData);

                if($status) {
                    FlashMessage::init();
                    FlashMessage::success("Category Added");
                    URL::redirect('categories');
                } else {
                    FlashMessage::init();
                    FlashMessage::warning('Error');
                    // URL::redirect($_SERVER['PHP_SELF']);
                }

            }
            
        }
        include BASE_PATH . '/Views/Pages/Categories/AddCategory.php';
    }

    public function edit($id) {

        $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );
        $rows = $repo->findById($id);

        include BASE_PATH . '/Views/Pages/Categories/EditCategory.php';



    }

    public function update($id) {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
             $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );

                if($repo->isExist($_POST['name'])) {
                    FlashMessage::init();
                    FlashMessage::warning('This Category Already Exists');
                    FlashMessage::display();
                    echo 'Samer 404';
                } else {

                    $repo->update($_POST);
                    echo true;
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