<?php

use Views\Layouts\Footer;
use Views\Layouts\Head;

 echo (new Head('Add Member', 'addMember'))->Render();

?>
<div class="container">
    <h1>لوحة إدارة الأعضاء</h1>
    <table>
      <thead>
        <tr>
          <th>#ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Full Name</th>
          <th>Date Regester</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
       <?php foreach ($rows as $row): ?>
        <tr>
          <td><?php echo $row['UserID']; ?></td>
          <td><?php echo $row['Username']; ?></td>
          <td><?php echo $row['Email']; ?></td>
          <td><?php echo $row['FullName']; ?></td>
          <td><?php echo $row['Date_Reg']; ?></td>
          <td>
            <a class='btn-blue' href="<?php echo BASE_URL . 'members/' . $row['UserID'] . '/edit'; ?>" class="table-control">Edit</a>
            <?php if($row['RegStatus'] == 0){ ?>
              <a class='btn-green' href="<?php echo BASE_URL . 'members/' . $row['UserID'] . '/accept'; ?>" class="table-control">Accept</a>
            <?php } ?>
            <a class='btn-red' href="<?php echo BASE_URL . 'members/' . $row['UserID'] . '/delete'; ?>" class="table-control">Delete</a>
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