<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krusty Tower</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="pagePriviewCSS.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet" />
</head>
<body>
    <script src="script.js"></script>
    <div>
        <nav class="header">
            <!--Header-->
            <div class="header-top-1">
                <div style="display: inline-flex; align-items: center">
                    <span class="material-symbols-outlined">call</span>
                    <span style="font-family: 'SpongeBob', sans-serif; font-weight: bold">334-441-8088</span>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg">
                <!-- logo-->
                <a class="navbar-brand" href="#">
                    <img src="../Image/KrustyLogo.png" class="krusty-logo" />
                </a>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                          <a class="nav-link" href="../pageReview/pagePreview.html">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="../pageRoom/pageRoom.html">Room</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="../pageAccomendations/pageAcco.html">Accommodation</a>
                        </li>
                      </ul>
                      <ul class="navbar-nav align-items-center">
                        <li style="float: right" class="nav-item">
                            <a href="../pageLogin/pageLogin.php?redirect=../pageBooking/bookingRoom.php" class="nav-link">Book Room</a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li>
                                <span class="nav-link">Hello, <?= htmlspecialchars($_SESSION['username']); ?>!</span>
                            </li>
                            <li>
                                <a href="../pageLogin/logout.php" class="nav-link">Logout</a>
                            </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../pageLogin/pageLogin.php" >Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pageRegister/pageRegister.html">Register</a>
                        </li>
                        <?php endif; ?>
                      </ul>
                    </div>
                </div>
            </nav>
        </nav>

        <!--Content-->
        <div class="main-content">
            <div class="content">
                <div class="container-1">
                    <div class="container-1-slider">
                        <div class="container-1-slides">
                            <img src="../Image/Krusty_Towers.webp" alt="Home1" class="container-1-slide" />
                            <img src="../Image/Krusty_Towers_2.webp" alt="Home2" class="container-1-slide" />
                            <img src="../Image/Krusty_Towers_Slogan.webp" alt="Home3" class="container-1-slide" />
                            <img src="../Image/Krusty_Towers_Owner.webp" alt="Home4" class="container-1-slide" />
                        </div>
                        <span id="container-1-left-arrow" class="arrow dot">
                            <span class="material-symbols-outlined"> arrow_back_ios </span>
                        </span>
                        <span id="container-1-right-arrow" class="arrow dot">
                            <span class="material-symbols-outlined"> arrow_forward_ios </span>
                        </span>
                    </div>
                    <div id="home-section" class="container-1-content">
                        <div style="text-align: center" class="container-1-content-title">Krusty Pledge</div>
                        <hr class="line-break" width="640px" />
                        <div style="max-width: 640px" align-items="center" class="container-1-content-description open-sans">
                            We shall never deny a guest even the most ridiculous request!
                            Experience the beauty and majesty Bikini Bottom has to offer
                            with our exquisite service. Nestled in the heart of Bikini
                            Bottom, Krusty Tower stands as the pinnacle of undersea luxury
                            and comfort. Our unique hotel offers an unparalleled blend of
                            opulence and whimsy, perfect for families, couples, and solo
                            adventurers alike.
                        </div>
                    </div>
                </div>
                <div class="container-2">
                    <div id="room-section" class="container-2">
                        <div class="container-1-content-title">Rooms & Suites</div>
                        <hr class="line-break" width="640px" />
                        <div class="room-slider">
                            <button id="prevRoom" class="btn btn-secondary">Prev</button>
                            <div id="roomDisplay">
                                <!-- Room details will be displayed here -->
                            </div>
                            <button id="nextRoom" class="btn btn-secondary">Next</button>
                        </div>
                    </div>
                </div>
                <div id="tourist-spot-section" class="container-3">
                    <div class="container-3-slider">
                        <div class="container-3-slides">
                            <img src="../Image/GooLagoon.jpeg" alt="Tour 1" class="container-3-slide" />
                            <img src="../Image/Mt.Bikini.webp" alt="Tour 2" class="container-3-slide" />
                            <img src="../Image/JellyfishFields.webp" alt="Tour 3" class="container-3-slide" />
                        </div>
                        <span id="container-3-left-arrow" class="arrow dot">
                            <span class="material-symbols-outlined"> arrow_back_ios </span>
                        </span>
                        <span id="container-3-right-arrow" class="arrow dot">
                            <span class="material-symbols-outlined"> arrow_forward_ios </span>
                        </span>
                    </div>
                    <div class="container-3-content">
                        <div class="container-2-title">Tourist Spot</div>
                        <hr class="line-break" width="640px" style="margin:0 auto;" />
                        <br />
                        <div id="tourist-spot-name" style="font-size: 2em">Goo Lagoon</div>
                        <br />
                        <div id="tourist-spot-description">
                            This sunny lagoon is the perfect spot for a day of fun and
                            relaxation. Visitors can enjoy a variety of water sports,
                            sunbathing on the sandy shores, or simply taking a refreshing dip
                            in the clear, gooey waters. With plenty of food stands and shops
                            nearby, it's easy to make a full day out of your visit to Goo
                            Lagoon. Whether you're looking to catch some waves or just unwind
                            under the sun, Goo Lagoon has something for everyone!
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p>
                    &copy; Krusty Tower. All rights reserved to Mr.Krabs and Nickelodeon.
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript to Load Room Data -->
    <script src="script.js"></script>
</body>
</html>
