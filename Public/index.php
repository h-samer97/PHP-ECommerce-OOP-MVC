<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Core/Bootstrap/Bootstrap.php';
require_once __DIR__ . '/../Core/Router/Router.php';

use Controllers\AuthController;
use Controllers\CategoriesController;
use Controllers\DashboardController;
use Controllers\ItemController;
use Controllers\MembersController;
use Core\Helper\URL;
use Core\Router\Router;
use Services\SessionsServices;

// إنشاء الراوتر
$router = new Router();

/**
 * صفحة تسجيل الدخول
 */
$router->add('login', function() {
    $auth = new AuthController();
    $auth->login();
});
$router->add('/', function() {
    $auth = new AuthController();
    $auth->login();
});
/**
 * تسجيل الخروج
 */
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

/**
 * عرض قائمة الأعضاء
 */
$router->add('members', function() {
    $members = new MembersController();
    $members->index();
});

/**
 * تعديل عضو محدد عبر البارامتر {id}
 * مثال: /members/15/edit
 */
$router->add('members/{id}/edit', function($id) {
    $members = new MembersController();
    $members->edit((int)$id);
});
$router->add('members/{id}/delete', function($id) {
    $members = new MembersController();
    $members->delete((int)$id);
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

$router->add('api/getUsersWithDates', function() {

    $dashboard = new DashboardController();
    $dashboard->getUsersWithDates();

});

$router->add('api/getCats', function() {

    $dashboard = new DashboardController();
    $dashboard->getCats();

});

$router->add('api/getCountryMade', function() {

    $dashboard = new DashboardController();
    $dashboard->getCountryMade();

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

$router->add('items/{id}/delete', function($id) {
    $item = new ItemController();
    $item->delete($id);
});

$router->add('test', function() {
        include BASE_PATH . '/Views/Layouts/Sidebar.php';
});


/**
 * صفحة الخطأ 404
 */
$router->add('404', function() {
    include BASE_PATH . 'Views/Pages/404.php';
});

// تنفيذ التوجيه
$router->dispatch();
