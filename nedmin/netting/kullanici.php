<?php 	

ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';


if (isset($_POST['kullanicikaydet'])) {



	/*$kullanici_ad=htmlspecialchars($_POST['kullanici_ad']);   htmlspecialchars; gönderilen postlar içindeki zararlı kodları temizler.*/  /*strip_tags; ise script kodlarını temizlemeye yarar. script kelimelerini koddan çıkarır.*/
	$kullanici_mail=htmlspecialchars(trim($_POST['kullanici_mail'])); 

	$kullanici_passwordone=htmlspecialchars(trim($_POST['kullanici_passwordone']));
	$kullanici_passwordtwo=htmlspecialchars(trim($_POST['kullanici_passwordtwo']));



	if ($kullanici_passwordone==$kullanici_passwordtwo) {

		
		if (strlen($kullanici_passwordone)>=6) {  /*strlen ; fonksiyonu karakter sayısını kontrol eder.*/
			

			//kullanıcı bizde kayıtlı mı sorgusu
			// Başlangıç 

			$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
			));

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();


			if ($say==0) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_ad=:kullanici_ad,
					kullanici_soyad=:kullanici_soyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
					'kullanici_soyad' =>htmlspecialchars($_POST['kullanici_soyad']),
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_yetki' => $kullanici_yetki
				));

				if ($insert) {


					header("Location:../../login?durum=kayitok");


				} else {


					header("Location:../../register.php?durum=basarisiz");
				}

			} else {

				header("Location:../../register?durum=mukerrerkayit");

			}

		// Bitiş

		}
		else {

			header("Location:../../register.php?durum=eksiksifre");
		}

	} 
	else {

		header("Location:../../register.php?durum=farklisifre");

	}

}




if (isset($_POST['kullanicigiris'])) {

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=md5(htmlspecialchars($_POST['kullanici_password']));




	$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail  and kullanici_password=:password");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password	
	));


	$say = $kullanicisor->rowCount();

	if ($say == 1) {
		$_SESSION['userkullanici_mail']=$kullanici_mail;
		

		header("Location:../../index.php?durum=girisbasarili");
		exit;

	} else {
		header("Location:../../login?durum=basarisizgiris");
	}
	
}







?>