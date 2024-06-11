
<?php 
include "./assets/plugins/phpqrcode/qrlib.php";



?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
                    <li><a href="<?=base_url()?>#hero" id="menu-home"></a></li>
                    <li><a href="<?=base_url('api/product')?>#product" id="product"></a></li>
                    <li><a href="<?=base_url()?>#menu" id="menu-business"></a></li>
                    <li><a href="<?=base_url()?>#events" id="menu-investment"></a></li>
                    <li><a href="<?=base_url()?>#news" id="menu-news"></a></li>
                    <li><a href="<?=base_url()?>#gallery" id="menu-gallery"></a></li>
                    <li class="dropdown">
                        <a href="<?=base_url()?>#"><span id="menu-about"></span>
                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                        </a>
                        <ul>
                            <!-- <li><a href="<?=base_url()?>#">Chairman's comments</a></li> -->
                            <li><a href="<?=base_url()?>#vision">Vision and Mission</a></li>
                            <li><a href="<?=base_url()?>#Board">Board of Directors</a></li>
                        </ul>
                    </li>
                    <li><a href="<?=base_url()?>#contact" id="menu-contact"></a></li>
                    <!-- <li> <a href="<?=base_url("loginuser")?>" class="btn btn-book-a-table " style="width: 80px;" >Login </a>
                    </li> -->

 <li><button class="btn btn-book-a-table" onclick="switcherLanguage(this)" id="language-switcher" style="width: 80px;">EN</button></li>
                </ul>
            </nav>
            <!-- .navbar -->
           

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header>



    <main id="main">

        <section id="product" class="menu">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <br />
                    <h1 id="productlist"></h1>
                </div>


                <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                    <div class="tab-pane fade active show" id="menu-starters">


                        <div class="row gy-5">
                            <?php foreach($productListing as $r): 
                                $location_image="./assets/imagesQRcode/".rand().".png";
                                ?>
                            <div class="col-lg-4 menu-item lang-la d-none">
                                <a href="<?=base_url().$r->product_image?>" class="glightbox imagefull"><img
                                        src="<?=base_url().$r->product_image?>" class="menu-img img-fluid imagefull"
                                        alt="" style="height: 350px !important;"/></a>
                                <h4><?=$r->product_name_la?></h4>
                                <p class=" text-left" style="text-align: start;">
                                    <i class="fas fa-store"></i>
                                    <?=$r->farm_name_la?>

                                    <?php
                                        $url = "https://phanphet.com/farm_detail/". $r->production_id; 
                                        QRcode::png($url,$location_image);
                                        ?>
                                        <a href="<?= base_url($location_image)?>" class="glightbox imagefull" ><img
                                        src="<?= base_url($location_image)?>" class="menu-img img-fluid imagefull" style="width: 50px;"
                                        alt="" /></a>

                                        <!-- <img src="<?= base_url($location_image)?>" style="width: 50px;"> -->
                                </p>

                                <p class="ingredients containerHigt overflow-h">

                                    <?=$r->product_description_la?>
                                </p>
                                <a href="https://phanphet.com/Ordercus/cusaddOrder/<?=$r->product_id?>" class="btn btn-success" style="width: 80px;" target="_blank" >ຄໍາສັ່ງ</a>

                            </div>
                            <div class="col-lg-4 menu-item lang-en">
                                <a href="<?=base_url().$r->product_image?>" class="glightbox imagefull"><img
                                        src="<?=base_url().$r->product_image?>" class="menu-img img-fluid imagefull"
                                        alt="" style="height: 350px !important;" /></a>
                                <h4><?=$r->product_name_en?></h4>
                                <p class="text-left" style="text-align: start;">
                                    <i class="fas fa-store"></i>
                                    <?=$r->farm_name_en?>
                                    <?php
                                        $url = "https://phanphet.com/farm_detail/". $r->production_id;
                                        // echo $url; 
                                        QRcode::png($url,$location_image);
                                        ?>
                                        <a href="<?= base_url($location_image)?>" class="glightbox imagefull" ><img
                                        src="<?= base_url($location_image)?>" class="menu-img img-fluid imagefull" style="width: 50px;"
                                        alt="" /></a>
                                </p>
                                <p class="ingredients containerHigt overflow-h">
                                    <?=$r->product_description_en?>
                                </p>
                              
                                <a href="https://phanphet.com/Ordercus/cusaddOrder/<?=$r->product_id?>" class="btn btn-success" style="width: 80px;" target="_blank"  >Order</a>
                            </div>
                            
                            <?php endforeach;?>

                            <!-- Menu Item -->
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->


                </div>
            </div>
        </section>



        <!-- ======= Book A Table Section ======= -->



        <!-- End Gallery Section -->


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
                            <strong>Phone:</strong> <?=$contact->phone?> Mr. Saman Miboun<br />
                            <strong>Email:</strong> phanphetagridev@ppad.la<br />
                        </p>
                        <h4 class="lang-la d-none">ການຈອງ</h4>
                        <p class="lang-la d-none">
                            <strong>ໂທ:</strong> <?=$contact->phone?> ທ່ານສາມາດ ມືການຕິດຕາມ Mr. Saman Miboun<br />
                            <strong>ອີເມວ:</strong> phanphetagridev@ppad.la<br />
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4 class="lang-en">Opening Hours</h4>
                        <h4 class="lang-la d-none">ເວລາເປີດຕິດຕາມ</h4>
                        <p>
                            <strong>Mon-Sat: 11AM</strong> - 23PM<br />
                            <span class="lang-en">Sunday: Closed</span>
                            <span class="lang-la d-none">ວັນອາທິດ: ບໍ່ເປີດສົງທາງ</span>
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
        // document.getElementById('ourbusiness').innerText = data.ourbusiness;
        document.getElementById('menu-home').innerText = data.menu.home;
        document.getElementById('product').innerText = data.menu.product;
        document.getElementById('productlist').innerText = data.menu.product;
        document.getElementById('menu-business').innerText = data.menu.business;
        document.getElementById('menu-investment').innerText = data.menu.investment;
        document.getElementById('menu-news').innerText = data.menu.news;
        document.getElementById('menu-gallery').innerText = data.menu.gallery;
        document.getElementById('menu-about').innerText = data.menu.about;
        document.getElementById('menu-contact').innerText = data.menu.contact;
        // document.getElementById('vision-title').innerHTML = data['vision-title'];
        // document.getElementById('vision-content').innerHTML = data['vision-content'];
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
        // var language = document.getElementById('language-switcher');
        // if (language.in === 'EN') {
        //     loadLanguage(en);
        //     toggleLanguage('en')
        //     language.html = 'LA';
        // } else {

        //     loadLanguage(la);
        //     toggleLanguage('la')
        //     language.html = 'EN';
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