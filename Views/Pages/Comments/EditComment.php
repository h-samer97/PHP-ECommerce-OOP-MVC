<?php
use Core\Helper\FlashMessage;
use Middleware\VerifyCsrfToken;
use Services\CSRFToken;
use Views\Layouts\Head;
use Views\Layouts\Footer;

echo (new Head('Edit Comment', 'comments'))->Render();
FlashMessage::init();
FlashMessage::display();
?>

<link rel="stylesheet" href="/css/comment-edit.css">

<div class="comments-container-wrapper">
    <div class="pro-card">
        <div class="pro-card-header">
            <h2><i class="fas fa-pen"></i> Edit Comment</h2>
            <?php if ($comment->status_com == 1): ?>
                <span class="pro-badge badge-active"><i class="fas fa-check-circle"></i> Published</span>
            <?php else: ?>
                <span class="pro-badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
            <?php endif; ?>
        </div>

        <div class="pro-card-body">
            <form method="POST" action="<?php echo BASE_URL . "comments/" .  $comment->c_id . "/update"; ?>">
                <div class="detail-item">
                    <label for="comments"><i class="fas fa-comment-dots"></i> Comment Content</label>
                    <textarea id="comments" name="comment" class="pro-form-control" rows="6"><?php echo htmlspecialchars($comment->comments); ?></textarea>
                    <?php echo (new CSRFToken())->generateFieldToken(); ?>
                </div>

                <div class="detail-item">
                    <label for="status_com"><i class="fas fa-toggle-on"></i> Status</label>
                    <select id="status_com" name="status" class="pro-form-control">
                        <option value="1" <?php if ($comment->status_com == 1) echo 'selected'; ?>>Published</option>
                        <option value="0" <?php if ($comment->status_com == 0) echo 'selected'; ?>>Pending</option>
                    </select>
                </div>

                <div class="pro-card-footer">
                    <button type="submit" class="pro-btn pro-btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    <a href="/comments" class="pro-btn pro-btn-secondary"><i class="fas fa-times-circle"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo (new Footer('script', ''))->Render(); ?>
