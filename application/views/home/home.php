<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>ບໍລິສັດ ພັນເພັດ ພັດທະນາກະສິກຳ ຈຳກັດ</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <!-- Favicons -->

    <link href="../../public/img/logo.jpg" rel="icon" />
    <link href="../../public/img/logo.jpg" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="../../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../../public/assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="../../public/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="../../public/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

    <!-- Template Main CSS File -->
    <link href="../../public/assets/css/main.css" rel="stylesheet" />
    <style>
    .containerHigt {
        height: 150px;
    }

    .containerHigt.overflow-h {
        height: 150px;

        overflow: hidden;

    }

    .imagefull {
        width: 100%;
        object-fit: cover;

    }

    .menu .tab-content .menu-item .menu-img {
        padding: 0px;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="<?=base_url()?>" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="../../public/img/logo.jpg" alt="">
                <h1 id="title"></h1>
            </a>

            <nav id="navbar" class="navbar">
            <ul>
                    <li><a href="#hero" id="menu-home"></a></li>
                    <li><a href="<?=base_url('api/product')?>#product" id="product"></a></li>
                    <li><a href="#menu" id="menu-business"></a></li>
                    <li><a href="#events" id="menu-investment"></a></li>
                    <li><a href="#news" id="menu-news"></a></li>
                    <li><a href="#gallery" id="menu-gallery"></a></li>
                    <li class="dropdown">
                        <a href="#"><span id="menu-about"></span>
                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                        </a>
                        <ul>
                            <!-- <li><a href="#">Chairman's comments</a></li> -->
                            <li><a href="#vision">Vision and Mission</a></li>
                            <li><a href="#Board">Board of Directors</a></li>
                        </ul>
                    </li>
                    <li><a href="#contact" id="menu-contact"></a></li>
                    <!-- <li> <a href="<?=base_url("loginuser")?>" class="btn btn-book-a-table " style="width: 80px;" >Login </a>
                    </li> -->

 <li><button class="btn btn-book-a-table" onclick="switcherLanguage(this)" id="language-switcher" style="width: 80px;">EN</button></li>
                </ul>
            </nav>
            <!-- .navbar -->
            <!-- <a href="<?=base_url("loginuser")?>" class="btn btn-book-a-table ">Login </a>


            <button class="btn btn-book-a-table" id="language-switcher">EN</button> -->

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header>
 
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <!-- ======= Testimonials Section ======= -->
    <section id="hero" class="hero d-flex align-items-center section-bg">


        <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper" id="imageSlid">
                <?php foreach($banner as $r): ?>

                <div class="swiper-slide"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?=base_url().$r->image?>) center ; object-fit: cover;">
                    <div class="container">
                        <div class="row justify-content-between gy-5">
                            <div
                                class="col-lg-12 order-2 justify-content-center align-items-center align-items-lg-center text-center text-lg-center">
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <div style="opacity: 2;" class="lang-la d-none">
                                    <h2 data-aos="fade-up" style="    color: #fff;"><?=$r->title_lao?></h2>
                                    <p data-aos="fade-up col-lg-6" data-aos-delay="100" style="padding-left: 15%;
                    padding-right: 15%; color: #fff;">
                                        <?=$r->detail_lao?>
                                    </p>
                                    <div class="d-flex justify-content-center align-items-center align-items-lg-center text-center text-lg-center"
                                        data-aos="fade-up" data-aos-delay="200">
                                        <!-- <a href="#" class="btn-book-a-table">More</a> -->

                                    </div>
                                </div>
                                <div style="opacity: 2;" class="lang-en">
                                    <h2 data-aos="fade-up" style="    color: #fff;"><?=$r->title_eng?></h2>
                                    <p data-aos="fade-up col-lg-6" data-aos-delay="100" style="padding-left: 15%;
                    padding-right: 15%; color: #fff;">
                                        <?=$r->detail_eng?>
                                    </p>
                                    <div class="d-flex justify-content-center align-items-center align-items-lg-center text-center text-lg-center"
                                        data-aos="fade-up" data-aos-delay="200">
                                        <!-- <a href="#" class="btn-book-a-table">More</a> -->

                                    </div>
                                </div>
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>


            </div>
            <div class="swiper-pagination"></div>
        </div>

    </section>
    <!-- End Hero Section -->

    <main id="main">

        <section id="menu" class="menu">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h1 id="ourbusiness"></h1>
                </div>


                <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                    <div class="tab-pane fade active show" id="menu-starters">


                        <div class="row gy-5">
                            <?php foreach($business as $r): ?>
                            <div class="col-lg-4 menu-item lang-la d-none">
                                <a href="<?=base_url().$r->image?>" class="glightbox imagefull"><img
                                        src="<?=base_url().$r->image?>" class="menu-img img-fluid imagefull"
                                        alt="" /></a>
                                <h4><?=$r->title_lao?></h4>
                                <p class="ingredients containerHigt overflow-h">
                                    <?=$r->detail_lao?>
                                </p>

                            </div>
                            <div class="col-lg-4 menu-item lang-en">
                                <a href="<?=base_url().$r->image?>" class="glightbox imagefull"><img
                                        src="<?=base_url().$r->image?>" class="menu-img img-fluid imagefull"
                                        alt="" /></a>
                                <h4><?=$r->title_eng?></h4>
                                <p class="ingredients containerHigt overflow-h">
                                    <?=$r->detail_eng?>
                                </p>

                            </div>
                            <?php endforeach;?>

                            <!-- Menu Item -->
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->


                </div>
            </div>
        </section>
        <!-- ======= Why Us Section ======= -->
        <section id="vision" class="why-us section-bg">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="why-box">
                            <h3 id="vision-title">Vision and Mission
                                <br />ພັນເພັດກ້າວໄກ ຮ່ວມໃຈພັດທະນາ
                            </h3>
                            <p class="containerHigt overflow-h" id="vision-content">
                                <!-- Content will be populated by the script -->
                            </p>
                            <!-- <div class="text-center">
                                <a href="#" class="more-btn" id="learn-more">Learn More <i
                                        class="bx bx-chevron-right"></i></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="row gy-4">
                            <?php foreach($whyus as $r): ?>
                            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <img src="<?=base_url().$r->image?>" style="width: 50px;">
                                    <h4 class="lang-la d-none" id="whyus-title-<?=$r->id?>"><?=$r->title_lao?></h4>
                                    <h4 class="lang-en" id="whyus-title-<?=$r->id?>"><?=$r->title_eng?></h4>
                                    <p class="containerHigt overflow-h lang-la d-none" id="whyus-detail-<?=$r->id?>">
                                        <?=$r->detail_lao?>
                                    </p>
                                    <p class="containerHigt overflow-h lang-en" id="whyus-detail-<?=$r->id?>">
                                        <?=$r->detail_eng?>
                                    </p>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <!-- End Icon Box -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Why Us Section -->

        <!-- ======= Stats Counter Section ======= -->
        <section id="stats-counter" class="stats-counter">
            <div class="container" data-aos="zoom-out">
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p class="lang-en">Services</p>
                            <p class="lang-la d-none">ການບໍລິການ</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p class="lang-en">Projects</p>
                            <p class="lang-la d-none">ຂອງການ</p>
                        </div>
                    </div>
                    <!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p class="lang-en">Hours Of Support</p>
                            <p class="lang-la d-none">ຊົ່ວໂມງການສະຫຼຸບ</p>
                        </div>
                    </div>
                    <!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p class="lang-en">Workers</p>
                            <p class="lang-la d-none">ພະນັກງານ</p>
                        </div>
                    </div>
                    <!-- End Stats Item -->
                </div>
            </div>
        </section>

        <!-- End Stats Item -->
        <!-- End Stats Counter Section -->

        <!-- ======= Menu Section ======= -->
        <section id="news" class="menu">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h1 class="lang-en">News</h1>
                    <h1 class="lang-la d-none">ຂ່າວ</h1>
                </div>


                <!-- <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                    <div class="tab-pane fade active show" id="menu-starters">


                        <div class="row gy-5"> -->
                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <?php foreach($news as $r): ?>
                        <div class="swiper-slide col-lg-4 menu-item lang-la d-none" style="padding: 10px;">
                            <a href="<?=base_url().$r->image?>" class="glightbox"><img src="<?=base_url().$r->image?>"
                                    class="menu-img img-fluid" alt="" /></a>
                            <h4><?=$r->title_lao?></h4>
                            <p class="ingredients">
                                <?=$r->detail_lao?>
                            </p>

                        </div>
                        <div class="swiper-slide col-lg-4 menu-item lang-en" style="padding: 10px;">
                            <a href="<?=base_url().$r->image?>" class="glightbox"><img src="<?=base_url().$r->image?>"
                                    class="menu-img img-fluid" alt="" /></a>
                            <h4><?=$r->title_eng?></h4>
                            <p class="ingredients">
                                <?=$r->detail_eng?>
                            </p>

                        </div>
                        <?php endforeach; ?>

                        <!-- Menu Item -->

                    </div>
                    <!-- </div> -->
                    <!-- End Starter Menu Content -->


                </div>
            </div>
        </section>
        <!-- End Menu Section -->


        <!-- End Testimonials Section -->


        <!-- ======= Chefs Section ======= -->
        <section id="Board" class="chefs section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h1 class="lang-en">Board of Directors</h1>
                    <h1 class="lang-la d-none">ສະຖານທູນຄຸນປະຊາຊົນ</h1>
                </div>


                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <?php foreach ($board as $r) :?>
                        <div class="swiper-slide event-item col-lg-4 col-md-6 d-flex align-items-stretch"
                            data-aos="fade-up" data-aos-delay="100" style="pading: 10px">
                            <div class="chef-member" style="
    padding: 10px;
