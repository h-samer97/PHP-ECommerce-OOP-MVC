<?php

    namespace Services;

use Repositories\CommentRepository;

    class CommentServices {

        private CommentRepository $comment;

        public function __construct()
        {
            $this->comment = new CommentRepository();
        }

        public function getLatestComments() {
            return $this->comment->getLatestComments(5);
        }

        public function delete($id) {
            return $this->comment->deleteComment($id);
        }

    }









?>