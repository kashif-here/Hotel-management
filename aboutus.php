<?php
require_once("./config.php");
include("./includes/header.php");
?>

<body class="aboutus">
    <header id="home">
        <?php include("./includes/navbar.php"); ?>
    </header>
    <div class="site-section bg-light">
        <div class="container ">
            <div class="row align-items-center">
                <div class="col-md-6 mb-5">
                        <img class="img-fluid" src="https://www.telegraph.co.uk/content/dam/Travel/hotels/2020/march/soneva-jani-water-retreat--bedroom-with-sea-view-pool-by-.jpg"
                            width="500" height="350" alt="Resort view">
                </div>
                <div class="col-md-6 mb-5">
                    <div>
                        <h2>About Us</h2>
                        <hr>
                    </div>
                    <p>
                        Offering top quality services that every customer deserves. We are an industry leader with our
                        brand renowned across all of the seven continents. We aim to focus on:
                    </p>
                    <ul>
                        <li>Core Values and Heritage</li>
                        <li>Diversity and Inclusion</li>
                        <li>Sustainability and Social Impact</li>
                    </ul>
                    <p>
                        Our main goal is to provide the best experience to every customer and make their stay memorable.
                        So become part of an ever growing family at Cloud Nine Hotel.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <section class="team-section">
        <div class="container">
            <div class="team-header">
                <h2>Meet Our Team</h2>
                <p>
                    Dedicated to building a smooth, reliable experience for guests and hotel staff with thoughtful
                    design and solid engineering.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="team-card-alt">
                        <div class="team-avatar">
                            <img src="<?php echo SROOT."/media/images/aboutus/kashif.png"; ?>" width="220" height="220" alt="MD KASHIF KHAN">
                        </div>
                        <div class="team-content">
                            <p class="team-role">Web Developer</p>
                            <h3>MD Kashif Khan</h3>
                            <p>
                                Built the core hotel management experience with a focus on usability, performance, and
                                clean interface design.
                            </p>
                            <div class="team-social-alt">
                                <a href="https://www.facebook.com/kashif3564" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="https://github.com/kashif-here" aria-label="GitHub" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-github"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/mdkashifkhan0/" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="team-card-alt">
                        <div class="team-avatar">
                            <img src="<?php echo SROOT."/media/images/aboutus/rup.jpg"; ?>" width="220" height="220" alt="RUP NARAYAN SHRESTHA">
                        </div>
                        <div class="team-content">
                            <p class="team-role">System Design Support</p>
                            <h3>Rup Narayan Shrestha</h3>
                            <p>
                                Shaped the system architecture and database flow to keep the platform structured,
                                efficient, and easy to maintain.
                            </p>
                            <div class="team-social-alt">
                                <a href="https://www.facebook.com/dipjal.shrestha.7" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="https://github.com" aria-label="GitHub" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-github"></i>
                                </a>
                                <a href="https://www.linkedin.com" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="site-section bg-light">
        <div class="container ">
            <div class="row">
                <div class="col-md-6 mx-auto text-center ">
                    <h2>Hotel Features</h2>
                    <hr>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/pastel-glyph/64/FF0000/swimming-pool.png" />
                    </div>
                    <h5 class="mt-2">Swimming Pool</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/ios/64/FF0000/beach.png" />
                    </div>
                    <h5 class="mt-2">Beach View</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/ios-filled/64/FF0000/emergency-exit.png" />
                    </div>
                    <h5 class="mt-2">Fire Exit</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/pastel-glyph/64/FF0000/parking--v1.png" />
                    </div>
                    <h5 class="mt-2">Car Parking</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/pastel-glyph/64/FF0000/hair-dryer--v1.png" />
                    </div>
                    <h5 class="mt-2">Hair Dryer</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/ios-filled/64/FF0000/mini-bar.png" />
                    </div>
                    <h5 class="mt-2">Mini Bar</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/ios/64/FF0000/cocktail.png" />
                    </div>
                    <h5 class="mt-2">Drinks</h5>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="imgt">
                        <img src="https://img.icons8.com/ios-filled/64/FF0000/car.png" />
                    </div>
                    <h5 class="mt-2">Car Airport</h5>
                </div>
            </div>
        </div>
    </div>
    <?php include("./includes/footer.php"); ?>
    <script>
        $(document).ready(function () {
            $("nav").eq(0).addClass("bg-dark");
            $("nav").eq(0).addClass("navbar-dark");
        });
    </script>
</body>

</html>