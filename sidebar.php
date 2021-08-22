


<div class="fox-sidebar">
    <div class="sidebar-item">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title"><a href="kategoriler.php">Kategoriler</a></h3>
            <ul class="sidebar-categories-list">


             <?php 

                //Belirli veriyi seçme işlemi
             $kategorisor=$db->prepare("SELECT * FROM kategori where kategori_durum=:durum order by kategori_sira ASC");
             $kategorisor->execute(array(
                'durum' => 1
            ));

            while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { 

                $kategori_id=$kategoricek['kategori_id'];
                


                ?>

                <li><a href="kategoriler-<?=seo($kategoricek['kategori_ad'])."-".$kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?><span>(



                    <?php 

                    //kaç tane ürünüm varsa onları saydırıyoruz.
                    $urunsay=$db->prepare("SELECT COUNT(kategori_id) as say FROM urun WHERE kategori_id=:id");
                    $urunsay->execute(array(
                        'id' => $kategori_id
                    ));

                    $saycek=$urunsay->fetch(PDO::FETCH_ASSOC);

                    echo $saycek['say'];

                     ?>

                )</span></a></li>

            <?php } ?>

        </ul>
    </div>
</div>

</div>
