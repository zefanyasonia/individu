<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Online</title>
 
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Daftar</a></li>
                    </ul>
            </div>
        </div>
    </nav>
    
    <div class="container" style="margin-top: 50px">
        <h1>Tulis Nama Pengunjung!</h1>
        <hr />
        
        <form class="form-horizontal" method="post" action="index.php">
            <div class="form-group">
                <label class="col-sm-2 control-label">NAMA LENGKAP</label>
                <div class="col-sm-6">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">EMAIL</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" placeholder="Email Anda" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">WEBSITE</label>
                <div class="col-sm-6">
                    <input type="url" name="website" class="form-control" placeholder="Website Anda">
                </div>
            </div>
			<div class="form-group">
                <label class="col-sm-2 control-label">JUDUL PESAN</label>
                <div class="col-sm-6">
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">SARAN</label>
                <div class="col-sm-6">
                    <textarea name="saran" class="form-control" placeholder="Saran Anda" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-8">
                    <input type="submit" name="submit" class="btn btn-primary" value="KIRIM PESAN">
                </div>
            </div>
        </form>
        
        <?php
        //definisikan variabel untuk tiap-tiap inputan
        $nama       = $koneksi->real_escape_string($_POST['nama']);
        $email      = $koneksi->real_escape_string($_POST['email']);
        $web        = $koneksi->real_escape_string($_POST['website']);
        $judul        = $koneksi->real_escape_string($_POST['judul']);
        $saran      = $koneksi->real_escape_string($_POST['saran']);
        $tanggal    = date('Y-m-d');
        
		//jika di klik tombol kirim saran menjalankan script di bawah ini
		if($_POST['submit']){
			$input = $koneksi->query("INSERT INTO bukutamu(tanggal,nama,email,website,judul,saran) VALUES('$tanggal','$nama','$email','$web','$judul','$saran')") or die($koneksi->error);
			if($input){
				echo '<div class="alert alert-success">Saran anda berhasil di simpan!</div>';
			}else{
				echo '<div class="alert alert-warning">Gagal menyimpan saran!</div>';
			}
		}
        ?>
		
		<hr />
		<h2>5 Data Pengunjung</h2>
		
		<?php
		//menampilkan 5 buku tamu terbaru
		$res = $koneksi->query("SELECT * FROM bukutamu ORDER BY id DESC LIMIT 5") or die($koneksi->error);
		
		if($res->num_rows){
			while($row = $res->fetch_assoc()){
				echo '
				<table class="table table-condensed table-striped">
					<tr>
						<th width="150">TANGGAL TULIS</th>
						<th width="10">:</th>
						<td>'.$row['tanggal'].'</td>
					</tr>
					<tr>
						<th width="150">NAMA LENGKAP</th>
						<th width="10">:</th>
						<td>'.$row['nama'].'</td>
					</tr>
					<tr>
						<th>EMAIL</th>
						<th>:</th>
						<td>'.$row['email'].'</td>
					</tr>
					<tr>
						<th>WEBSITE</th>
						<th>:</th>
						<td>'.$row['website'].'</td>
					</tr>
					<tr>
						<th>JUDUL PESAN</th>
						<th>:</th>
						<td>'.$row['judul'].'</td>
					</tr>
					<tr>
						<th>saran</th>
						<th>:</th>
						<td>'.$row['saran'].'</td>
					</tr>
				</table>
				';
			}
		}else{
			echo 'Belum ada data buku tamu';
		}
		
		?>
		<p><a class="btn btn-primary btn-sm" href="data.php">Lihat semua data</a></p>
    </div>    
 
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>