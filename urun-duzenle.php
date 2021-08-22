
<?php 

require_once 'header.php'; 


//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM urun where kullanici_id=:kullanici_id and urun_id=:urun_id order by urun_zaman DESC");
$urunsor->execute(array(
    'kullanici_id' => $_SESSION['userkullanici_id'],
    'urun_id' => @$_GET['urun_id']
));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

?>


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
                       <!--  <ul>
                            <li><a href="index.htm">Home</a><span> -</span></li>
                            <li>Settings</li>
                        </ul>    kullanmadık-->
                    </div>
                </div>  
            </div> 
            <!-- Inner Page Banner Area End Here -->          
            <!-- Settings Page Start Here -->
            <div class="settings-page-area bg-secondary section-space-bottom">
                <div class="container">
                    <div class="row settings-wrapper">



                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

                            <?php 

                            if (@$_GET['durum']=="hata") {?>

                                <div class="alert alert-danger">
                                    <strong>Hata!</strong> İşlem Başarısız.
                                </div>

                            <?php }  elseif (@$_GET['durum']=="ok") {?>

                                <div class="alert alert-success">
                                    <strong>Bilgi!</strong> Kayıt Başarılı.
                                </div>

                            <?php } ?>


                            <form action="nedmin/netting/adminislem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">


                                <div class="settings-details tab-content">
                                    <div class="tab-pane fade active in" id="Personal">
                                        <h2 class="title-section">Ürün Düzenle</h2>
                                        <div class="personal-info inner-page-padding"> 

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Mevcut Fotoğraf</label>
                                                <div class="col-sm-9">
                                                    <img width="350" src="<?php echo $uruncek['urunfoto_resimyol']; ?>">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Ürün Fotoğrafı</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="urunfoto_resimyol" id="last-name" type="file">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Kategori</label>
                                                <div class="col-sm-9">
                                                    <div class="custom-select">

                                                        <select name="kategori_id" class='select2'>

                                                            <?php 
                                                        //Belirli veriyi seçme işlemi
                                                            $kategorisor=$db->prepare("SELECT * FROM kategori order by kategori_sira ASC");
                                                            $kategorisor->execute();

                                                            while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>

                                                                <option <?php if ($kategoricek['kategori_id']==$uruncek['kategori_id']) { echo "selected"; } ?> value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>

                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Ürün Adı</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" required="" name="urun_ad" value="<?php echo $uruncek['urun_ad'] ?>" id="last-name" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Ürün Açıklama</label>
                                                <div class="col-sm-9">

                                                  <textarea class="ckeditor" id="editor1" name="urun_detay"><?php echo $uruncek['urun_detay'] ?></textarea>

                                              </div>
                                          </div>

                                          <script type="text/javascript">

                                            CKEDITOR.replace ('editor1', 
                                            {

                                              filebrowserBrowseUr1 : 'ckfinder/ckfinder.html',

                                              filebrowserImageBrowseUr1 : 'ckfinder/ckfinder.html?type=Images',

                                              filebrowserFlashBrowseUr1 : 'ckfinder/ckfinder.html?type=Flash',

                                              filebrowserUploadUr1 : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                                              filebrowserImageUploadUr1 : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                                              filebrowserFlashUploadUr1 : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                                              forcePasteAsPlainText : true

                                          }

                                          );

                                      </script>

                                      <div class="form-group">
                                        <label class="col-sm-3 control-label">Ürün Başlangıç Fiyatı</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required="" name="urun_baslangic_fiyati" value="<?php echo $uruncek['urun_baslangic_fiyati'] ?>" id="last-name" type="text">
                                        </div>
                                    </div>


                                    <?php if ($uruncek['urun_fiyat'] == "0") { ?>
                                         <div class="form-group">
                                        <label class="col-sm-3 control-label">Ürün Son Fiyatı</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required=""  readonly="" placeholder="Ürüne Henüz Teklif Gelmedi." id="last-name" type="text">
                                        </div>
                                    </div>
                                    <?php } 

                                    else { ?>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ürün Son Fiyatı</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required=""  readonly="" value="<?php echo $uruncek['urun_fiyat'] ?>" id="last-name" type="text">
                                        </div>
                                    </div>

                                    <?php }  ?>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ürün Bitiş Tarihi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required name="urun_bitis_tarihi" value="<?php echo $uruncek['urun_bitis_tarihi'] ?>"  type="date">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ürün Bitiş Saati</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required name="urun_bitis_saati" value="<?php echo $uruncek['urun_bitis_saati'] ?>" type="time">
                                        </div>
                                    </div>


                                    <input type="hidden" value="<?php echo $uruncek['urun_id'] ?>" name="urun_id">
                                    <input type="hidden" value="<?php echo $uruncek['urunfoto_resimyol'] ?>" name="eski_yol">



                                    <div class="form-group">

                                        <div align="right" class="col-sm-12">

                                            <button class="update-btn" name="urunduzenle" id="login-update">Ürünü Düzenle</button>
                                        </div>
                                    </div>                                        
                                </div> 
                            </div> 


                        </div> 
                    </form> 
                </div>  
            </div>  
        </div>  
    </div>   
    <!-- Settings Page End Here -->
    <!-- Footer Area Start Here -->
    <?php require_once 'footer.php'; ?>


