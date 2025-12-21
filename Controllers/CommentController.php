<?php

namespace Controllers;

use Services\CommentServices;
use Core\Helper\FlashMessage;
use Views\Layouts\Head;
use Core\Helper\URL;
use PDOException;
use Repositories\CommentRepository;
use Soap\Url as SoapUrl;
use Views\Layouts\Footer;

class CommentController
{
    private CommentServices $commentService;
    private CommentRepository $repo;

    public function __construct()
    {
        $this->commentService = new CommentServices();
        $this->repo = new CommentRepository();
    }

    public function index()
    {
        $comments = $this->commentService->getLatestComments();

        echo (new Head('Comments', ''))->Render();

        include BASE_PATH . '/Views/Pages/Comments/Comments.php';

        echo (new Footer('script', ''))->Render();
    }

public function edit($id) {
    
    $repo = new \Repositories\CommentRepository();
    
    $comment = $repo->findById($id);

    if (!$comment) {
        FlashMessage::init();
        FlashMessage::error('Comment not found');
        URL::redirect('comments');
    }

    include BASE_PATH . '/Views/Pages/Comments/EditComment.php';
}

public function update($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $content = $_POST['comment'] ?? '';
        $status = (int)($_POST['status'] ?? 0);

        if (!is_numeric($id) || $id <= 0) {
            FlashMessage::init();
            FlashMessage::error('Invalid comment ID');
            URL::redirect('comments');
            return;
        }

        if (empty($content)) {
            FlashMessage::init();
            FlashMessage::error('Comment content cannot be empty');
            URL::redirect('comments/' . $id . '/edit');
            return;
        }
        
        $repo = new \Repositories\CommentRepository();
        try {

            if ($repo->updateComment($id, $content, $status)) {
            FlashMessage::init();
             FlashMessage::success('Comment Updated Successfully');
            } else {
                FlashMessage::init();
                FlashMessage::error('Failed to update comment');
            }
        } catch (PDOException $error) {
            FlashMessage::init();
            FlashMessage::info($error->getMessage());
            return;
        }
            URL::redirect('comments');
    }
}

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentText = $_POST['comment'] ?? '';
            $itemId = $_POST['item_id'] ?? null;
            $userId = $_POST['user_id'] ?? null;

            if (!empty($commentText) && $itemId && $userId) {

                FlashMessage::success('success', 'Comment added successfully!');
            } else {
                FlashMessage::error('error', 'Please fill all fields.');
            }

            header('Location: /comments');
            exit;
        }}

        public function delete($id) {

           if(is_numeric($id) && !empty($id) ) {
             $comment = $this->repo->findById($id);
                if(!empty($comment)) {
                    if($this->commentService->delete($id)) {
                        FlashMessage::init();
                        FlashMessage::success('The comment was successfully deleted');
                    } else {
                        FlashMessage::init();
                        FlashMessage::error('The comment did not deleted !');
                    }
                    URL::redirect('comments');
                }
           }

            

        }

    }
