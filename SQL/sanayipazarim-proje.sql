-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Ağu 2021, 11:43:32
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sanayipazarim-proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_logo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_description` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_author` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_gsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_facebook` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_twitter` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_youtube` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_bakim` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ayar_id`, `ayar_logo`, `ayar_title`, `ayar_description`, `ayar_keywords`, `ayar_author`, `ayar_tel`, `ayar_gsm`, `ayar_mail`, `ayar_facebook`, `ayar_twitter`, `ayar_youtube`, `ayar_bakim`) VALUES
(0, 'dimg/31966logom3.png', 'Sanayi Pazarı', 'Aydın Yağız Sanayi Web', 'site,blog,eticaret,sanayi', '@ 2017 Aydın Yağız', '0530 000 00 00', '0800 800 80 80', 'aydinyagiz002@gmail.com', 'https://tr-tr.facebook.com/', 'https://www.twitter.com', 'https://www.youtube.com', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kategori_seourl` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kategori_sira` int(2) NOT NULL,
  `kategori_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_ad`, `kategori_seourl`, `kategori_sira`, `kategori_durum`) VALUES
(10, 'Antistatik, ESD Ürünler', 'antistatik-esd-urunler', 1, '1'),
(11, 'Lehimler ve Sarf Malzemeleri', 'lehimler-ve-sarf-malzemeleri', 2, '1'),
(12, 'Test Ölçü Aletleri ', 'test-olcu-aletleri', 3, '1'),
(13, 'El Aletleri', 'el-aletleri', 4, '1'),
(14, ' İyonizerler', 'iyonizerler', 5, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_zaman` datetime NOT NULL DEFAULT current_timestamp(),
  `kullanici_resim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_mail` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_gsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_password` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adsoyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_unvan` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_yetki` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_durum` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `kullanici_zaman`, `kullanici_resim`, `kullanici_ad`, `kullanici_soyad`, `kullanici_mail`, `kullanici_gsm`, `kullanici_password`, `kullanici_adsoyad`, `kullanici_unvan`, `kullanici_yetki`, `kullanici_durum`) VALUES
