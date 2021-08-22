 
<?php require_once'header.php'; ?>


<!-- Main Banner 1 Area Start Here -->
<div class="main-banner2-area">
    <div class="container">
        <div class="main-banner2-wrapper">                       
            <h1>Sanayi Pazarım Projemize Hoşgeldiniz...</h1>
            <p>Aramak İstediğiniz Ürünü Giriniz ...</p>
            <div class="banner-search-area input-group">
                <input class="form-control" placeholder="Ne aramıştınız . . ." type="text">
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>  
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Main Banner 1 Area End Here -->            
<!-- Newest Products Area Start Here -->
<div class="newest-products-area bg-secondary section-space-default">                
    <div class="container">
        <h2 class="title-default">Öne Çıkan Ürünler</h2>  
    </div>
    <div class="container-fluid" id="isotope-container">

        <div class="row featuredContainer">


           <?php 


            //Belirli veriyi seçme işlemi
           $urunsor=$db->prepare("SELECT urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_onecikar=:onecikar order by urun_zaman, urun_onecikar DESC ");  //Tek sorguda birden fazla tabloyu çekip ilişkilendirdik. Üstekiyle aynı işlevi yapar ama 3 tablodaki bütün sütunları seçerek yapar. Biz sadece bize lazım olan sütunları seçtik üstteki sorguda.



           $urunsor->execute(array('onecikar' => 1));

           while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)){ ?>



            <!-- Ürün Anasayfa Listeleme Başlangıcı-->

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 joomla plugins component">
                <div class="single-item-grid">
                    <div class="item-img">
                        <a href="urun-<?=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'] ?>"><img style="width: 451px; height: 252px;" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                        <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                    </div>
                    <div class="item-content">
                        <div class="item-info">
                            <h3><a href="urun-<?=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'] ?>"><?php echo substr($uruncek['urun_ad'], 0,19) ?>...</a></h3>
                            <span><a href="kategoriler-<?=seo($uruncek['kategori_ad'])."-".$uruncek['kategori_id'] ?>"><?php echo $uruncek ['kategori_ad'] ?></a></span>

                            <?php if ($uruncek['urun_fiyat'] == "0.00") {?>

                                <div class="price"><?php echo $uruncek['urun_baslangic_fiyati'] ?> ₺</div>

                           <?php } else { ?> 

                             <div class="price"><?php echo $uruncek['urun_fiyat'] ?> ₺</div>

                          <?php } ?>
                           
                        </div>
                        <div class="item-profile">
                            <div class="profile-title">


                                <div class="img-wrapper"><img src="img\profile\1.jpg" alt="profile" class="img-responsive img-circle"></div>

                                <span><?php echo $uruncek['kullanici_ad']." ".$uruncek['kullanici_soyad'] ?></span>
                            </div>
                            <div class="profile-rating">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>


    </div>

</div>
</div>
<!-- Newest Products Area End Here -->




<?php require_once'footer.php'; ?>