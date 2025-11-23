<?php 

    namespace Services;

use Core\Database\DBConnection;
use Core\Helper\FlashMessage;
use Repositories\CategoryRepository;

    class CategoryService {
        private CategoryRepository $repo;


        public function __construct(CategoryRepository $repo)
        {
            $this->repo = $repo;
        }

        public function create(array $data) : bool {

            $error_log = [];
            

            if(empty($data['name'])) {

                $error_log[] = 'The Category Name is empty!';

            } elseif (empty($data['order'])) {

                $error_log[] = 'The Order Number is empty!';

            }

            if(!empty($error_log)) {
                FlashMessage::init();
                foreach($error_log as $error) {
                    FlashMessage::error($error . "<br><hr>");
                }
                return false;
            }

            $result = $this->repo->insert($data);
            return (bool) $result;

        }


    }







?>