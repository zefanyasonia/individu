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
                    <li class="active"><a href="data.php">Data Pengunjung</a></li>
				</ul>
            </div>
        </div>
    </nav>
    
    <div class="container" style="margin-top: 50px">
        <center><h1>Tulis Daftar Pengunjung!</h1></center>
        <hr />
        <?php
		//menampilkan data buku tamu
		$res = $koneksi->query("SELECT * FROM bukutamu ORDER BY id DESC") or die($koneksi->error);
		
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
						<th>SARAN</th>
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
    </div>    
 
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>