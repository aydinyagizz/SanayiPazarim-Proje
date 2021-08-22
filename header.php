
<?php  
ob_start();
session_start();

require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/production/fonksiyon.php';
date_default_timezone_set('Europe/Istanbul'); 

/*Ayar tablosundan site ayarlarımızı çekiyoruz.*/
$ayarsor=$db->prepare("SELECT * FROM ayar WHERE ayar_id=:id");
$ayarsor->execute(array(
    'id' =>0
));  /*ayar tablosundaki id 0 ise onu getir sorgusu yazdık.*/

$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);  /*PDO'da veriyi çekmek için gerekli fonksiyonu kullanıyoruz.*/






if (@$_SESSION['userkullanici_mail']) { //kullanıcı varsa kullanıcı bilgilerini çekiyoruz

    /*kullanıcı bilgilerini çekilmesi*/

    $kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail");
    $kullanicisor->execute(array(
      'mail' => $_SESSION['userkullanici_mail'],

  ));
    $say= $kullanicisor->rowCount();
    $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

}


 //Kullanıcı ID Session Atama.
    if (!isset($_SESSION['userkullanici_id'])) {

     @$_SESSION['userkullanici_id']=$kullanicicek['kullanici_id'];
 }


?>

<!doctype html>
  <html class="no-js" lang="TR">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>    
        <?php 

        if (empty($title)) { /*empty; değişkenin boş mu dolu mu olduğunu sorguluyor.*/
            echo $ayarcek['ayar_title'];
        } else {
            echo $title;
        } 

        ?>
    </title>

    <meta name="description" content=<?php echo $ayarcek['ayar_description']; ?>>
    <meta name="keywords" content=<?php echo $ayarcek['ayar_keywords']; ?>>
    <meta name="author" content=<?php echo $ayarcek['ayar_author']; ?>>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

    <!-- Normalize CSS --> 
    <link rel="stylesheet" href="css\normalize.css">

    <!-- Main CSS -->         
    <link rel="stylesheet" href="css\main.css">

    <!-- Bootstrap CSS --> 
    <link rel="stylesheet" href="css\bootstrap.min.css">

    <!-- Animate CSS --> 
    <link rel="stylesheet" href="css\animate.min.css">

    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css\font-awesome.min.css">

    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

    <!-- Main Menu CSS -->      
    <link rel="stylesheet" href="css\meanmenu.min.css">

    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="css\jquery.datetimepicker.css">

    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="css\reImageGrid.css">

    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="css\hover-min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">


    <!-- Modernizr Js -->
    <script src="js\modernizr-2.8.3.min.js"></script>

    <!-- CK Editör -->
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

