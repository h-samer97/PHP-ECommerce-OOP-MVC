<?php

    namespace Services;
    use Repositories\UserRepository;
    use Core\Database\DBConnection;
    use Core\Helper\Alert;

    class MemberService {

         private UserRepository $repo;

    public function __construct() {
        $this->repo = new UserRepository((new DBConnection())->getConnection());
    }

    public function getMemberById(int $id) {
        return $this->repo->findById($id);
    }


    public function updateMember(array $data): bool {

        $userid   = intval($data['userid']);

        $username = trim($data['username']);

        $email    = trim($data['email']);
        
        $fullname = trim($data['fullName']);

        $password = !empty($data['newPassword'])
            ? password_hash($data['newPassword'], PASSWORD_DEFAULT)
            : $data['oldPassword'];

            Alert::Print("تم التحديث بنجاح", 'success');

        return $this->repo->updateUser($userid, $username, $password, $email, $fullname);
    }


}


















?>