<?php
session_start();
//konek ke db
$konek = mysqli_connect("localhost", "root","","datapeminjaman");

if($konek){
    echo'';
}


//masukkan data peminjam baru
if(isset($_POST['tambahdata'])){
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jumlahpinjam = $_POST['jumlah'];
    $jumlahpinjam = str_replace(',', '', $jumlahpinjam);
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    $tambahpeminjam = mysqli_query($konek, "insert into datautama (nik, nama, jumlah, alamat, telp, keseluruhan, totalbayar) values('$nik','$nama','$jumlahpinjam','$alamat','$telp', '$jumlahpinjam', 0)");
    
    if($tambahpeminjam){
        $tariknamautktambahan = mysqli_query($konek, "select * from datautama where nama='$nama'");
        $tarikkkdulu = mysqli_fetch_array($tariknamautktambahan);
        $ambilidutama = $tarikkkdulu['idutama'];
        $tambahanpeminjam = mysqli_query($konek, "insert into datatambahan (idutama, jumlahtambahan, jumlahmenjadi, status) values('$ambilidutama', '$jumlahpinjam', '$jumlahpinjam', 'Belum Lunas')");
        if($tambahanpeminjam){
            header('location:index.php');
        } else {
            echo 'fail';
            header('location:index.php');
        }
    } else {
        echo 'fail';
        header('location:index.php');
    }
}

//masukkan data cicilan pada peminjaman yang membayar cicilan
if(isset($_POST['bayarcicil'])){
    $cicilanidutama = $_POST['cicilannya'];
    $jumlahcicil = $_POST['jumlahcicil'];
    $jumlahcicil = str_replace(',', '', $jumlahcicil);

    $cektagihan = mysqli_query($konek, "select * from datautama where idutama='$cicilanidutama'");
    $cektagihantambah = mysqli_query($konek, "select * FROM datatambahan where idutama='$cicilanidutama'");
    $takedatanya = mysqli_fetch_array($cektagihan);
    $tagihansekarang = $takedatanya['jumlah'];
    $totalpembayaransekarang = $takedatanya['totalbayar'];
    

    if($tagihansekarang>=$jumlahcicil){

        $tagihan_dikurang = $tagihansekarang-$jumlahcicil;
        $totalpembayaran = $jumlahcicil+$totalpembayaransekarang;

        while($tarikdatatambahan = mysqli_fetch_array($cektagihantambah)){
            $tagihantambah = $tarikdatatambahan['jumlahmenjadi'];
            $tagihannya = $tarikdatatambahan['jumlahtambahan'];
            $ambilidtambahan = $tarikdatatambahan['idtambahan'];
            $statusserver = $tarikdatatambahan['status'];
            if($statusserver =='Lunas'){
                $statustagihan = 'Lunas';
            } else {
                if($tagihannya<=$totalpembayaran){
                    
                    $statustagihan = 'Lunas';
                    $totalpembayaran = $totalpembayaran - $tagihannya;
                } else {
                    $statustagihan = 'Belum Lunas';
                }
            }
            $updatestatustagihan = mysqli_query($konek, "update datatambahan set status='$statustagihan' where idtambahan='$ambilidtambahan'");
        }

        if($tagihan_dikurang==0){
            $status = 'Lunas';
        } else {
            $status = 'Belum Lunas';
        }

        $cicilanmasuk = mysqli_query($konek, "insert into datamasuk (idutama, jumlahmasuk, sisacicilan, statuscicilan) values('$cicilanidutama','$jumlahcicil','$tagihan_dikurang','$status')");
        $update_cicil_tagihan = mysqli_query($konek, "update datautama set jumlah='$tagihan_dikurang', totalbayar='$totalpembayaran' where idutama='$cicilanidutama'");
        if($cicilanmasuk&&$update_cicil_tagihan){
            header('location:cicilan.php');
        } else {
            echo 'fail';
            header('location:cicilan.php');
        }

    } else {
        //bayarnya kebanyakan
        echo '
        <script>
            alert("Cicilan yang dibayar melebihi tagihan");
            window.location.href="cicilan.php";
        </script>
        ';
    }

    
    

}

