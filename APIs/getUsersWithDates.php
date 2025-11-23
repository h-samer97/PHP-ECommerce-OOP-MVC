<?php 

    namespace APIs;
    use Repositories\UserRepository;
    use Core\Database\DBConnection;




    $repo = new UserRepository( ( new DBConnection() )->getConnection() );
        $records = $repo->getUsersAndDates();
        // header('Content-Type: application/json; charset=utf-8');
        echo json_encode($records, JSON_UNESCAPED_UNICODE);

?>