(1, '2020-10-06 23:23:34', '', 'Admin', 'YAĞIZ', 'aydinyagiz02@gmail.com', '05555555555', 'e10adc3949ba59abbe56e057f20f883e', 'Aydın Yağızz', 'admin', '5', 1),
(4, '2020-10-20 21:18:32', '', 'Root', 'Yağız', 'root@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'aydın ', '', '1', 1),
(9, '2020-10-31 22:33:12', '', 'Kullanıcı', 'Yağız', 'aydin@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'aydın ', '', '1', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `urun_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `urun_zaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `urunfoto_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urun_ad` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urun_seourl` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urun_detay` text COLLATE utf8_turkish_ci NOT NULL,
  `urun_fiyat` float(9,2) NOT NULL,
  `urun_baslangic_fiyati` float(9,2) NOT NULL,
  `urun_bitis_tarihi` date DEFAULT NULL,
  `urun_bitis_saati` time NOT NULL,
  `teklif_veren_kullanici_id` int(11) NOT NULL,
  `urun_stok` int(11) NOT NULL,
  `urun_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `urun_onecikar` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`urun_id`, `kullanici_id`, `kategori_id`, `urun_zaman`, `urunfoto_resimyol`, `urun_ad`, `urun_seourl`, `urun_detay`, `urun_fiyat`, `urun_baslangic_fiyati`, `urun_bitis_tarihi`, `urun_bitis_saati`, `teklif_veren_kullanici_id`, `urun_stok`, `urun_durum`, `urun_onecikar`) VALUES
(61, 1, 10, '2021-08-17 10:12:16', 'dimg/urunfoto/611b8b8046181.jpg', '100x150mm Metalize Poşet', '', '<p>Antistatik ESD Metalize Poşet. Paket halinde satılır ve bir pakkette 100 adet vardır.</p>\r\n\r\n<p>Standartlara uygundur. İtalya menşeilidir ve olduk&ccedil;a kaliteli &uuml;r&uuml;nd&uuml;r.</p>\r\n\r\n<p>Boyutları: 100x150mm</p>\r\n\r\n<p>Kalınlık: 78&mu;m</p>\r\n\r\n<p>Şeffaflık: %40</p>\r\n\r\n<p>İ&ccedil; Y&uuml;zey Direnci (Polietilen): &lt;1011&nbsp;&Omega;</p>\r\n\r\n<p>Ara Tabaka Y&uuml;zey Direnci (Metal): &lt;102&nbsp;&Omega;</p>\r\n\r\n<p>Dış Y&uuml;zey Direnci (Polyester): &lt;1011&nbsp;&Omega;</p>\r\n', 110.00, 104.00, '2021-08-31', '00:00:00', 4, 0, '0', '1'),
(62, 1, 11, '2021-08-17 10:15:21', 'dimg/urunfoto/611b8c391d50a.jpg', 'SACX0307 ULL Kurşunsuz Çubuk Lehim', '', '<p>Alpha SACX0307 ULL Kurşunsuz &Ccedil;ubuk Lehim</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sipariş Vermeden &Ouml;nce L&uuml;tfen Stok Bilgisi Alınız</p>\r\n\r\n<p>Kurşunsuz lehim ile yapılan &uuml;retimler her zaman zor bir proses olmuştur. Alpha Vaculoy ULL kurşunsuz &ccedil;ubuk lehimler ile bu zorlukların &ouml;n&uuml;ne ge&ccedil;meniz m&uuml;mk&uuml;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ROHS standartlarının &ouml;tesinde, &ccedil;ok daha d&uuml;ş&uuml;k kurşun oranı ile sağlık standartlarına uygundur. Y&uuml;ksek saflık değerleri ve vakum altında &uuml;retilmesi sayesinde d&uuml;ş&uuml;k c&uuml;ruf oluşumu sağlar. İ&ccedil;eriğindeki elementler sayesinde delik i&ccedil;i doldurma ve lehim pedlerine yayılma konusunda rakiplerinde &ccedil;ok daha iyi performans g&ouml;sterir.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ALAŞIM</p>\r\n\r\n<p>&Ouml;zellikler</p>\r\n\r\n<p>SAC305</p>\r\n\r\n<p>SACX 0307</p>\r\n\r\n<p>SnCX Plus</p>\r\n\r\n<p>Kalay (Sn)</p>\r\n\r\n<p>%96,5</p>\r\n\r\n<p>%99,0</p>\r\n\r\n<p>%99,3</p>\r\n\r\n<p>G&uuml;m&uuml;ş (Ag)</p>\r\n\r\n<p>%3,0</p>\r\n\r\n<p>%0,3</p>\r\n\r\n<p>%0,0</p>\r\n\r\n<p>Bakır (Cu)</p>\r\n\r\n<p>%0,5</p>\r\n\r\n<p>%0,7</p>\r\n\r\n<p>%0,7</p>\r\n\r\n<p>Erime Noktası&nbsp;(oC)</p>\r\n\r\n<p>217-219</p>\r\n\r\n<p>220 - 228</p>\r\n\r\n<p>220 - 229</p>\r\n\r\n<p>Yoğunluk (g/cc)</p>\r\n\r\n<p>7.37</p>\r\n\r\n<p>7.33</p>\r\n\r\n<p>7.30</p>\r\n\r\n<p>Sertlik (HV)</p>\r\n\r\n<p>14.1</p>\r\n\r\n<p>14.1</p>\r\n\r\n<p>9.4</p>\r\n\r\n<p>Tavsiye Edilen Pota Sıcaklığı&nbsp;(oC)</p>\r\n\r\n<p>250-265</p>\r\n\r\n<p>255-265</p>\r\n\r\n<p>255-270</p>\r\n\r\n<p>&nbsp;</p>\r\n', 0.00, 590.00, '2021-08-31', '23:00:00', 0, 0, '0', '1'),
(63, 1, 12, '2021-08-17 10:17:34', 'dimg/urunfoto/611b8cbec214f.jpg', 'Hikmicro E1L El Tipi Termal Kamera', '', '<p>Hikmicro&nbsp;E1L El Tipi Termal Kamera</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Fiyat bilgisi i&ccedil;in bizimle iletişime ge&ccedil;ebilirsiniz.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hikmicro E1L Termal Kamera, termal (sıcaklık) &ouml;l&ccedil;&uuml;mleri i&ccedil;in tasarlanmış, giriş seviyesi bir el tipi termal kameradır. Kaliteli g&ouml;r&uuml;nt&uuml;s&uuml; sayesinde &ouml;l&ccedil;&uuml;mler yaparak problemleri hızlı bir şekilde tespit edebilir.</p>\r\n\r\n<p>T&uuml;rk&ccedil;e men&uuml; sayesinde kolay kullanım sağlar ve 8 saate kadar uzun bir kullanım s&uuml;resi sunar.</p>\r\n\r\n<p>&Uuml;cretsiz bilgisayar yazılımı sayesinde kaydedilen g&ouml;rsellerin analizini yapabilir ve rapor oluşturabilirsiniz.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&Ouml;ne &Ccedil;ıkan &Ouml;zellikleri:</p>\r\n\r\n<p>Termal &ccedil;&ouml;z&uuml;n&uuml;rl&uuml;k: 160 x 120 (19 200 piksel)</p>\r\n\r\n<p>Olduk&ccedil;a hassas olan HIKMICRO VOx dedekt&ouml;r&uuml; (NETD &lt;40 mK) sayesinde, belirgin bir termal g&ouml;r&uuml;ş sağlar.</p>\r\n\r\n<p>Geniş sıcaklık &ouml;l&ccedil;&uuml;m aralığı: -20&deg;C - 550&deg;C (Lazer ile hizalama &ouml;zelliği)</p>\r\n\r\n<p>25Hz g&ouml;r&uuml;nt&uuml; frekansı</p>\r\n\r\n<p>Su ve toza karşı IP54 korumaı olup, d&uuml;şme testi y&uuml;kseliği 2 metredir</p>\r\n\r\n<p>Olduk&ccedil;a hafif tasarım 350gr</p>\r\n\r\n<p>8 saate kadar s&uuml;rekli kullanım imkanı</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Teknik &Ouml;zellikleri:</p>\r\n\r\n<p>Termal &ccedil;&ouml;z&uuml;n&uuml;rl&uuml;k: 160 &times; 120</p>\r\n\r\n<p>Piksel aralığı: 17 &mu;m</p>\r\n\r\n<p>Spektral aralığı: 8 - 14 &mu;m</p>\r\n\r\n<p>Sıcaklık aralığı: -20 &deg;C ile 550 &deg;C (-4 &deg;F ile 1022 &deg;F)</p>\r\n\r\n<p>Doğruluk: En fazla (&plusmn;2&deg;C/3.6&deg;F, &plusmn;2%)</p>\r\n\r\n<p>G&ouml;r&uuml;ş alanı (FOV): 37.2&deg; &times; 50&deg;</p>\r\n\r\n<p>G&ouml;r&uuml;nt&uuml; hızı (Frekansı) : 25 Hz</p>\r\n\r\n<p>NETD: &lt; 40 mK</p>\r\n\r\n<p>Odaklama: Sabit</p>\r\n\r\n<p>IFOV(mrad): 5.48 mrad</p>\r\n\r\n<p>Diyafram a&ccedil;ıklığı: F 1.1</p>\r\n\r\n<p>Ekran: 320 &times; 240 &ccedil;&ouml;z&uuml;n&uuml;rl&uuml;kl&uuml;, 2.4&rsquo;&rsquo; LCD</p>\r\n\r\n<p>Renk paleti: Beyaz sıcak, Siyah sıcak, G&ouml;kkuşağı, Demirkuşağı</p>\r\n\r\n<p>&Ouml;l&ccedil;&uuml;m &ouml;n ayarları: Merkez nokta, Sıcak nokta, Soğuk nokta, Kapalı</p>\r\n\r\n<p>Lazer ışığı: Var (Class II)</p>\r\n\r\n<p>Koruma sınıfı: IP54</p>\r\n\r\n<p>D&uuml;şme testi: 2 metre</p>\r\n\r\n<p>Aray&uuml;z: Micro USB</p>\r\n\r\n<p>Ağırlık: 350 g. (yaklaşık)</p>\r\n\r\n<p>Boyutları: 196 mm &times; 117 mm &times; 59 mm</p>\r\n\r\n<p>Hafıza: &Ccedil;ıkartılabilir Micro SD (8 GB) - 150,000 fotoğraf</p>\r\n\r\n<p>Pil: Şarjedilebilir Li-ion (3.7V)</p>\r\n\r\n<p>Pil &ouml;mr&uuml;: S&uuml;rekli &ccedil;alışmada 8 saate kadar</p>\r\n', 50.00, 40.00, '2021-08-23', '06:56:00', 4, 0, '0', '1'),
(64, 1, 12, '2021-08-17 10:18:54', 'dimg/urunfoto/611b8d0e72a34.jpg', 'BS-100W Video Boroskop', '', '<p>CEM BS-100W Video Boroskop&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sipariş Vermeden &Ouml;nce L&uuml;tfen Stok Bilgisi Alınız</p>\r\n\r\n<p>Ger&ccedil;ek zamanlı video g&ouml;r&uuml;nt&uuml;leme desteği&nbsp;</p>\r\n\r\n<p>Tv &ccedil;evre birimleri (başka cihazlardaki işlemler i&ccedil;in)</p>\r\n\r\n<p>Karanlıkta g&ouml;z&uuml;kmesi i&ccedil;in ekranda Led ışıklandırma</p>\r\n\r\n<p>1800mAh batarya, usb şarj desteği&nbsp;</p>\r\n\r\n<p>Standby &ouml;zelliği (pil &ouml;mr&uuml; i&ccedil;in)</p>\r\n\r\n<p>Ekrandaki g&ouml;r&uuml;nt&uuml;y&uuml; 180 derece d&ouml;nd&uuml;rme desteği&nbsp;</p>\r\n\r\n<p>Esnek ve su ge&ccedil;irmeyen kamera</p>\r\n\r\n<p>3.0&#39;&#39; (7.60cm) LCD ekran&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>LCD Piksel adedi: 960x240</p>\r\n\r\n<p>Maximum FPS (saniye başına yenilenen g&ouml;r&uuml;nt&uuml;): 30FPS/S</p>\r\n\r\n<p>Kamera Boyun Uzunluğu: 1m(39&quot;)</p>\r\n\r\n<p>Kamera &Ccedil;apı: 17mm(0.66&quot;)</p>\r\n\r\n<p>G&ouml;sterme uzaklığı: 5cm to 15cm</p>\r\n\r\n<p>G&ouml;sterme a&ccedil;ısı: 68&deg;</p>\r\n\r\n<p>&Ccedil;alışma Voltajı: Li Battery 3.7V/1800mA</p>\r\n\r\n<p>TV-OUT: PAL/NTSC sistem&nbsp;</p>\r\n', 0.00, 650.00, '2021-08-22', '00:00:00', 0, 0, '0', '1'),
(65, 1, 12, '2021-08-17 10:19:51', 'dimg/urunfoto/611b8d475e090.png', 'T-10 Termal Kamera (Telefon için)', '', '<p>CEM T-10 Termal Kamera (Telefon i&ccedil;in)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sipariş Vermeden &Ouml;nce L&uuml;tfen Stok Bilgisi Alınız</p>\r\n\r\n<p>Akıllı termal kamera; micro usb veya type C ile android telefonlara takılabilir. Ekstra şarj edilmesi gerekmez g&uuml;c&uuml;n&uuml; telefondan alır. Ekstra depolama alanı gerekmez. Sadece telefona takıp uygulamasını indirip kullanmaya başlayabilirsiniz. Uygulamanın adı smart thermview&#39;dır ve bu uygulama telefonu akıllı bir termal kameraya cevirir.&nbsp;</p>\r\n\r\n<p>Uygulama; canlı analiz, renk paleti değişimi, pdf rapor hazırlama, kayıtlı fotografların analizi gibi pek &ccedil;ok &ouml;zellik kullanmanızı sağlar.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>T&uuml;m android telefonlara takılabilir</p>\r\n\r\n<p>206 x 156px IR &ccedil;&ouml;z&uuml;n&uuml;rl&uuml;k</p>\r\n\r\n<p>9Hz ekran hızı&nbsp;</p>\r\n\r\n<p>-10&ordm;c ~ 330&ordm;c&nbsp;</p>\r\n\r\n<p>Android telefonları profesyonel termal kameraya &ccedil;evirir</p>\r\n\r\n<p>Profesyonel seviyede manuel focus sistemi vardır</p>\r\n\r\n<p>USB-C ve Micro USB bağlantı se&ccedil;enekleri vardır</p>\r\n\r\n<p>Analiz, raporlama ve paylaşım i&ccedil;in &uuml;cretsiz uygulaması bulunmaktadır&nbsp;</p>\r\n\r\n<p>Herhangi bir raporlama veya analiz i&ccedil;in bilgisayar gerektirmez.</p>\r\n\r\n<p>&nbsp;&nbsp;</p>\r\n', 3030.00, 3017.00, '2021-08-22', '00:00:00', 9, 0, '0', '1'),
(66, 1, 13, '2021-08-17 10:22:05', 'dimg/urunfoto/611b8dcd378a0.jpg', 'TRE-03NBD ESD\'li Yan Keski', '', '<p>TR 03 NBD ESD&#39;li Yan Keski&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ESD &ouml;zellikli Wetec marka yan keski.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Uzunluk&nbsp;&nbsp;&nbsp;&nbsp; Kalınlık&nbsp;&nbsp;&nbsp;&nbsp; Kesme&nbsp;&nbsp;&nbsp;&nbsp; Bakır Tel</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;G&uuml;c&uuml;&nbsp;</p>\r\n\r\n<p>138 mm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.5 mm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 Kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.30 mm&nbsp;</p>\r\n', 110.00, 90.00, '2021-08-24', '00:00:00', 9, 0, '0', '1'),
(67, 1, 13, '2021-08-17 10:23:26', 'dimg/urunfoto/611b8e1e995f4.jpg', '8PK-376FN Kablo Sıkma Pensesi', '8pk-376fn-kablo-sikma-pensesi', '<p>PROSKİT 8PK-376FN Kablo Sıkma Pensesi</p><p>&nbsp;</p><p>&nbsp;</p><p>Sipariş Vermeden &Ouml;nce L&uuml;tfen Stok Bilgisi Alınız</p><p>Profesyonel sıkıştırma pensesidir, 8P8C/RJ45, 6P2C/6P4C/6P6CRJ11/RJ12 mod&uuml;ler konnekt&ouml;r ve RJ22 4P2C ahize mod&uuml;ler konnekt&ouml;r&uuml; sıkma i&ccedil;in kullanılabilir.</p>', 0.00, 300.00, '2021-08-30', '00:00:00', 9, 0, '0', '1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`urun_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
