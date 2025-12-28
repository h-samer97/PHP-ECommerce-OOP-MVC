<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;

// دالة مساعدة مختصرة للترميز الآمن
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

echo (new Head('Add Member', 'addMember'))->Render();

FlashMessage::init();
FlashMessage::display();
include BASE_PATH . '/Views/Layouts/Sidebar.php';
?>
<div class="container">
    <h1>Members Manage</h1>
    <table>
      <thead>
        <tr>
          <th>#ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Full Name</th>
          <th>Date Register</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
       <?php foreach ($rows as $row): ?>
        <tr>
          <td><?php echo e($row['UserID']); ?></td>
          <td><?php echo e($row['Username']); ?></td>
          <td><?php echo e($row['Email']); ?></td>
          <td><?php echo e($row['FullName']); ?></td>
          <td><?php echo e($row['Date_Reg']); ?></td>
          <td>
            <a class='btn-blue' href="<?php echo BASE_URL . 'members/' . e($row['UserID']) . '/edit'; ?>" class="table-control">Edit</a>
            <?php if($row['RegStatus'] == 0){ ?>
              <a class='btn-green' href="<?php echo BASE_URL . 'members/' . e($row['UserID']) . '/accept'; ?>" class="table-control">Accept</a>
            <?php } ?>
            <a class='btn-red' href="<?php echo BASE_URL . 'members/' . e($row['UserID']) . '/delete'; ?>" class="table-control" onclick="return confirm(`Are You Want Delete This User?`)">Delete</a>
          </td>
        </tr>
       <?php endforeach; ?>
      </tbody>
    </table>
    <button class="add-member">+ إضافة عضو جديد</button>
</div>
<?php 
echo (new Footer('script', 'chart.umd.min'))->Render();
?>
