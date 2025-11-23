<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Core/Bootstrap/Bootstrap.php';
require_once __DIR__ . '/../Core/Router/Router.php';

use Controllers\AuthController;
use Controllers\CategoriesController;
use Controllers\DashboardController;
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

$router->add('members/insert', function() {
    $members = new MembersController();
    $members->insert();
});


$router->add('categories', function($id) {
    $categories = new CategoriesController();
    $categories->index();
});

$router->add('categories/add', function() {
    $categories = new CategoriesController();
    $categories->insert();
});



/**
 * صفحة الخطأ 404
 */
$router->add('404', function() {
    include BASE_PATH . 'Views/Pages/404.php';
});

// تنفيذ التوجيه
$router->dispatch();