">
                                <div class="member-img">
                                    <img src="<?=base_url().$r->image?>" class="img-fluid" alt="" />
                                    <div class="social">
                                        <a href=""><i class="bi bi-twitter"></i></a>
                                        <a href=""><i class="bi bi-facebook"></i></a>
                                        <a href=""><i class="bi bi-instagram"></i></a>
                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                                <div class="member-info lang-la d-none">
                                    <h4><?=$r->title_lao?></h4>
                                    <!-- <span>ປະທານ</span> -->
                                    <p class="containerHigt overflow-h">
                                        <?=$r->detail_lao?>
                                    </p>
                                </div>
                                <div class="member-info lang-en">
                                    <h4><?=$r->title_eng?></h4>
                                    <!-- <span>ປະທານ</span> -->
                                    <p class="containerHigt overflow-h">
                                        <?=$r->detail_eng?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Chefs Section -->

        <!-- ======= Book A Table Section ======= -->


        <!-- ======= Events Section ======= -->
        <section id="events" class="events">
            <div class="container-fluid" data-aos="fade-up">
                <div class="section-header">
                    <h1 class="lang-en">Investment</h1>
                    <h1 class="lang-la d-none">ການລັດທະນາ</h1>
                </div>

                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <?php foreach($business as $r): ?>
                        <div class="swiper-slide event-item d-flex flex-column justify-content-end lang-en"
                            style="background-image: url(<?=base_url().$r->image?>)">
                            <h3><?=$r->title_eng?></h3>
                            <p class="description">
                                <?=$r->detail_eng?>
                            </p>
                        </div>
                        <div class="swiper-slide event-item d-flex flex-column justify-content-end lang-la d-none"
                            style="background-image: url(<?=base_url().$r->image?>)">
                            <h3><?=$r->title_lao?></h3>
                            <p class="description">
                                <?=$r->detail_lao?>
                            </p>
                        </div>
                        <?php  endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!-- End Events Section -->
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <!-- <h2>gallery</h2> -->
                    <h1 class="lang-en">Gallery</h1>
                    <h1 class="lang-la d-none">ແທຣການປະຕິບັດ</h1>
                </div>

                <div class="gallery-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <?php foreach($gallery as $r): ?>
                        <div class="swiper-slide">
                            <a class="glightbox" data-gallery="images-gallery" href="<?=base_url().$r->image?>"><img
                                    src="<?=base_url().$r->image?>" class="img-fluid" alt="" /></a>
                        </div>
                        <?php  endforeach; ?>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!-- End Gallery Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h1 class="lang-en">Contact Us</h1>
                    <h1 class="lang-la d-none">ຕິດຕໍ່ພວກເຮົາ</h1>
                </div>

                <div class="mb-3">
                    <iframe style="border: 0; width: 100%; height: 350px"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3797.1381487817966!2d102.67526911488333!3d17.878992687785708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31246560c7867ded%3A0x8f63e560eed40bc6!2zUGhhbnBoZXQgRmlybSDguprgu43guqXgurTguqrgurHgupQg4Lqe4Lqx4LqZ4LuA4Lqe4Lqx4LqUIOC6nuC6seC6lOC6l-C6sOC6meC6suC6geC6sOC6quC6tOC6geC6syDguojgu43gurLguoHgurHgupQ!5e0!3m2!1sth!2sth!4v1679893191574!5m2!1sth!2sth"
                        frameborder="0" allowfullscreen></iframe>
                </div>
                <!-- End Google Maps -->

                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center">
                            <i class="icon bi bi-map flex-shrink-0"></i>
                            <div>
                                <h3 class="lang-en">Our Address</h3>
                                <h3 class="lang-la d-none">ທີ່ຢູ່ຂອງພວກເຮົາ</h3>
                                <p><?=$contact->address?></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center">
                            <i class="icon bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3 class="lang-en">Email Us</h3>
                                <h3 class="lang-la d-none">ຕິດຕໍ່ພວກເຮົາທີ່ຢູ່ອີເມລ</h3>
                                <p><?=$contact->email?></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center">
                            <i class="icon bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3 class="lang-en">Call Us</h3>
                                <h3 class="lang-la d-none">ໂທຫາພວກເຮົາ</h3>
                                <p><?=$contact->phone?></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center">
                            <i class="icon bi bi-share flex-shrink-0"></i>
                            <div>
                                <h3 class="lang-en">Opening Hours</h3>
                                <h3 class="lang-la d-none">ເວລາເປີດຕິດຕາມ</h3>
                                <div>
                                <?=$contact->timeopen?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->
                </div>

                <form action="forms/contact.php" method="post" role="form" class="php-email-form p-3 p-md-4">
                    <div class="row">
                        <div class="col-xl-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                required />
                        </div>
                        <div class="col-xl-6 form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                            required />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"
                            required></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading lang-en">Loading</div>
                        <div class="loading lang-la d-none">ກຳລັງໂຫຼດ</div>
                        <div class="error-message lang-en"></div>
                        <div class="error-message lang-la d-none"></div>
                        <div class="sent-message lang-en">
                            Your message has been sent. Thank you!
                        </div>
                        <div class="sent-message lang-la d-none">
                            ຂໍອະໄພທີ່ໄດ້ສົ່ງຂໍ້ມູນ. ຂໍອະໄພ!
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="lang-en">Send Message</button>
                        <button type="submit" class="lang-la d-none">ສົ່ງຂໍ້ມູນ</button>
                    </div>
                </form>
                <!--End Contact Form -->
            </div>
        </section>
        <!-- End Contact Section -->
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4 class="lang-en">Address</h4>
                        <h4 class="lang-la d-none">ທີ່ຢູ່</h4>
                        <p><?=$contact->address?>

                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4 class="lang-en">Reservations</h4>
                        <p class="lang-en">
                            <strong>Phone:</strong> <?=$contact->phone?> <br />
                            <strong>Email:</strong> <?=$contact->email?><br />
                        </p>
                        <h4 class="lang-la d-none">ການຈອງ</h4>
                        <p class="lang-la d-none">
                            <strong>ໂທ:</strong> <?=$contact->phone?> <br />
                            <strong>ອີເມວ:</strong> <?=$contact->email?><br />
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4 class="lang-en">Opening Hours</h4>
                        <h4 class="lang-la d-none">ເວລາເປີດຕິດຕາມ</h4>
                        <p>
                            <strong><?=$contact->timeopen?></strong>
                            <!-- <span class="lang-en">Sunday: Closed</span>
                            <span class="lang-la d-none">ວັນອາທິດ: ບໍ່ເປີດສົງທາງ</span> -->
                        </p>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 footer-links">
                    <h4 class="lang-en">Follow Us</h4>
                    <h4 class="lang-la d-none">ຕິດຕາມພວກເຮົາ</h4>

                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>PPAD</span></strong>. All Rights Reserved
            </div>

        </div>
    </footer>
    <!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="../../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/assets/vendor/aos/aos.js"></script>
    <script src="../../public/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../public/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../../public/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../public/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../public/assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <script>
    var en = {
        "title": "Phanphet",
        "ourbusiness": "Our business",
        "vision-title": "Vision and Mission",
        "vision-content": "English version of vision and mission content...",
        "learn-more": "Learn More",
        "whyus-title-1": "English title for whyus 1",
        "whyus-detail-1": "English detail for whyus 1",
        "whyus-title-2": "English title for whyus 2",
        "whyus-detail-2": "English detail for whyus 2",
        "menu": {
            "home": "Home",
            "product": "Product",
            "business": "Business",
            "investment": "Investment",
            "news": "News",
            "gallery": "Gallery",
            "about": "About",
            "contact": "Contact"
        }
    };
    var la = {
        "title": "ພັນເພັດ ພັດທະນາກະສິກຳ",
        "ourbusiness": "ທຸລະກິດຂອງພວກເຮົາ",
        "vision-title": "ພັນເພັດກ້າວໄກ ຮ່ວມໃຈພັດທະນາ",
        "vision-content": "ພາສາລາວຂອງພັນເພັດກ້າວໄກ ແລະ ພັດທະນາ...",
        "learn-more": "ເບິ່ງລາຍລະອຽດ",
        "whyus-title-1": "ຫົວຂໍ້ຂອງພາສາລາວສໍາລັບທີ່ນຳໃຊ້ 1",
        "whyus-detail-1": "ລາຍລະອຽດພາສາລາວສໍາລັບທີ່ນຳໃຊ້ 1",
        "whyus-title-2": "ຫົວຂໍ້ຂອງພາສາລາວສໍາລັບທີ່ນຳໃຊ້ 2",
        "whyus-detail-2": "ລາຍລະອຽດພາສາລາວສໍາລັບທີ່ນຳໃຊ້ 2",
        "menu": {
            "home": "ໜ້າຫຼັກ",
            "product": "ຜະ​ລິດ​ຕະ​ພັນ",
            "business": "ທຸລະກິດ",
            "investment": "ການລົງທືນ",
            "news": "ຂ່າວ",
            "gallery": "ກາລາຣີ",
            "about": "ກ່ຽວກັບ",
            "contact": "ຕິດຕໍ່"
        }
    };
    </script>
    <script>
    function loadLanguage(data) {
        // Load JSON file based on language selection

        // Populate the HTML elements with the translated text
        document.getElementById('title').innerText = data.title;
        document.getElementById('ourbusiness').innerText = data.ourbusiness;
        document.getElementById('menu-home').innerText = data.menu.home;
        document.getElementById('product').innerText = data.menu.product;
        document.getElementById('menu-business').innerText = data.menu.business;
        document.getElementById('menu-investment').innerText = data.menu.investment;
        document.getElementById('menu-news').innerText = data.menu.news;
        document.getElementById('menu-gallery').innerText = data.menu.gallery;
        document.getElementById('menu-about').innerText = data.menu.about;
        document.getElementById('menu-contact').innerText = data.menu.contact;
        document.getElementById('vision-title').innerHTML = data['vision-title'];
        document.getElementById('vision-content').innerHTML = data['vision-content'];
        // document.getElementById('learn-more').innerText = data['learn-more'];


    }

    // Default language (Thai)
    loadLanguage(la);
    toggleLanguage('la')
    if(localStorage.getItem("lan") != undefined){
        toggleLanguage(localStorage.getItem("lan"))
        if(localStorage.getItem("lan") == "la"){
            loadLanguage(la);
            document.getElementById('language-switcher').innerText = "EN" ;
        }else{
            loadLanguage(en);
            document.getElementById('language-switcher').innerText = "LA" ;
        }
       

    }
    // Toggle language when the language-switcher is clicked
    document.getElementById('language-switcher').addEventListener('click', function() {
        if (this.innerText === 'EN') {
            loadLanguage(en);
            toggleLanguage('en')
            this.innerText = 'LA';
            localStorage.setItem("lan", 'en');
        } else {

            loadLanguage(la);
            toggleLanguage('la')
            this.innerText = 'EN';
            localStorage.setItem("lan", 'la');
        }
    });
    
    function switcherLanguage() {
        // if (this.innerText === 'EN') {
        //     loadLanguage(en);
        //     toggleLanguage('en')
        //     this.innerText = 'LA';
        // } else {

        //     loadLanguage(la);
        //     toggleLanguage('la')
        //     this.innerText = 'EN';
        // }
    }
    function toggleLanguage(lang) {
        if (lang === "en") {
            $(".lang-en").removeClass("d-none");
            $(".lang-la").addClass("d-none");
        } else if (lang === "la") {
            $(".lang-en").addClass("d-none");
            $(".lang-la").removeClass("d-none");
        }
    }
    </script>
</body>

</html>