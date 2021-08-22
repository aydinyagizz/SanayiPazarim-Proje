
<?php require_once 'header.php'; ?>



<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">Üye Giriş İşlemleri</h2>
        <div class="registration-details-area inner-page-padding">


            
            <?php 

            

            if (@$_GET['durum']=="basarisizgiris") {?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Hatalı Giriş.
                </div>

            <?php }  elseif (@$_GET['durum']=="exit") {?>

                <div class="alert alert-success">
                    <strong>Bilgi!</strong> Başarıyla Çıkış Yapıldı.
                </div>

            <?php }  elseif (@$_GET['durum']=="kayitok") {?>

                <div class="alert alert-success">
                    <strong>Bilgi!</strong> Kaydınız Oluşturuldu. Giriş Yapabilirsiniz.
                </div>

            <?php } else if (@$_GET['durum']=="captchahata") {?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Güvenlik Kodu Hatalı. Tekrar Giriniz.
                </div>

            <?php } ?>




            <form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="first-name">Mail Adresiniz *</label>
                            <input type="text" id="first-name" required="" placeholder="Mail Adresinizi Giriniz" name="kullanici_mail" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="last-name">Şifreniz *</label>
                            <input type="password" id="last-name" required="" placeholder="Şifrenizi Giriniz" name="kullanici_password" class="form-control">
                        </div>
                    </div>
                </div>

  <!-- 
                <div class="row">
                    <div align="right" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="first-name">Güvenlik Kodu *</label>
                            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA IMAGE">
                            <a href="#" onclick="document.getElementById('captcha').src='securimage/securimage_show.php?' + Math.random(); return false ">[ Değiştir ]</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                        <div class="form-group">
                            <label class="control-label" for="last-name">Güvenlik Kodunu Giriniz *</label>
                            <input type="text" id="last-name" required="" placeholder="Güvenlik Kodunu Giriniz..." name="captcha_code" class="form-control">
                        </div>
                    </div>
                </div>
 -->

                <div class="row">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                           
                    <div class="pLace-order">
                        <button class="update-btn disabled" type="submit" name="kullanicigiris" >Gönder</button>
                       
                    </div>
                </div>
            </div> 

        </form>                      
    </div> 
</div>
</div>
<!-- Registration Page Area End Here -->



<!-- Modal Başlangıç -->


<div class="modal fade" id="sifremiunuttum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Şifre Sıfırlama</h4>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>-->
  </div>
  <div class="modal-body">
    <form action="mailphp/sifremi-unuttum.php" method="POST">
        <div class="form-group">
           <p><b>Uyarı:</b> Girdiğiniz mail adresi kayıtlarımızda varsa şifreniz mail adresinize gönderilecektir.</p>
       </div>
       <div class="form-group">
        <label for="recipient-name" class="col-form-label">Mail Adresiniz:</label>
        <input type="email" class="form-control" name="kullanici_mail" id="recipient-name">
    </div>

    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
    <button type="submit" name="sifremiunuttum" class="btn btn-primary">Şifre Talep Et</button>
</form>
</div>
</div>
</div>
</div>
<!-- Modal Bitiş -->


<?php require_once 'footer.php'; ?>

