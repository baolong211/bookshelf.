<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>bookshelf</title>

    <meta name="title" content="bookshelf" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Meta tag Facebook -->
    <meta property="og:url" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />

    <!-- Meta tag Twitter -->
    <meta name="twitter:card" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />

    <!-- CSS -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
</head>

<body>
    <!-- Header -->
    <?php
    include 'connect.php';
    session_start();
    ?>

    <header class="header">
        <div class="container">
            <div class="header__logo">
                <a href="./"><img srcset="./img/logo-bookshelf.png 1.5x" alt="bookshelf"></a>
            </div>

            <ul class="header__menu">
                <li><a href="#sccompany">About</a></li>
                <li><a href="#">Catalogue</a></li>
                <li><a href="#schowitwork">How It Work</a></li>
                <li><a href="#scagents">Agents</a></li>
                <li><a href="#scgetintouch">Contact Us</a></li>
            </ul>

            <div class="header__cta">
                <a href="./cart.php" class="iconcart"><img srcset="./img/icon-cart.png 20x" alt="bookshelf"></a>
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    // Hiển thị thông tin của người đăng nhập
                    echo "<span>Welcome, " . $_SESSION['email'] . "</span>";
                    echo '<a href="logout.php" class="header__cta-btn">Logout</a>'; // Thêm nút đăng xuất
                } else {
                    // Nếu chưa đăng nhập, hiển thị liên kết đăng nhập và đăng ký
                    echo '<a href="register.php" class="header__cta-btn --btn-transparent">Register</a>';
                    echo '<a href="login.php" class="header__cta-btn">Login</a>';
                }
                ?>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Main -->
    <main>
        <!-- Section Hero -->
        <section class="schero">
            <div class="container">
                <div class="schero__text">
                    <h1 class="heading">Find Your New <br> Book</h1>
                    <div class="schero__text-search">
                        <div class="inputsearch">
                            <form class="formsearch" action="allbooks.php" method="GET">
                                <i><img srcset="./img/icon-search.png 2x" alt="bookshelf"></i>
                                <input type="text" name="search" placeholder="Search books">
                                <button type="submit" class="btnsearch">Search</button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="schero__scroll">
                    <span>Scroll Down</span>
                    <i><img srcset="./img/icon-sroll-down.png 2x" alt="bookshelf"></i>
                </div>

                <div class="schero__contact">
                    <a href="tel:123456789" class="schero__contact-item">
                        <i><img srcset="./img/icon-phone.png 2x" alt="bookshelf"></i>
                        <span>(000) 123-4567</span>
                    </a>
                    <a href="https://maps.app.goo.gl/aTFJLve3xii3xuUn7" target="_blank" class="schero__contact-item">
                        <i><img srcset="./img/icon-pinmap.png 2x" alt="bookshelf"></i>
                        <span>Ho Chi Minh City, Vietnam</span>
                    </a>
                </div>
                <div class="time"></div>
            </div>

            <picture class="schero__img">
                <source media="(max-width:992px)" srcset="./img/hero-banner-bookshelf-tablet.jpg">
                <img src="./img/hero-banner-bookshelf.jpg" alt="bookshelf">
            </picture>
        </section>
        <!-- End Section Hero -->

        <!-- Section Company -->
        <section class="sccompany" id="sccompany">
            <div class="container">
                <div class="sccompany__content">
                    <div class="textbox">
                        <h2 class="heading">Our’s Company <br> Statistics</h2>
                    </div>
                    <div class="text">
                        <p>
                            Welcome to our online bookstore, a dynamic platform powered by a dedicated team of five
                            members. We pride ourselves on
                            our extensive collection of over 9,000 titles, catering to a wide range of genres and
                            interests. Our mission is to
                            connect readers with the books they love and to foster a global community of passionate book
                            lovers.
                        </p><br>
                        <p>
                            Our commitment to excellence has been recognized with two prestigious awards, a testament to
                            our relentless pursuit of
                            quality and customer satisfaction. We have also established partnerships with over 2,000
                            entities, further expanding our
                            reach and ensuring a diverse and comprehensive book selection for our customers. Join us in
                            our journey to celebrate
                            literature and the joy of reading.
                        </p>
                    </div>

                </div>

                <div class="sccompany__listbox">
                    <div class="company__info-item">
                        <div class="box">
                            <p class="number">9000+</p>
                            <p class="text">Books</p>
                        </div>
                        <div class="box">
                            <p class="number">2000</p>
                            <p class="text">Clients</p>
                        </div>
                        <div class="box">
                            <p class="number">05</p>
                            <p class="text">Employees</p>
                        </div>
                        <div class="box">
                            <p class="number">02</p>
                            <p class="text">Awards</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section Company -->

        <!-- Section Books -->
        <section class="scbooks">
            <div class="container">
                <div class="scbooks__content">
                    <div class="textbox">
                        <h2 class="heading">More Then 9000+ <br> Books</h2>
                    </div>
                </div>

                <div class="scbooks__listcard">
                    <?php
                    $sql = "SELECT * FROM sanpham LIMIT 12";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $ten_sach = $row["tensach"];
                            if (strlen($ten_sach) > 40) {
                                $ten_sach = substr($ten_sach, 0, 40);
                                $ten_sach = substr($ten_sach, 0, strrpos($ten_sach, ' '));
                                $ten_sach .= '...';
                            }

                            echo '<form action="addtocart.php" method="POST">';
                            echo '<div class="card">';
                            echo '<div class="card__img">';
                            echo '<a href="details.php?id=' . $row["idsanpham"] . '" class="book-thumb"><img src="' . $row["hinhanh"] . '" alt="bookshelf"></a>';
                            echo '</div>';
                            echo '<div class="card__des">';
                            echo '<h3 class="title">' . $ten_sach . '</h3>';
                            echo '<div class="info">';
                            echo '<div class="price">';
                            echo '<p class="text">' . number_format($row["gia"]) . ' đ</p>';
                            echo '</div>';
                            echo '<div class="addtocart">';
                            echo '<input type="submit" name="add" value="ADD">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<input type="hidden" name="id" value="' . $row["idsanpham"] . '">';
                            echo '<input type="hidden" name="tensach" value="' . $row["tensach"] . '">';
                            echo '<input type="hidden" name="gia" value="' . $row["gia"] . '">';
                            echo '</form>';
                        }
                    } else {
                        echo "Không có sản phẩm nào.";
                    }

                    // Đóng kết nối
                    $conn->close();
                    ?>
                </div>

                <div class="scbooks__btnwhite">
                    <a href="allbooks.php">View All Books</a>
                </div>
            </div>
        </section>
        <!-- End Section Books -->

        <!-- Section How It Work -->
        <section class="schowitwork" id="schowitwork">
            <div class="container">
                <div class="schowitwork__content">
                    <div class="textbox">
                        <h2 class="heading">How it work?</h2>
                        <p class="des">
                            Here is an introduction to our system’s operation with three main steps:<br>
                            Find Your Book: Our system boasts a diverse and extensive library of books. You can search
                            by book title, author, genre,
                            or keywords to find the book you want.<br>
                            Add to Cart: Once you’ve found your desired book, you can add it to your shopping cart with
                            just a click. You can
                            continue to browse and add as many books as you want to your cart.<br>
                            Payment: When you’re ready to purchase, go to your cart and proceed to checkout. Our secure
                            payment system accepts
                            various payment methods for your convenience.<br>
                            Enjoy your reading journey with us!
                        </p>
                    </div>
                </div>

                <div class="schowitwork__listbox">
                    <div class="item">
                        <div class="item__number">01</div>
                        <h3 class="item__title"><span>01</span> Find Your Books</h3>
                        <div class="item__info">
                            <p class="item__info-text">
                                You can search by book
                                title, author, genre, or keywords to
                                find the book you want.
                            </p>
                            <p><a href="#">Find Books</a></p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="item__number">02</div>
                        <h3 class="item__title"><span>02</span> Add To Cart</h3>
                        <div class="item__info">
                            <p class="item__info-text">
                                Once you’ve found your desired book, you can add it to your shopping cart with just a
                                click.
                            </p>
                            <a href="#">Add to cart </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="item__number">03</div>
                        <h3 class="item__title"><span>03</span> Payment</h3>
                        <div class="item__info">
                            <p class="item__info-text">
                                After successful payment, you’ll receive a confirmation and your book will be on its way
                                to you.

                            </p>
                            <a href="#">Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section How It Work -->

        <!-- Section Agents -->
        <section class="scagents" id="scagents">
            <div class="container">
                <div class="scagents__content">
                    <div class="textbox">
                        <h2 class="heading">Meet Our Agents</h2>
                        <p class="des">
                            Welcome to our ‘Meet Our Agent’ section. This is where you can learn more about our
                            dedicated and professional team of
                            agents. Each of our agents possesses extensive knowledge and years of experience in this
                            field, ready to assist you
                            anytime, anywhere. Join us in exploring and learning more about the individuals who will
                            help you achieve your goals.
                        </p>
                    </div>
                </div>

                <div class="scagents__listcard">
                    <div class="card">
                        <div class="card__img">
                            <a href="#"><img src="./img/Agent01.jpg" alt="bookshelf"></a>
                        </div>

                        <div class="card__des">
                            <h6 class="title">Agent 01</h6>
                            <div class="info">
                                <div class="name">
                                    <p class="text">Mr. Dang Quang Phuc</p>
                                </div>

                                <div class="social">
                                    <a href="#"><img srcset="./img/icon-facebook.png 2x" alt="bookshelf"></a>
                                    <a href="#"><img srcset="./img/icon-twitter.png 2x" alt="bookshelf"></a>
                                    <a href="#"><img srcset="./img/icon-dribb.png 2x" alt="bookshelf"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__img">
                            <a href="#"><img src="./img/Agent02.jpg" alt="bookshelf"></a>
                        </div>

                        <div class="card__des">
                            <h6 class="title">Agent 02</h6>
                            <div class="info">
                                <div class="name">
                                    <p class="text">Mr. Le Trung Hieu</p>
                                </div>

                                <div class="social">
                                    <a href="#"><img srcset="./img/icon-facebook.png 2x" alt="bookshelf"></a>
                                    <a href="#"><img srcset="./img/icon-twitter.png 2x" alt="bookshelf"></a>
                                    <a href="#"><img srcset="./img/icon-dribb.png 2x" alt="bookshelf"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__img">
                            <a href="#"><img src="./img/Agent03.jpg" alt="bookshelf"></a>
                        </div>

                        <div class="card__des">
                            <h6 class="title">Agent 03</h6>
                            <div class="info">
                                <div class="name">
                                    <p class="text">Ms. Minh Thuong</p>
                                </div>

                                <div class="social">
                                    <a href="#"><img srcset="./img/icon-facebook.png 2x" alt="bookshelf"></a>
                                    <a href="#"><img srcset="./img/icon-twitter.png 2x" alt="bookshelf"></a>
                                    <a href="#"><img srcset="./img/icon-dribb.png 2x" alt="bookshelf"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section Agents -->

        <!-- Section Location -->
        <section class="sclocation">
            <div class="container">
                <div class="sclocation__content">
                    <div class="info">
                        <div class="info__img">
                            <img src="./img/SAA_1.jpg" alt="bookshelf">
                            <div class="address">
                                <a href="https://maps.app.goo.gl/aTFJLve3xii3xuUn7" class="icon"><img srcset="./img/icon-pinmap.png 2x" alt="bookshelf"></a>
                                <a href="https://maps.app.goo.gl/aTFJLve3xii3xuUn7" class="detailaddress"><span>Ho Chi
                                        Minh City, Vietnam</span></a>
                            </div>
                        </div>

                        <div class="info__des">
                            <h4 class="info__des-title">bookshelf.</h4>
                            <p class="info__des-text">
                                This is where you can find detailed information about our various locations. Each
                                location is unique and offers
                                different amenities and features. Whether you’re looking for a bustling city center or a
                                peaceful countryside, we have a
                                location that will suit your needs. Explore our locations to find the perfect fit for
                                you.
                            </p>
                        </div>
                    </div>

                    <div class="info">
                        <div class="info__des">
                            <h4 class="info__des-title">bookshelf.</h4>
                            <p class="info__des-text">
                                This is where you can find detailed information about our various locations. Each
                                location is unique and offers
                                different amenities and features. Whether you’re looking for a bustling city center or a
                                peaceful countryside, we have a
                                location that will suit your needs. Explore our locations to find the perfect fit for
                                you.
                            </p>
                        </div>

                        <div class="info__img">
                            <img src="./img/SAA_2.jpg" alt="bookshelf">
                            <div class="address">
                                <a href="https://maps.app.goo.gl/aTFJLve3xii3xuUn7" class="icon"><img srcset="./img/icon-pinmap.png 2x" alt="bookshelf"></a>
                                <a href="https://maps.app.goo.gl/aTFJLve3xii3xuUn7" class="detailaddress"><span>Ho Chi
                                        Minh City, Vietnam</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="info">
                        <div class="info__img">
                            <img src="./img/SAA_3.jpg" alt="bookshelf">
                        </div>

                        <div class="info__des">
                            <h4 class="info__des-title">bookshelf.</h4>
                            <p class="info__des-text">
                                This is where you can find detailed information about our various locations. Each
                                location is unique and offers
                                different amenities and features. Whether you’re looking for a bustling city center or a
                                peaceful countryside, we have a
                                location that will suit your needs. Explore our locations to find the perfect fit for
                                you.
                            </p>

                            <div class="info__des-btn">
                                <a href="https://www.forbes.com/sites/laurabegleybloom/2023/06/21/ranked-20-best-cities-to-live-in-the-world-according-to-a-new-report/?sh=7997ca26225b">Show
                                    Me More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section Location -->

        <!-- Section Get In Touch -->
        <section class="scgetintouch" id="scgetintouch">
            <div class="left">
                <div class="scgetintouch__content">
                    <div class="textbox">
                        <h2 class="heading">Get In Touch</h2>
                        <p class="des">
                            We would love to hear from you! Whether you have a question, a suggestion, a feedback, or a
                            request, please feel free to
                            contact us using the form below. You can also reach us through our social media channels,
                            email, or phone number. We
                            will get back to you as soon as possible.
                        </p>
                    </div>
                </div>

                <div class="scgetintouch__form">
                    <form class="contactform" action="#" method="POST">
                        <div class="contactform__input">
                            <input type="text" id="fullname" name="fullname" placeholder="Name" value="">
                        </div>

                        <div class="contactform__input">
                            <input type="email" id="email" name="email" placeholder="Email" value="">
                        </div>

                        <div class="contactform__input formselect">
                            <select name="areacode" id="areacode">
                                <option value="+84">VN</option>
                                <option value="+49">DE</option>
                                <option value="+7">RU</option>
                            </select>
                            <input type="number" id="pnumber" name="pnumber" placeholder="(+84) 123 456 789" value="">
                        </div>

                        <div class="contactform__input">
                            <textarea id="content" name="content" rows="5" cols="50" placeholder="Tell us something...."></textarea>
                        </div>

                        <div class="contactform__input">
                            <h5 class="titleinput">Select the services:</h5>
                            <div class="contactform__input-item --services">
                                <p class="item">
                                    <input type="radio" id="selectservice1" name="selectservice" value="Renting">
                                    <label for="selectservice1">Renting</label>
                                </p>

                                <p class="item">
                                    <input type="radio" id="selectservice2" name="selectservice" value="Selling">
                                    <label for="selectservice2">Selling</label>
                                </p>
                            </div>
                        </div>

                        <div class="contactform__input">
                            <h5 class="titleinput">Which channel you want to connect?</h5>
                            <div class="contactform__input-item --channels">
                                <p class="item">
                                    <input type="checkbox" id="channel1" name="channel1" value="Facebook" checked>
                                    <label for="channel1">Facebook</label>
                                </p>

                                <p class="item">
                                    <input type="checkbox" id="channel2" name="channel2" value="Email">
                                    <label for="channel2">Email</label>
                                </p>

                                <p class="item">
                                    <input type="checkbox" id="channel3" name="channel3" value="Phone">
                                    <label for="channel3">Phone</label>
                                </p>
                            </div>
                        </div>

                        <a href="#"><button type="submit">Send Us</button></a>
                    </form>
                </div>
            </div>

            <div class="img">
                <img src="./img/Touch.jpg" alt="bookshelf">
            </div>
        </section>
        <!-- End Section Get In Touch -->
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="heading">
                    <h2>bookshelf. <br> Explore Real Books</h2>
                </div>

                <form action="#" class="footer__top-search">
                    <input type="text" id="subcribe" name="subcribe" value="" placeholder="Subscribe To Our Newsletter">
                    <button type="submit" class="btnsubmit"><img srcset="./img/icon-send.png 2x" alt="bookshelf"></button>
                </form>
            </div>

            <div class="footer__bottom">
                <div class="footer__bottom-left">
                    <div class="logo">
                        <a href="./"><img srcset="./img/logo-bookshelf-footer.png 1.5x" alt="bookshelf"></a>
                    </div>

                    <div class="copyright">
                        <p>© 2024 - bookshelf., <br> All Right Reserved</p>
                    </div>
                </div>

                <div class="footer__bottom-right">
                    <div class="menu">
                        <div class="item">
                            <h5 class="title">BOOKSHELF</h5>
                            <ul>
                                <li><a href="#">Agents</a></li>
                                <li><a href="#">Hunters</a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <h5 class="title">COMPANY</h5>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Social</a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <h5 class="title">PRODUCT</h5>
                            <ul>
                                <li><a href="#">Books</a></li>
                                <li><a href="#">How It Works</a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <h5 class="title">SERVICE</h5>
                            <ul>
                                <li><a href="#">Renting</a></li>
                                <li><a href="#">Selling</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="./js/main.js"></script>
</body>

</html>