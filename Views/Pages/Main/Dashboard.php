<?php

use Views\Layouts\Navbar;
use Core\Database\DBConnection;
use Repositories\UserRepository;
use Core\Helper\URL;

// دالة مساعدة مختصرة للترميز الآمن
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

?>
<main>
    <?php echo (new Navbar())->Render(); ?>
    <section class="dashboard-container">
        <div class="dashboard-stats">

            <!-- Bar Dashboard -->
            <div class="d-bar">
                <input type="text" id="searchBox" placeholder="Search Here...">
                <div class="sb-resultes"></div>
                <button>
                    <i class="fas fa-solid fa-bell"></i>
                </button>
            </div>

            <div class="d-hello">
                <h3>Lorem ipsum dolor sit amet consectetur.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam.</p>
            </div>

            <!-- Charts -->
            <div class="charts-row">
                <div class="chart-box">
                    <h4>إحصائية تسجيل المستخدمين حسب السنة</h4>
                    <canvas id="charts"></canvas>
                </div>
                <div class="chart-box">
                    <h4>عدد العناصر حسب الفئة</h4>
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <div class="d-stats-info">
                <div class="d-pie">
                    <?php
                        $repo = new UserRepository((new DBConnection())->getConnection());
                        echo e($repo->sumCountAllUsers());
                    ?>
                </div>
                <div class="d-line">
                    charts
                </div>
            </div>
        </div>

        <div class="dashboard-info">
            <h3>My Profile</h3>
            <div class="d-profile">
                <div class="d-profile-name">
                    <img src="<?php echo e(URL::ico('editmembers')); ?>" alt="">
                    <div class="d-txt">
                        <h4><?php echo e($user->name ?? 'Guest'); ?></h4>
                        <span><?php echo e($user->bio ?? 'No bio available'); ?></span>
                        <div class="d-addr">
                            <i class="fa fa-map-marker"></i> 
                            <span><?php echo e($user->address ?? 'Unknown'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="d-profile-box">
                    <div>
                        <span>lorem</span>
                        <p><?php echo e($user->posts ?? 0); ?></p>
                    </div>
                    <div>
                        <span>lorem</span>
                        <p><?php echo e($user->comments ?? 0); ?></p>
                    </div>
                    <div>
                        <span>lorem</span>
                        <p><?php echo e($user->followers ?? 0); ?></p>
                    </div>
                </div>
            </div>

            <div class="d-commends">
                <h3>Last 10 Commends</h3>
                <div class="d-c-list">
                    <?php foreach($comments as $comment): ?>
                        <span><?php echo e($comment['text']); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</main>
