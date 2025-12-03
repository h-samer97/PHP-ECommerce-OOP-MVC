<?php 

    namespace APIs;
    use Repositories\UserRepository;
    use Core\Database\DBConnection;
    use Repositories\ItemRepository;

    $repo = new ItemRepository( ( new DBConnection() )->getConnection() );
        $records = $repo->getItemWithCatsAnalisys();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($records, JSON_UNESCAPED_UNICODE);

?>