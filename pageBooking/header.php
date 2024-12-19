<?php
session_start();
?>
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">
        <img src="../Image/KrustyLogo.png" class="krusty-logo" />
    </a>

    <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                          <a class="nav-link" href="../pageReview/pagePreview.html">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="../pageRoom/pageRoom.html">Room</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Accommodation</a>
                        </li>
                      </ul>
                      <ul class="navbar-nav align-items-center">
                        <li style="float: right" class="nav-item">
                          <a class="nav-link" href="../pageBooking/bookingRoom.php">Book Room</a>
                        </li>
                      </ul>

        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../pageBooking/bookingRoom.php">Book Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../pageLogin/pageLogin.html">Login</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
