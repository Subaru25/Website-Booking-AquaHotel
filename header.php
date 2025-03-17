  <!DOCTYPE html>
  <html>
  <head>
      <style>
          #username{
            margin-top: 20px;
            padding: 1px;
          }
      </style>
  </head>
  <body>
    <?php
        $flag=0;
        if(!isset($_SESSION['profile']))
            {
                $picname="pro.jpg";
            } 
        else{
                $picname=$_SESSION['profile'].'.jpg';
                $flag=1;
            }
    ?>
    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Search Form -->
        <div class="search-form d-flex align-items-center">
            <div class="container">
                <form action="index.php" method="get">
                    <input type="search" name="search-form-input" id="searchFormInput" placeholder="Type your keyword ...">
                    <button type="submit"><i class="icon_search"></i></button>
                </form>
            </div>
        </div>

        <!-- Top Header Area Start -->
        <div class="top-header-area">
            <div class="container">
                <div class="row">

                    <div class="col-6">
                        <div class="top-header-content">
                            <a href="#"><i class="icon_phone"></i> <span>(123) 456-789-1230</span></a>
                            <a href="#"><i class="icon_mail"></i> <span>info.colorlib@gmail.com</span></a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="top-header-content">
                            <!-- Top Social Area -->
                            <div class="top-social-area ml-auto">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://twitter.com/AVadukul"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/_anand_only_/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Top Header Area End -->

        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container" style=" max-width: 1220px; padding: 0;">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="robertoNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="index.php">
                        <img src="./img/core-img/LogoAqua.png" style="height: 80px; width: 150px;" alt="">
                        </a>


                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu" style="width: 1000px;">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li class="active"><a href="./index.php">Home</a></li>
                                    <li><a href="./room.php">Rooms</a></li>
                                    <li><a href="./about.php">About Us</a></li>
                                    <!-- <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="./index.php">- Home</a></li>
                                            <li><a href="./room.php">- Rooms</a></li>
                                            <li><a href="./single-room.php">- Single Rooms</a></li>
                                            <li><a href="./about.php">- About Us</a></li>
                                            <li><a href="./blog.php">- Blog</a></li>
                                            <li><a href="./single-blog.php">- Single Blog</a></li>
                                            <li><a href="./contact.php">- Contact</a></li>
                                            <li><a href="#">- Dropdown</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">- Dropdown Item</a></li>
                                                    <li><a href="#">- Dropdown Item</a></li>
                                                    <li><a href="#">- Dropdown Item</a></li>
                                                    <li><a href="#">- Dropdown Item</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="./blog.php">News</a></li> -->
                                    <li><a href="./contact.php">Contact</a></li>
                                    <?php if($flag==0){ echo "<li><a href='login.php'>Log in</a></li>";}?>
                                    
                                    
                                </ul>

                                <!-- Search -->
                                <div class="search-btn ml-4">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>

                                <!-- Book Now -->
                                <div class="book-now-btn ml-2 ml-lg-4">
                                    <a href="room.php">Book now <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                                <div class="book-now-btn ml-2 ml-lg-1 ">
                                    <a href="history.php">History <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                                
                         <!-- Profile Picture and Name -->
                         <div style="display: flex; align-items: center; margin-left: 10px;">
                                    <img src="./upload/<?php echo htmlspecialchars($picname); ?>" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
                                    <?php if (isset($_SESSION['uname'])): ?>
                                        <p id="username"><?php echo htmlspecialchars($_SESSION['uname']); ?></p>
                                        <a href="logout.php" id="logout"><img src="logout1.jpg" style="height: 40px; width: 40px;" alt="Logout"></a>
                                    <?php endif; ?>
                                    <?php echo isset($_SESSION['firstname'], $_SESSION['lastname'])
                                        ? htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname'])
                                        : ''; ?>
                                 
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->
  </body>
  </html>  