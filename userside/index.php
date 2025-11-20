<!-- head -->
<?php include 'userparts/link.php'?>

<!--header-->
<?php include 'userparts/header.php'?>


<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container" >
        <div class="row" style="display: flex;align-items: center;flex-wrap: wrap;">

            <div class="col-md-6 col-sm-12">
                <div class="home-info">
                    <h1>Reliable Vehicle Services for All Your Automotive Needs</h1>
                    
                 

  <?php if (!isset($_SESSION["user"])): ?>
                    <li><a href="#" class="openLoginModal smoothScroll btn section-btn">Book Service</a></li>
                <?php else: ?>
                    <li><a href="bookservice.php" class="btn section-btn smoothScroll">Book Service</a></li>
                <?php endif; ?>


                   
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="home-video">
                    
                        <img style="width:100%;" src="images/Car accesories-bro.png" alt="car">
                  
                </div>
            </div>

        </div>
    </div>
</section>





<!-- ABOUT -->
<section id="about" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-5 col-sm-6">
                <div class="about-info">
                    <div class="section-title">
                        <h2>About Our Workshop</h2>
                        <span class="line-bar">...</span>
                    </div>
                    <p>We provide professional vehicle maintenance and repair services, ensuring your car runs safely and efficiently.</p>
                    <p>From routine servicing to major repairs, our certified mechanics handle every job with precision.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="about-info skill-thumb">

                    <strong>Engine Repair</strong>
                    <span class="pull-right">90%</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 90%;"></div>
                    </div>

                    <strong>Body Work</strong>
                    <span class="pull-right">85%</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 85%;"></div>
                    </div>

                    <strong>Electrical Systems</strong>
                    <span class="pull-right">80%</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 80%;"></div>
                    </div>

                    <strong>Customer Service</strong>
                    <span class="pull-right">95%</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 95%;"></div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="about-image">
                    <img src="images/Hybrid car-bro.png" class="img-responsive" alt="Workshop">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- WORK -->
<section id="service" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Our Services</h2>
                    <span class="line-bar">...</span>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="work-thumb">
                    <a href="images/muscular-car-service-worker-repairing-vehicle.jpg" class="image-popup">
                        <img src="images/muscular-car-service-worker-repairing-vehicle.jpg" class="img-responsive" alt="Engine Repair">
                        <div class="work-info">
                            <h3>Engine Repair</h3>
                            <small>Mechanical</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="work-thumb">
                    <a href="images/closeup-auto-repairman-checking-car-oil-workshop.jpg" class="image-popup">
                        <img src="images/closeup-auto-repairman-checking-car-oil-workshop.jpg" class="img-responsive" alt="Oil Change">
                        <div class="work-info">
                            <h3>Oil & Filter Change</h3>
                            <small>Maintenance</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="work-thumb">
                    <a href="images/car-repairman-wearing-white-uniform-standing-holding-wrench-that-is-essential-tool-mechanic.jpg" class="image-popup">
                        <img src="images/car-repairman-wearing-white-uniform-standing-holding-wrench-that-is-essential-tool-mechanic.jpg" class="img-responsive" alt="Electrical">
                        <div class="work-info">
                            <h3>Electrical Systems</h3>
                            <small>Repair</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="work-thumb">
                    <a href="images/side-view-man-spraying-powder-paint-car-door.jpg" class="image-popup">
                        <img src="images/side-view-man-spraying-powder-paint-car-door.jpg" class="img-responsive" alt="Body Work">
                        <div class="work-info">
                            <h3>Body & Paint Work</h3>
                            <small>Repair</small>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<!--footer-->
<?php include 'userparts/footer.php'?>
