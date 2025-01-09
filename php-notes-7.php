<html>
<head>
    <meta charset="UTF-8">
    <title>DOSYA YÜKLEME</title>
</head>
<body>
   <form name="form" action="" method="post" enctype="multipart/form-data">
    <h3>DOSYA YÜKLEME İŞLEMİ</h3>
    Dosya Seçiniz:<input type="file" name="dosya" size=40>
    <input type="submit" value="Gönder">       
   </form>
</body>
</html>
<?php
$dosya=$_FILES["dosya"]["tmp_name"];
$isim=$_FILES["dosya"]["name"];
$boyut=$_FILES["dosya"]["size"];
$max_boyut=1024*1024*3;
$tipler=$_FILES["dosya"]["type"];
$uzanti=explode("/",$tipler);
$gecerli_tipler=array(
"image/png",
"image/gif",
"image/jpg",
"image/jpeg");
if($_FILES["dosya"]["error"]==0)
{
    if(in_array($tipler,$gecerli_tipler))
    {
        if($boyut>$max_boyut)
        {
            echo "Yüklenen dosya boyutu en fazla 3 Mb olabilir";
        }
        else
        {
            if(move_uploaded_file($dosya,$isim))
            {
                echo "Dosya Yüklendi";
            }
            else
            {
                echo "Dosya Yüklenemedi";
            }
        }
            
    }
    else
    {
        echo "Sadece PNG,JPG,GİF ve JPEG dosyaları yüklenebilir.";
    }
}
else
{
    echo "Bir sorun oluştu";
}





<html>/

<head>
    <meta charset="UTF-8">
    <title>EKLE SİL GÜNCELLE</title>
</head>

<body>
    <form name="form" action="" method="post">
        <table>
            <tr>
                <td>TC NUMARASI:</td>
                <td><input type="text" name="tc"></td>
            </tr>
            <tr>
                <td>ADI:</td>
                <td><input type="text" name="ad"></td>
            </tr>
            <tr>
                <td>SOYADI:</td>
                <td><input type="text" name="soyad"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="kaydet" value="KAYDET">
                    <input type="submit" name="guncelle" value="GÜNCELLE">
                    <input type="submit" name="sil" value="SİL">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>


$db=new PDO("mysql:host=localhost; dbname=ornek2; charset=utf8","root","");
if(isset($_POST["kaydet"]))
{
    $ktc=$_POST["tc"];
    $kadi=$_POST["ad"];
    $ksoyad=$_POST["soyad"];
    if($db)
    {
        echo "Veritabanı bağlantısı gerçekleşti"."<br>";
        $kaydet=$db->exec("INSERT INTO ogrencidurum(ad,soyad,tc) VALUES ('$kadi','$ksoyad','$ktc')");
        if($kaydet)
        {
            echo "Kayıt ekleme başarılı";
        }
        else
        {
            echo "Kayıt ekleme başarısız";
        }
    }
}

if(isset($_POST["guncelle"]))
{
    $ktc=$_POST["tc"];
    $kadi=$_POST["ad"];
    $ksoyad=$_POST["soyad"];
    if($db)
    {
        echo "Veritabanı bağlantısı gerçekleşti"."<br>";
        $guncelle=$db->exec("UPDATE ogrencidurum SET ad='$kadi',soyad='$ksoyad' WHERE tc='$ktc'");
        if($guncelle)
        {
            echo "Güncelleme başarılı";
        }
        else
        {
            echo "Güncelleme başarısız";
        }
    }
}

?>