//masukkan data tambahan pada peminjaman yang ada
if(isset($_POST['tambahpinjam'])){
    $tambahanidutama = $_POST['tambahannya'];
    $jumlahtambahan = $_POST['jumlahtambahan'];
    $jumlahtambahan = str_replace(',', '', $jumlahtambahan);

    if($jumlahtambahan>0){
        $cektagihan = mysqli_query($konek, "select * from datautama where idutama='$tambahanidutama'");
        $takedatanya = mysqli_fetch_array($cektagihan);

        $tagihansekarang = $takedatanya['jumlah'];
        $totalsemuanya = $takedatanya['keseluruhan'];
        $tagihan_ditambah = $tagihansekarang+$jumlahtambahan;
        $keseluruhanbaru = $totalsemuanya+$jumlahtambahan;

        $tambahpinjam = mysqli_query($konek, "insert into datatambahan (idutama, jumlahtambahan, jumlahmenjadi, status) values('$tambahanidutama','$jumlahtambahan','$tagihan_ditambah','Belum Lunas')");
        $update_tambah_tagihan = mysqli_query($konek, "update datautama set jumlah='$tagihan_ditambah', keseluruhan='$keseluruhanbaru' where idutama='$tambahanidutama'");
        if($tambahpinjam&&$update_tambah_tagihan){
            header('location:tambahan.php');
        } else {
            echo 'fail';
            header('location:detail.php');
        }
    } else {
        echo '
        <script>
            alert("isi tambahan harus lebih dari 0");
            window.location.href="tambahan.php";
        </script>
        ';

    }

}

//edit peminjaman
if(isset($_POST['editdata'])){
    $ide = $_POST['ide'];
    $nikedit = $_POST['nikedit'];
    $namaedit = $_POST['namaedit'];
    $jumlahpinjamedit = $_POST['jumlahedit'];
    $jumlahpinjamedit = str_replace(',','',$jumlahpinjamedit);
    $alamatedit = $_POST['alamatedit'];
    $telpedit = $_POST['telpedit'];
    $saatini = $_POST['jumlahsaatini'];
    $totalsaatini = $_POST['totalsaatini'];

    if($saatini<$jumlahpinjamedit){
        $selisihedit = $jumlahpinjamedit - $saatini;
        $hasiledit = $totalsaatini + $selisihedit;
    } else {
        $selisihedit = $saatini - $jumlahpinjamedit;
        $hasiledit = $totalsaatini - $selisihedit;
    }

    $editpeminjaman = mysqli_query($konek, "update datautama set nik='$nikedit', nama='$namaedit', keseluruhan='$hasiledit', jumlah='$jumlahpinjamedit', alamat='$alamatedit', telp='$telpedit' where idutama='$ide'");
    if($editpeminjaman){
        header('location:index.php');
    } else {
        echo 'fail';
        header('location:index.php');
    }
}

//hapus peminjam
if(isset($_POST['hapusdata'])){
    $idhapus = $_POST['idhapus'];

    $hapusdata = mysqli_query($konek, "delete from datautama where idutama='$idhapus'");
    $hapuscicilannya = mysqli_query($konek, "delete from datamasuk where idutama='$idhapus'");
    $hapustambahannya = mysqli_query($konek, "delete from datatambahan where idutama='$idhapus'");
    if($hapusdata&&$hapuscicilannya&&$hapustambahannya){
        header('location:index.php');
    } else {
        echo'gagal';
        header('location:index.php');
    }
}

//hapus cicilan
if(isset($_POST['deletecicilan'])){
    $idc = $_POST['idc'];
    $idus = $_POST['idus'];
    $jumlahmasuk = $_POST['jumlahmasuk'];

    $cektagihancicil = mysqli_query($konek, "select * from datautama where idutama='$idus'");
    $tagihannyacicil = mysqli_fetch_array($cektagihancicil);
    $tagihansekarang = $tagihannyacicil['jumlah'];

    $selisihcicilan = $tagihansekarang+$jumlahmasuk;
    $updatetagihancicil = mysqli_query($konek, "update datautama set jumlah='$selisihcicilan' where idutama='$idus'");
    $hapuscicilanupdate = mysqli_query($konek, "delete from datamasuk where idmasuk='$idc'");
    if($updatetagihancicil&&$hapuscicilanupdate){
        header('location:cicilan.php');
    } else {
        echo'gagal';
        header('location:cicilan.php');
    }
}

