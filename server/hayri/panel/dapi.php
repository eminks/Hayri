<?php
header("Access-Control-Allow-Origin: *"); //json olarak alg�lamas� i�in gerekli

include_once 'sistem.php'; //sistem.php dosyas�n� �a��r�yoruz

@$veri = htmlentities(strtolower($_GET['grd']), ENT_QUOTES, 'UTF-8'); //kullan�c�dan girdiyi ald�k

$query = $db->query("SELECT * FROM kelime", PDO::FETCH_ASSOC);  //"Kelime" tablosu i�eri�ini �a��r�yoruz
     $s=0; //s de�i�kenini s�f�rl�yoruz
     foreach( $query as $row ){  //Veri say�s� kadar d�ng� olu�turuyoruz
	 $kelime = $row['kelime'];   //Kelime de�i�kenine ilk veriyi atad�k
	 
    if(strcmp($veri,$kelime)==0){ //Verimiz ile kelime de�i�keni birebir mi kontrol ettik
     $karsi = $row['karsilik']; //Kelime kar��l�k gelen cevap "kar��" de�i�kenine atad�k
     cevap($karsi,$veri);  //Cevap fonksiyonuna veriyi i�lemesi i�in yollad�k
	 $s=2; //"s" de�i�kenini 2 de�erini atad�k
     }
	 }
	 if($s<1){ //S de�i�keni 1'in alt�ndaysa a�a��daki kodlar� �al��t�r�yoruz
      @$bget=file_get_contents("-site adresi-/hayri/panel/eklenti/havad.php?grd=".$veri); //Hava durumu eklentisi
      jsoncevir("deger",$bget); //Cevab�m�z� "jsoncevir" fonksiyonuna g�nderdik
	  @$cget=file_get_contents("-site adresi-/hayri/panel/eklenti/replik.php?grd=".$veri); //Replik eklentisi
      jsoncevir("deger",$cget);//Cevab�m�z� "jsoncevir" fonksiyonuna g�nderdik
	   @$eget=file_get_contents("-site adresi-/hayri/panel/eklenti/temel.php?grd=".$veri);  // Temel eklentisi
      jsoncevir("deger",$eget);//Cevab�m�z� "jsoncevir" fonksiyonuna g�nderdik
	 }
		 


?>
