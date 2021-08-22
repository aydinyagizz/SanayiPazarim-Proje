
<?php 

require_once 'header.php'; 


//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id where urun_id=:id ");
$urunsor->execute(array(
    'id' => $_GET['urun_id'],
    
));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);



?>

<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <h2 style="color:white;"><?php echo $uruncek['urun_ad'] ?></h2>

        </div>
    </div>
</div>
<!-- Main Banner 1 Area End Here --> 
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
  <?php 

            

            if (@$_GET['durum']=="gecersiz-teklif") {?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Geçersiz Teklif Girdiniz!
                </div>

            <?php }  elseif (@$_GET['durum']=="teklif-sifir") {?>

                <div class="alert alert-danger">
                    <strong>Bilgi!</strong> Teklifiniz Geçersiz.
                </div>

            <?php } else if (@$_GET['durum']=="teklif-basarili") {?>

                <div class="alert alert-success">
                    <strong>Bilgi!</strong> Tebrikler.
                </div>

            <?php } ?>

        </div>
    </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Product Details Page Start Here -->
<div class="product-details-page bg-secondary">                
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive">
                    </div>                                
                    


                    <div class="product-details-tab-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="product-details-title">
                                    <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">Ürün Açıklaması</a></li>


                                </ul>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="description">
                                        <p><?php echo $uruncek['urun_detay']; ?></p>
                                    </div>
                                    <div class="tab-pane fade" id="review">




                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> 




                </div>
            </div>
            <?php

            $son_teklif_veren_kisi=$db->prepare("SELECT * FROM urun inner join kullanici ON urun.teklif_veren_kullanici_id =kullanici.kullanici_id WHERE urun_id=:urun_id");
            $son_teklif_veren_kisi->execute(array(
                'urun_id' => $_GET['urun_id']
            ));
            $son_teklif_veren_kisi_cek=$son_teklif_veren_kisi->fetch(PDO::FETCH_ASSOC);
      
            ?>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">

                             <?php $urun_bitis_tarihi = $uruncek['urun_bitis_tarihi']." ".$uruncek['urun_bitis_saati'] ?>
                             <?php $urun_baslangıc_tarihi = $uruncek['urun_zaman']?>

                              

                           
                            <h5 class="sidebar-item-title">Ürün Başlangıç Tarihi:<br>
                                <?php echo $urun_baslangıc_tarihi ?>
                            </h5> 
                            <h5 class="sidebar-item-title">Ürün Bitiş Tarihi:<br>
                               
                                <?php echo $urun_bitis_tarihi ?>
                                
                            </h5> 
                             
                            <?php  if ($uruncek['urun_fiyat']<$uruncek['urun_baslangic_fiyati']) { ?>
                                <h3 class="sidebar-item-title">Başlangıç Fiyatı;</h3>

                                <div align="center">
                                    <b style="font-size: 30px;"><?php echo $uruncek['urun_baslangic_fiyati'] ?><span style="font-size: 17px;"> ₺</span></b>
                                    <hr>
                                </div>
                            <?php  } else{ ?>

                                <h3 class="sidebar-item-title">Son Teklif Veren Kişi; <br>   <strong><?php echo $son_teklif_veren_kisi_cek['kullanici_ad']." ".substr($son_teklif_veren_kisi_cek['kullanici_soyad'], 0,1); ?>.</strong> </h3>
                              
                                <div align="center">
                                     
                                   <h3>Son Teklif;</h3>  <b style="font-size: 30px;"><?php echo $uruncek['urun_fiyat'] ?> <span style="font-size: 17px;"> ₺</span></b>
                                    <hr>
                                </div>


                            <?php }?>
                            <h3 class="sidebar-item-title">Teklif Ver</h3>
                            <?php if ($urun_bitis_tarihi>date('Y-m-d H:i:s')) { ?>


                                <form action="nedmin/netting/islem.php" method="POST">

                                    <ul class="sidebar-product-btn">
                                        <div align="center">
                                            <input type="number" class="form-control" name="teklif" placeholder="Teklifi Giriniz.">
                                        </div>

                                        <hr>
                                        <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                                        <input type="hidden" name="seo" value="urun-<?=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'] ?>">

                                        <?php 

                                        if (empty($_SESSION['userkullanici_id'])) {  ?>

                                            <li><a href="login.php" class="buy-now-btn" id="buy-button"><i class="fa fa-ban" aria-hidden="true"></i> Giriş Yapın</a></li>

                                        <?php }  else if ($_SESSION['userkullanici_id']==$uruncek['kullanici_id']) {  ?>
                                            <li><a class="add-to-cart-btn" id="cart-button"><i class="fa fa-ban" aria-hidden="true"></i> Kendi Ürününüz</a> </li>

                                        <?php  } else { ?> 

                                            <li><button type="submit" name="teklif_ver" class="add-to-cart-btn" id="cart-button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Teklif Ver</button></li>

                                        <?php } ?>



                                    </ul>

                                </form>


                            <?php } else{ ?>
                                <h5>Ürün Teklifi Verebilmek İçin Tarih Geçmiştir.</h5>
                            <?php  } ?> 
                            
                            <hr>


                        </div>
                    </div>                                
                    

                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <img style="width: 72px; height: 72px;" src="img\profile\4.png" alt="product" class="img-responsive">
                                <div class="sidebar-author-content">
                                    <h3><?php echo $uruncek['kullanici_ad']." ".substr($uruncek['kullanici_soyad'],0,1) ?>.</h3>

                                </div>
                            </div>

                            <ul class="sidebar-badges-item">

                              <?php 

                            //kaç tane ürünüm varsa onları saydırıyoruz.
                              $urunsay=$db->prepare("SELECT COUNT(kullanici_id) as say FROM siparis_detay WHERE kullanici_idsatici=:id");
                              $urunsay->execute(array(
                                'id' => $uruncek['kullanici_id']
                            ));

                              $saycek=$urunsay->fetch(PDO::FETCH_ASSOC);


                              if ($saycek['say'] > 1 and $saycek['say'] <= 9) { ?>

                                 <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>

                             <?php } else if ($saycek['say'] >9 and $saycek['say'] <= 99) { ?>

                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>

                            <?php } else if ($saycek['say'] >99 and $saycek['say'] <=999) { ?>

                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>

                            <?php } else if ($saycek['say'] >999 and $saycek['say'] <= 9999) { ?>

                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>

                            <?php } else if ($saycek['say'] >9999) { ?>

                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>

                            <?php } ?>

                        </ul>

                    </div>
                </div>
            </div>
        </div>                        
    </div>
</div>
</div>
<!-- Product Details Page End Here -->


<?php require_once 'footer.php'; ?>