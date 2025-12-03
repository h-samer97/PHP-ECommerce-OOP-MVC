<main>
         <?php use Views\Layouts\Navbar; echo (new Navbar())->Render(); ?>
<section class="dashboard-container">
        <div class="dashboard-stats">

        <!-- Bar Dashboard -->
                <div class="d-bar">
                        <input type="text" id="searchBox" placeholder="Search Here...">
                        <div class="sb-resultes">
                        </div>
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

use Core\Database\DBConnection;
use Repositories\UserRepository;

                $repo = new UserRepository( ( new DBConnection() )->getConnection() );
                echo $repo->sumCountAllUsers();



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
                                <img src="<?php

                                        use Core\Helper\URL;

                                        echo URL::ico('editmembers') ?>" alt="">
                                <div class="d-txt">
                                        <h4>Samer</h4>
                                        <span>Lorem ipsum dolor sit.</span>
                                        <div class="d-addr">
                                                <i class="fa fa-map-marker"></i> 
                                                <span>Lorem, ipsum.</span>
                                        </div>
                                </div>
                        </div>
                        <div class="d-profile-box">
                                <div>
                                        <span>lorem</span>
                                        <p>43</p>
                                </div>
                                <div>
                                        <span>lorem</span>
                                        <p>56</p>
                                </div>
                                <div>
                                        <span>lorem</span>
                                        <p>432423</p>
                                </div>
                        </div>
                </div>

                <div class="d-commends">
                        <h3>Last 10 Commends</h3>
                        <div class="d-c-list">
                                <span>good</span>
                                <span>good</span>
                                <span>good</span>
                                <span>good</span>
                                <span>good</span>
                                <span>good</span>
                                <span>good</span>
                                <span>good</span>
                        </div>
                </div>

        </div>

</section>
</main>