//hapus cicilan detail
if(isset($_POST['deletecicilandetail'])){
    $idc = $_POST['idc'];
    $idus = $_POST['idus'];
    $jumlahmasuk = $_POST['jumlahmasuk'];

    $idud = $_POST['iddetail'];
    $nama = $_POST['namadetail'];
    $ktp =$_POST['ktpdetail'];
    $telpon = $_POST['telpdetail'];
    $addr = $_POST['addrdetail'];
    $jumlahdetail = $_POST['jmldetail'];
    $sumdetail = $_POST['sumdetail'];

    $cektagihancicil = mysqli_query($konek, "select * from datautama where idutama='$idus'");
    $tagihannyacicil = mysqli_fetch_array($cektagihancicil);
    $tagihansekarang = $tagihannyacicil['jumlah'];

    $selisihcicilan = $tagihansekarang+$jumlahmasuk;
    $updatetagihancicil = mysqli_query($konek, "update datautama set jumlah='$selisihcicilan' where idutama='$idus'");
    $hapuscicilanupdate = mysqli_query($konek, "delete from datamasuk where idmasuk='$idc'");
    if($updatetagihancicil&&$hapuscicilanupdate){
        header('location:detail.php?iddetail='.$idud.'&namadetail='.$nama.'&ktpdetail='.$ktp.'&telpdetail='.$telpon.'&addrdetail='.$addr.'&jmldetail='.$selisihcicilan.'&sumdetail='.$sumdetail);

    } else {
        echo'gagal';
        header('location:detail.php?iddetail='.$idud.'&namadetail='.$nama.'&ktpdetail='.$ktp.'&telpdetail='.$telpon.'&addrdetail='.$addr.'&jmldetail='.$selisihcicilan.'&sumdetail='.$sumdetail);
    }
}

//hapus tambahan
if(isset($_POST['deletetambahan'])){
    $idc = $_POST['idc'];
    $idus = $_POST['idus'];
    $jumlahtambahan = $_POST['jumlahtambahan'];

    $cektagihancicil = mysqli_query($konek, "select * from datautama where idutama='$idus'");
    $tagihannyacicil = mysqli_fetch_array($cektagihancicil);
    $tagihansekarang = $tagihannyacicil['jumlah'];
    $keseluruhan = $tagihannyacicil['keseluruhan'];

    $selisihcicilan = $tagihansekarang-$jumlahtambahan;
    $keseluruhanhapus = $keseluruhan-$jumlahtambahan;
    $updatetagihancicil = mysqli_query($konek, "update datautama set jumlah='$selisihcicilan', keseluruhan='$keseluruhanhapus' where idutama='$idus'");
    $hapuscicilanupdate = mysqli_query($konek, "delete from datatambahan where idtambahan='$idc'");
    if($updatetagihancicil&&$hapuscicilanupdate){
        header('location:tambahan.php');
    } else {
        echo'gagal';
        header('location:tambahan.php');
    }
}

//hapus tambahan detail
if(isset($_POST['deletetambahandetail'])){
    $idc = $_POST['idc'];
    $idus = $_POST['idus'];
    $jumlahtambahan = $_POST['jumlahtambahan'];

    $idud = $_POST['iddetail'];
    $nama = $_POST['namadetail'];
    $ktp =$_POST['ktpdetail'];
    $telpon = $_POST['telpdetail'];
    $addr = $_POST['addrdetail'];
    $jumlahdetail = $_POST['jmldetail'];
    $sumdetail = $_POST['sumdetail'];

    $cektagihancicil = mysqli_query($konek, "select * from datautama where idutama='$idus'");
    $tagihannyacicil = mysqli_fetch_array($cektagihancicil);
    $tagihansekarang = $tagihannyacicil['jumlah'];
    $keseluruhan = $tagihannyacicil['keseluruhan'];

    $selisihcicilan = $tagihansekarang-$jumlahtambahan;
    $keseluruhanhapus = $keseluruhan-$jumlahtambahan;
    $updatetagihancicil = mysqli_query($konek, "update datautama set jumlah='$selisihcicilan', keseluruhan='$keseluruhanhapus' where idutama='$idus'");
    $hapuscicilanupdate = mysqli_query($konek, "delete from datatambahan where idtambahan='$idc'");
    if($updatetagihancicil&&$hapuscicilanupdate){
        header('location:detail.php?iddetail='.$idud.'&namadetail='.$nama.'&ktpdetail='.$ktp.'&telpdetail='.$telpon.'&addrdetail='.$addr.'&jmldetail='.$selisihcicilan.'&sumdetail='.$keseluruhanhapus);
    } else {
        echo'gagal';
        header('location:detail.php?iddetail='.$idud.'&namadetail='.$nama.'&ktpdetail='.$ktp.'&telpdetail='.$telpon.'&addrdetail='.$addr.'&jmldetail='.$selisihcicilan.'&sumdetail='.$keseluruhanhapus);
    }
}


?>