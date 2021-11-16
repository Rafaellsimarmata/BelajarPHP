<?php 

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location:login.php");
        exit;
    }

    require "functions.php";
    $buku = query("SELECT * FROM buku");

// // membuat pagination
//     $jumlahdataperhalaman = 3;
//     $jumlahdata = count(query("SELECT * FROM buku"));
//     $jumlahhalaman =  ($jumlahdata / $jumlahdataperhalaman);
//     $halamanaktif = (isset($_GET["halaman"])) ?$_GET["halaman"] : 1;
//     $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman ;

//     $buku = query("SELECT * FROM buku LIMIT $awaldata,$jumlahdataperhalaman");





// cek apakah tombol search sudah ditekan atau belum
if (isset($_POST ["cari"])){
    $buku = cari($_POST["keyword"]);
}



// mencari apakah ada error pada perintah query kita :)
// if (!$result){
//     echo mysqli_error ($link);
// }

// Ambul data (Fetch) mahasiswa dari objek result    
// ada 4 cara melakukannya :
//  mysqli_fetch_row();  => mengembalikan array numerik
    // $mhs = mysqli_fetch_row($result);
    // var_dump ($mhs);

// mysqli_fetch_assoc();  =>  mengembalikan array associative
    // $mhs = mysqli_fetch_assoc($result);
    // var_dump ($mhs);

// mysqli_fetch_array();  =>  menampilkan array dalam bentuk numerik dan associative namun menghasilkan data yang double
    // $mhs = mysqli_fetch_array($result);
    // var_dump ($mhs);

// mysqli_fetch_object();
    // $mhs = mysqli_fetch_object($result);
    // var_dump ($mhs->nama);

// menampilkan semua data pada tabel mahasiswa
    // while ($mhs = mysqli_fetch_assoc($result)){
    //     var_dump ($mhs);
    // }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Perpustakaan Bergeraklah!! </title>

    <style>
        .loader{
            width: 100px;
            position: absolute;
            z-index: -1;
            top: 108px;
            left: 155px;
            display: none;
        }

        @media print {
            .logout, .tambah, .aksi, .form-cari   {
                display: none;
            }
        }
        
    </style>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>

</head>
<body>

<a href="logout.php" class="logout"  > Log Out!  </a>   |  <a href=" cetak.php " target="_blank">  Print </a>
<h1> Daftar Buku </h1>  

<a href="tambah.php" class="tambah">
        <button> Tambah Buku </button>
</a>

<br> </br>

<form action="" method="post" >
        <input type="text" name="keyword" size="25" placeholder="Masukkan Keyword Pencarian.." autofocus autocomplete="off" id="keyword" class="form-cari" >
        <button type="submit" name="cari" id="tombol-cari"> Search </button>

        <img src="img/loader.gif" class="loader">
</form>


        
<br> </br>
<div id="container">
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>
                No 
            </th>
            <th>
                Nama Buku
            </th>
            <th>
                NRB 
            </th>
            <th>
                Gambar
            </th>
            <th>
                Jenis 
            </th>
            <th>
                Email
            </th>
            <th class="aksi">
                Aksi
            </th>
        </tr>

<?php $i = 1 ; ?>
<?php foreach($buku as $row): ?>
        <tr>
            <td>
                <?= $i  ?>
            </td>
            <td>
                <?= $row["nama"] ?>
            </td>
            <td>
                <?= $row["nrb"] ?>
            </td>
            <td>
               <img src="img/<?= $row["gambar"] ?> " width="50">
            </td>
            <td>
                <?= $row["jenis"] ?>
            </td>
            <td>
                <?= $row["email"] ?>
            </td>
            <td class="aksi">
                <a href="edit.php?id=<?= $row["id"] ?>"> Edit </a> <br>
                <a href="hapus.php?id=<?= $row["id"] ?>" onclick = "return confirm ('Apakah anda yakin ingin menghapus ?');"> Remove </a>
            </td>
        </tr>
<?php $i++; ?>
<?php endforeach; ?>
    
    </table>
</div>

    
    


    
</body>
</html>