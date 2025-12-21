<?php

use Views\Layouts\Navbar;
use Core\Database\DBConnection;
use Repositories\UserRepository;
use Core\Helper\URL;

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
                <button id="notifications">
                    <i class="fas fa-solid fa-bell" id="btn-notifications"></i>
                </button>
            </div>

            <div class="d-hello">
                <h3>Lorem ipsum dolor sit amet consectetur.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam.</p>
            </div>

            <!-- Charts -->
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
                   <canvas id="d-pie">
                   </canvas>
                </div>
                <div class="d-line">
                    <canvas id="d-line">
                   </canvas>
                </div>
            </div>
        </div>

        <div class="dashboard-info">
            <h3>My Profile</h3>
            <div class="d-profile">
                <div class="d-profile-name">
                    <img src="" id="avatar">
                    <div class="d-txt">
                        Full Name: <h4 id="fullname"></h4>
                        Username: <span id="username"></span>
                        <div class="d-addr" id="address">
                            <i class="fa fa-email"></i> 
                            Email: <span id="email"></span>
                        </div>
                    </div>
                </div>
                <div class="d-profile-box">
                    <div>
                        <span>Regestar Date</span>
                        <p id="dateReg"></p>
                    </div>
                    <div>
                        <span>Items Total</span>
                        <p id="itemsCount"></p>
                    </div>
                </div>
            </div>

            <div class="d-commends">
                <h3>Last 10 Commends</h3>

                <?php 
                if (!empty($comments) && is_array($comments)) {
                    foreach ($comments as $comment) {
                        ?>
                        <div class="d-c-list">

                           <div class="d-c-img">
                                <img src="<?php echo e($comment['avatar'] ?? URL::ico('user')); ?>" alt="">
                           </div>

                           <div class="d-c-comment">

                            <div class="d-c-c-head">
                                <h3><?php echo e($comment['Username'] ?? ''); ?></h3>
                                <span class="d-c-date"><?php echo e($comment['Added_date'] ?? ''); ?></span>
                            </div>

                            <p class="d-c-cc">
                                <?php echo e($comment['comments'] ?? ''); ?>
                            </p>

                           </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>No comments found.</p>';
                }
                ?>

            </div>
        </div>
    </section>
</main>