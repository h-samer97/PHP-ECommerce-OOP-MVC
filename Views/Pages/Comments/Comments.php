<?php
use Views\Layouts\Head;
use Views\Layouts\Footer;
use Core\Helper\FlashMessage;

echo (new Head('Comments Management', 'comments'))->Render();

FlashMessage::init();
FlashMessage::display();
include BASE_PATH . '/Views/Layouts/Sidebar.php';
?>

<div class="comments-container-wrapper">
    <?php foreach ($comments as $comment): ?>
        <div class="pro-card">
            <div class="pro-card-header">
                <h2><i class="fas fa-eye"></i> Comment Details</h2>
                <span class="pro-badge badge-active">ID #<?php echo $comment->CommentItemID; ?></span>
            </div>
            
            <div class="pro-card-body">
                <div class="info-grid">
                    <div class="detail-item">
                        <span class="label"><i class="fas fa-user"></i> Author</span>
                        <span class="value"><?php echo htmlspecialchars($comment->UserName); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label"><i class="fas fa-calendar"></i> Date</span>
                        <span class="value"><?php echo $comment->CommentDate; ?></span>
                    </div>
                </div>

                <div class="content-area">
                    <span class="label">Comment Content</span>
                    <div class="comment-display-box">
                        <?php echo nl2br(htmlspecialchars($comment->CommentText)); ?>
                    </div>
                </div>
            </div>

            <div class="pro-card-footer">
                <a href="/comments/<?php echo $comment->CommentID; ?>/edit" class="pro-btn pro-btn-primary">Edit</a>
                <a href="/comments/<?php echo $comment->CommentID; ?>/delete" onclick="return confirm('Are You Sure?')" class="pro-btn pro-btn-primary">Delete</a>
                <a href="/comments" class="pro-btn pro-btn-secondary">Back</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php echo (new Footer('script', ''))->Render(); ?>
