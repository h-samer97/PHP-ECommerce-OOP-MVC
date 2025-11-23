<?php 

namespace Controllers;

use Core\Database\DBConnection;
use Core\Helper\FlashMessage;
use Core\Helper\URL;
use Model\Category;
use Repositories\CategoryRepository;
use Services\SessionsServices;

class CategoriesController {




    public function __construct()
    {
            new SessionsServices();
    }

    public function index($sort = 'ASC') {
        // $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );
        // $rows = $repo->findById(1);

        FlashMessage::init();
        FlashMessage::display();

        $repo = new CategoryRepository( ( new DBConnection() )->getConnection() );
        $rows = $repo->showAllCategories('DESC');

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

}














?>