<?php

use Views\Layouts\Navbar;
use Core\Database\DBConnection;
use Repositories\UserRepository;
use Core\Helper\URL;

/**
 * Escapes HTML for safe output
 */
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

?>
<main>
    <?php echo (new Navbar())->Render(); ?>
    <section class="dashboard-container">
        <div class="dashboard-stats">

            <div class="d-bar">
                <input type="text" id="searchBox" placeholder="Search Here...">
                <div class="sb-resultes"></div>
                <button id="notifications">
                    <i class="fas fa-solid fa-bell" id="btn-notifications"></i>
                </button>
            </div>

            <div class="d-hello">
                <h3>Dashboard Overview</h3>
                <p>Welcome back! Monitor your latest activities and analytics here.</p>
            </div>

            <div class="charts-row">
                <div class="chart-box">
                    <canvas id="charts"></canvas>
                </div>

                 <div class="chart-box">
                    <canvas id="analiysRating"></canvas>
                </div>

                <div class="chart-box">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>

            <div class="d-stats-info">
                <div class="d-pie">
                   <canvas id="d-pie"></canvas>
                </div>
                <div class="d-line">
                    <canvas id="d-line"></canvas>
                </div>
            </div>
        </div>

        <div class="dashboard-info">
            <h3>My Profile</h3>
            <div class="d-profile">
                <div class="d-profile-name">
                    <img src="" id="avatar" alt="User Avatar">
                    <div class="d-txt">
                        Full Name: <h4 id="fullname">Loading...</h4>
                        Username: <span id="username">Loading...</span>
                        <div class="d-addr" id="address">
                            <i class="fa fa-envelope"></i> 
                            Email: <span id="email">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="d-profile-box">
                    <div>
                        <span>Register Date</span>
                        <p id="dateReg">--/--/----</p>
                    </div>
                    <div>
                        <span>Total Items</span>
                        <p id="itemsCount">0</p>
                    </div>
                </div>
            </div>

            <div class="d-commends">
                <h3>Latest 10 Comments</h3>

                <?php 
                // Fix: Accessing properties using -> because FETCH_OBJ returns objects
                if (!empty($comments) && is_array($comments)) {
                    foreach ($comments as $comment) {
                        ?>
                        <div class="d-c-list">
                           <div class="d-c-img">
                                <img src="<?php echo e($comment->avatar ?? URL::ico('user')); ?>" alt="avatar">
                           </div>

                           <div class="d-c-comment">
                                <div class="d-c-c-head">
                                    <h3><?php echo e($comment->UserName ?? 'Unknown User'); ?></h3>
                                    <span class="d-c-date"><?php echo e($comment->CommentDate ?? $comment->Added_date ?? ''); ?></span>
                                </div>
                                <p class="d-c-cc">
                                    <?php echo e($comment->CommentText ?? $comment->comments ?? ''); ?>
                                </p>
                           </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p class="no-data">No comments available yet.</p>';
                }
                ?>
            </div>
        </div>
    </section>
</main>