
<?php 	

ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';





//ürün ekleme işlemleri
if (isset($_POST['urunekle'])) {

	//logo boyutu ayarlama
	if ($_FILES['urunfoto_resimyol']['size']>1048576)  /*1 megabayt'tan büyük dosyaları kabul etmiyoruz.*/ {

		echo "Bu doya boyutu çok büyük";
		Header("Location:../../urun-ekle.php?durum=dosyabuyuk");

	}

	//dosya uzantıları ayarlama 
	$izinli_uzantilar=array('jpg','gif','png','jpeg');
	//echo $_FILES['ayar_logo']["name"];

	$ext=strtolower(substr($_FILES['urunfoto_resimyol']["name"], strpos($_FILES['urunfoto_resimyol']["name"], '.')+1));

	if (in_array($ext, $izinli_uzantilar) === false) {
		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../../urun-ekle.php?durum=formathatali");
		exit;

	}

	@$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
	@$name = $_FILES['urunfoto_resimyol']["name"];

	//image resize işlemleri. netting de SimpleImageden çekiyoruz.
	include('SimpleImage.php');
	$image = new SimpleImage();
	$image->load($tmp_name);
	$image->resize(829,422);
	$image->save($tmp_name);

	
	$uploads_dir = '../../dimg/urunfoto';

	
	$benzersizsayi4=uniqid(); //aşagıdaki kodla aynı işlevi yapıyor. fotoğrafı kaydederken benzersiz isim belirliyor.
	//$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");

	
	$duzenle=$db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		kullanici_id=:kullanici_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_baslangic_fiyati=:urun_baslangic_fiyati,
		urunfoto_resimyol=:urunfoto_resimyol,
		urun_bitis_tarihi=:urun_bitis_tarihi,
		urun_bitis_saati=:urun_bitis_saati
		");

	$update=$duzenle->execute(array(
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
		'urun_ad' => htmlspecialchars($_POST['urun_ad']),
		'urun_detay' => $_POST['urun_detay'],
		'urun_baslangic_fiyati' => htmlspecialchars($_POST['urun_baslangic_fiyati']),
		'urunfoto_resimyol' => $refimgyol,
		'urun_bitis_tarihi'=> $_POST['urun_bitis_tarihi'],
		'urun_bitis_saati'=>$_POST['urun_bitis_saati']

	));



	if ($update) {

		Header("Location:../../urunlerim.php?durum=ok");

	} else {

		Header("Location:../../urun-ekle.php?durum=hata");

	}
}




if (isset($_POST['urunduzenle'])) {

	if ($_FILES['urunfoto_resimyol']['size']>0) {  //fotoğraf var demek. onu kontrol ediyoruz.

	//logo boyutu ayarlama
		if ($_FILES['urunfoto_resimyol']['size']>1048576)  /*1 megabayt'tan büyük dosyaları kabul etmiyoruz.*/ {

			echo "Bu doya boyutu çok büyük";
			Header("Location:../../urun-duzenle.php?durum=dosyabuyuk");

		}

	//dosya uzantıları ayarlama 
		$izinli_uzantilar=array('jpg','gif','png','jpeg');
	//echo $_FILES['ayar_logo']["name"];

		$ext=strtolower(substr($_FILES['urunfoto_resimyol']["name"], strpos($_FILES['urunfoto_resimyol']["name"], '.')+1));

		if (in_array($ext, $izinli_uzantilar) === false) {
			echo "Bu uzantı kabul edilmiyor";
			Header("Location:../../urun-duzenle.php?durum=formathatali");
			exit;

		}

		@$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
		@$name = $_FILES['urunfoto_resimyol']["name"];

	//image resize işlemleri. netting de SimpleImageden çekiyoruz.
		include('SimpleImage.php');
		$image = new SimpleImage();
		$image->load($tmp_name);
		$image->resize(829,422);
		$image->save($tmp_name);


		$uploads_dir = '../../dimg/urunfoto';


	$benzersizsayi4=uniqid(); //aşagıdaki kodla aynı işlevi yapıyor. fotoğrafı kaydederken benzersiz isim belirliyor.
	//$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");

	
	$duzenle=$db->prepare("UPDATE urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_baslangic_fiyati=:urun_baslangic_fiyati,
		urun_bitis_tarihi=:urun_bitis_tarihi,
		urun_bitis_saati=:urun_bitis_saati,
		urunfoto_resimyol=:urunfoto_resimyol
		WHERE urun_id={$_POST['urun_id']}");

	$update=$duzenle->execute(array(
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'urun_ad' => htmlspecialchars($_POST['urun_ad']),
		'urun_detay' => $_POST['urun_detay'],
		'urun_baslangic_fiyati' => htmlspecialchars($_POST['urun_baslangic_fiyati']),
		'urun_bitis_tarihi' => $_POST['urun_bitis_tarihi'],
		'urun_bitis_saati' => $_POST['urun_bitis_saati'],
		'urunfoto_resimyol' => $refimgyol
	));


	$urun_id=$_POST['urun_id'];

	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");  /*php'de dosya silmeye yarar.*/

		Header("Location:../../urun-duzenle.php?durum=ok&urun_id=$urun_id");

	} else {

		Header("Location:../../urun-duzenle.php?durum=hata&urun_id=$urun_id");

	}
}  else {  //fotoğraf yoksa işlemleri.


	$duzenle=$db->prepare("UPDATE urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_baslangic_fiyati=:urun_baslangic_fiyati,
		urun_bitis_tarihi=:urun_bitis_tarihi,
		urun_bitis_saati=:urun_bitis_saati
		WHERE urun_id={$_POST['urun_id']}");

	$update=$duzenle->execute(array(
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'urun_ad' => htmlspecialchars($_POST['urun_ad']),
		'urun_detay' => $_POST['urun_detay'],
		'urun_baslangic_fiyati' => htmlspecialchars($_POST['urun_baslangic_fiyati']),
		'urun_bitis_tarihi' => $_POST['urun_bitis_tarihi'],
		'urun_bitis_saati' => $_POST['urun_bitis_saati']
	));


	$urun_id=$_POST['urun_id'];

	if ($update) {

		Header("Location:../../urun-duzenle.php?durum=ok&urun_id=$urun_id");

	} else {

		Header("Location:../../urun-duzenle.php?durum=hata&urun_id=$urun_id");

	}

}

}



//Ürün Silme İşlemi
if ($_GET['urunsil']=="ok") {

	
	
	$sil=$db->prepare("DELETE from urun where urun_id=:urun_id");
	$kontrol=$sil->execute(array(
		'urun_id' => $_GET['urun_id']
	));

	if ($kontrol) {

		$resimsilunlink=$_GET['urunfoto_resimyol'];  //ürünü silerken resmi de silmemiz lazım.
		unlink("../../$resimsilunlink");

		Header("Location:../../urunlerim.php?durum=ok");

	} else {

		Header("Location:../../urunlerim.php?durum=hata");
	}

}






?>