</head>
<body>
  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

  <!-- Add your site or application content here -->
  <!-- Preloader Start Here -->
  <div id="preloader"></div>
  <!-- Preloader End Here -->
  <!-- Main Body Area Start Here -->
  <div id="wrapper">
      <!-- Header Area Start Here -->
      <header>                
          <div id="header2" class="header2-area right-nav-mobile">
              <div class="header-top-bar">
                  <div class="container">
                      <div class="row">                         
                          <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                              <div class="logo-area">
                                  <a href="index.php"><img class="img-responsive" src="<?php echo $ayarcek['ayar_logo'] ?>" alt="logo"></a>
                              </div>
                          </div> 
                          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">



                              <ul class="profile-notification"> 



                                <?php 

                                if (isset($_SESSION['userkullanici_mail'])) {  

                                    ?>



                                    <li>
                                        <div class="user-account-info">
                                            <div class="user-account-info-controler">
                                                <div class="user-account-img">
                                                    <img class="img-responsive" src="img\profile\4.png" alt="profile">
                                                </div>
                                                <div class="user-account-title">
                                                    <div class="user-account-name"><?php echo $kullanicicek['kullanici_ad']." ".substr($kullanicicek['kullanici_soyad'], 0,1) ?>.</div>

                                                </div>

                                            </div>

                                        </div>
                                    </li>

                                    <li><a class="apply-now-btn" href="logout.php" id="logout-button">Çıkış Yap</a></li>

                                <?php } else {  ?>

                                    <li><a class="apply-now-btn hidden-on-mobile" href="login.php">Üye Girişi</a></li>

                                    <li><a class="apply-now-btn-color hidden-on-mobile" href="register.php">Kayıt Ol</a></li>

                                <?php  } ?>



                            </ul>


                        </div>                          
                    </div>                          
                </div>
            </div>
            <div class="main-menu-area bg-primaryText" id="sticker">
                <div class="container">
                    <nav id="desktop-nav">
                        <ul>

                            <li class="active"><a href="index.php">Anasayfa</a>
                            <?php 

                            $kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail and kullanici_yetki=:kullanici_yetki");
                            $kullanicisor->execute(array(
                              'mail' => @$_SESSION['userkullanici_mail'],
                              'kullanici_yetki' => 5
                          ));
                            $say= $kullanicisor->rowCount();
                            $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


                            if ($kullanicicek['kullanici_yetki'] == 5) {  

                                ?>


                                <li class="active"><a href="urunlerim.php">Admin Ürünleri</a>
                                <li class="active"><a href="urun-ekle.php">Ürün Ekle</a>

                                <?php } ?>


                            </li>
                            
                            <li><a href="kategoriler.php">Kategoriler</a>
                                                                    
                            </li>
                            
                            
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area Start -->
        <div class="mobile-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                                <ul>
                                    <li class="active"><a href="#">Home</a>
                                        <ul>
                                            <li><a href="index.htm">Home 1</a></li>
                                            <li><a href="index2.htm">Home 2</a></li>
                                        </ul>   
                                    </li>
                                    <li><a href="about.htm">About</a></li>
                                    <li><a href="#">Pages</a>
                                        <ul class="mega-menu-area"> 
                                            <li>
                                                <a href="index.htm">Home 1</a>
                                                <a href="index2.htm">Home 2</a>
                                                <a href="about.htm">About</a>
                                                <a href="product-page-grid.htm">Product Grid</a>
                                            </li> 
                                            <li>
                                                <a href="product-page-list.htm">Product List</a>
                                                <a href="product-category-grid.htm">Category Grid</a>
                                                <a href="product-category-list.htm">Category List</a>
                                                <a href="single-product.htm">Product Details</a>
                                            </li>
                                            <li>
                                                <a href="profile.htm">Profile</a>
                                                <a href="favourites-grid.htm">Favourites Grid</a>
                                                <a href="favourites-list.htm">Favourites List</a>
                                                <a href="settings.htm">Settings</a>
                                            </li>
                                            <li>
                                                <a href="upload-products.htm">Upload Products</a>
                                                <a href="sales-statement.htm">Sales Statement</a>
                                                <a href="withdrawals.htm">Withdrawals</a>
                                                <a href="404.htm">404</a>
                                            </li>
                                        </ul>                                            
                                    </li>
                                    <li><a href="product-page-grid.htm">WordPress</a></li>
                                    <li><a href="product-category-grid.htm">Joomla</a></li>
                                    <li><a href="product-category-list.htm">Plugins</a></li>
                                    <li><a href="product-page-list.htm">Components</a></li>
                                    <li><a href="product-category-grid.htm">PSD</a></li>
                                    <li><a href="#">Blog</a>
                                        <ul>
                                            <li><a href="blog.htm">Blog</a></li>
                                            <li><a href="single-blog.htm">Blog Details</a></li> 
                                            <li class="has-child-menu"><a href="#">Second Level</a>
                                                <ul class="thired-level">
                                                    <li><a href="index.htm">Thired Level 1</a></li>
                                                    <li><a href="index.htm">Thired Level 2</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.htm">Contact</a></li>
                                    <li><a href="help.htm">Help</a></li>
                                </ul>
                            </nav>
                        </div>           
                    </div>
                </div>
            </div>
        </div>  
        <!-- Mobile Menu Area End -->
    </header>
<!-- Header Area End Here -->