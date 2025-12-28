<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Core/Bootstrap/Bootstrap.php';
require_once __DIR__ . '/../Core/Router/Router.php';

use Controllers\AuthController;
use Controllers\CategoriesController;
use Controllers\CommentController;
use Controllers\DashboardController;
use Controllers\ItemController;
use Controllers\MembersController;
use Core\Helper\URL;
use Core\Router\Router;
use Middleware\VerifyCsrfToken;
use Services\SessionsServices;

$router = new Router();


$router->add('login', function() {
    $auth = new AuthController();
    $auth->login();
});
$router->add('/', function() {
    $auth = new AuthController();
    $auth->login();
});

$router->add('logout', function() {
    $session = new SessionsServices();
    $session->start();
    $session->destroy();
    URL::redirect('login');
});

/**
 * لوحة التحكم
 */
$router->add('dashboard', function() {
    new SessionsServices();
    $DSH = new DashboardController();
    $DSH->index();
});


$router->add('members', function() {
    $members = new MembersController();
    $members->index();
});

$router->add('members/{id}/edit', function($id) {
    $members = new MembersController();
    $members->edit((int)$id);
});
$router->add('members/{id}/delete', function($id) {
    $members = new MembersController();
    $members->delete((int)$id);
});

$router->add('categories/{id}/items', function($id) {
    $categories = new CategoriesController();
    $categories->showItems($id);
});

$router->add('comments/{id}/edit', function($id) {
    $comments = new CommentController();
    $comments->edit($id);
});

$router->add('comments/{id}/update', function($id) {
    $comments = new CommentController();
    $comments->update($id);
});

$router->add('comments', function() {
    $comments = new CommentController();
    $comments->index();
});

$router->add('comments/{id}/delete', function($id) {
    $comments = new CommentController();
    $comments->delete($id);
});

$router->add('members/pending', function() {
    $members = new MembersController();
    $members->getPendingUsers();
});
$router->add('members/{id}/accept', function($id) {
    $members = new MembersController();
    $members->acceptUser($id);
});
$router->add('members/{id}/activate', function($id) {
    $members = new MembersController();
    $members->acceptUser($id);
});
$router->add('members/update', function() {
    $members = new MembersController();
    $members->update();
});

$router->add('api/getUsersWithDates', function() {

   $api = new DashboardController();
   $api->getUsersWithDates();

});

$router->add('api/getCats', function() {

    $dashboard = new DashboardController();
    $dashboard->getCats();

});

$router->add('api/analiysRating', function() {

    $dashboard = new DashboardController();
    $dashboard->analiysRating();

});

$router->add('api/analiysApprovedItems', function() {

    $dashboard = new DashboardController();
    $dashboard->analiysApprovedItems();

});


$router->add('api/getCountryMade', function() {

    $dashboard = new DashboardController();
    $dashboard->getCountryMade();

});

$router->add('api/getTotalItemsInCats', function() {

    $dashboard = new DashboardController();
    $dashboard->getTotalItemsInCats();

});

$router->add('api/getInformationToDashboard', function() {

    $dashboard = new DashboardController();
    $dashboard->getInformationToDashboard();

});

$router->add('api/getNotifs', function() {

    $dashboard = new DashboardController();
    $dashboard->fetchNotifs();

});

$router->add('api/monthlyRegistrationCount', function() {

    $dashboard = new DashboardController();
    $dashboard->monthlyRegistrationCount();

});

$router->add('api/searchData', function() {

    $dashboard = new DashboardController();
    $dashboard->searchBox();

});

$router->add('members/insert', function() {
    $members = new MembersController();
    $members->insert();
});


$router->add('categories', function() {
    $categories = new CategoriesController();
    $categories->index();
});

$router->add('categories/{id}', function($id) {
    $categories = new CategoriesController();
    $categories->index();
});

$router->add('categories/add', function() {
    $categories = new CategoriesController();
    $categories->insert();
});

$router->add('categories/{id}/edit', function($id) {
    $categories = new CategoriesController();
    $categories->edit($id);
});

$router->add('categories/{id}/update', function($id) {
    $categories = new CategoriesController();
    $categories->update($id);
});

$router->add('categories/{id}/delete', function($id) {
    $categories = new CategoriesController();
    $categories->delete($id);
});

$router->add('items/insert', function() {
    $item = new ItemController();
    $item->insert();
});

$router->add('items/{id}/edit', function($id) {
    $item = new ItemController();
    $item->edit($id);
});

$router->add('items/{id}/update', function($id) {
    $item = new ItemController();
    $item->update($id);
});

$router->add('items/{id}/delete', function($id) {
    $item = new ItemController();
    $item->delete($id);
});

$router->add('items', function() {
    $item = new ItemController();
    $item->index();
});

$router->add('test', function() {
        include BASE_PATH . '/Views/Pages/test.php';
});


/**
 * صفحة الخطأ 404
 */
$router->add('404', function() {
    include BASE_PATH . '/Views/Pages/Main/404.php';
});



$middleware = new VerifyCsrfToken();

$middleware->handle(function () {
    // هنا يتابع الراوتر إلى الـ controllers
    // مثال بسيط:
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

    if ($uri === '/profile/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // تنفيذ الأكشن بعد مرور الميدلوير
        echo 'تم التحديث بنجاح';
        return;
    }

});







// تنفيذ التوجيه
$router->dispatch();
