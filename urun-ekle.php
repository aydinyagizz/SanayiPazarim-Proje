
<?php 

require_once 'header.php'; 


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


                            <form action="nedmin/netting/adminislem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" >


                                <div class="settings-details tab-content">
                                    <div class="tab-pane fade active in" id="Personal">
                                        <h2 class="title-section">Ürün Ekleme</h2>
                                        <div class="personal-info inner-page-padding"> 


                                           <div class="form-group">
                                            <label class="col-sm-3 control-label">Ürün Fotoğrafı</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" required="" name="urunfoto_resimyol"  type="file">
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

                                                            <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>

                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ürün Adı</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" required="" name="urun_ad" placeholder="Ürün Adı" id="last-name" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ürün Açıklama</label>
                                            <div class="col-sm-9">

                                              <textarea class="ckeditor" id="editor1" name="urun_detay" placeholder="Ürün Açıklaması"></textarea>

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
                                        <input class="form-control" required="" name="urun_baslangic_fiyati" placeholder="ürün balangiç fiyati" id="last-name" type="text">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Bitiş Tarihi</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required name="urun_bitis_tarihi" placeholder="Ürün Bitiş Tarihi" id="last-name" type="date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Bitiş Saati</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required name="urun_bitis_saati" placeholder="Ürün Bitiş Saati" id="last-name" type="time">
                                    </div>
                                </div>


                                <div class="form-group">

                                    <div align="right" class="col-sm-12">

                                        <button class="update-btn" name="urunekle" id="login-update">Ürün Ekle</button>
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

