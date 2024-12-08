warning: in the working copy of 'index.php', LF will be replaced by CRLF the next time Git touches it
[1mdiff --git a/admin/cetak.php b/admin/cetak.php[m
[1mdeleted file mode 100644[m
[1mindex 156829f..0000000[m
[1m--- a/admin/cetak.php[m
[1m+++ /dev/null[m
[36m@@ -1,31 +0,0 @@[m
[31m-<h2 style="text-align: center;">Laporan Layanan Pengaduan Masyarakat</h2>[m
[31m-<table border="2" style="width: 100%; height: 10%;">[m
[31m-	<tr style="text-align: center;">[m
[31m-		<td>No</td>[m
[31m-		<td>NIK Pelapor</td>[m
[31m-		<td>Nama Pelapor</td>[m
[31m-		<td>Nama Petugas</td>[m
[31m-		<td>Tanggal Masuk</td>[m
[31m-		<td>Tanggal Ditanggapi</td>[m
[31m-		<td>Status</td>[m
[31m-	</tr>[m
[31m-	<?php [m
[31m-		include '../conn/koneksi.php';[m
[31m-		$no=1;[m
[31m-		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tgl_pengaduan DESC");[m
[31m-		while ($r=mysqli_fetch_assoc($query)) { ?>[m
[31m-		<tr>[m
[31m-			<td><?php echo $no++; ?></td>[m
[31m-			<td><?php echo $r['nik']; ?></td>[m
[31m-			<td><?php echo $r['nama']; ?></td>[m
[31m-			<td><?php echo $r['nama_petugas']; ?></td>[m
[31m-			<td><?php echo $r['tgl_pengaduan']; ?></td>[m
[31m-			<td><?php echo $r['tgl_tanggapan']; ?></td>[m
[31m-			<td><?php echo $r['status']; ?></td>[m
[31m-		</tr>[m
[31m-	<?php	}[m
[31m-	 ?>[m
[31m-</table>[m
[31m-<script type="text/javascript">[m
[31m-	window.print();[m
[31m-</script>[m
\ No newline at end of file[m
[1mdiff --git a/admin/dashboard.php b/admin/dashboard.php[m
[1mdeleted file mode 100644[m
[1mindex e08e53c..0000000[m
[1m--- a/admin/dashboard.php[m
[1m+++ /dev/null[m
[36m@@ -1,36 +0,0 @@[m
[31m-[m
[31m-<h3 class="orange-text">Dahsboard</h3>[m
[31m-[m
[31m-	<div class="row">[m
[31m-		<div class="col s4">[m
[31m-		  <div class="card red">[m
[31m-		    <div class="card-content white-text">[m
[31m-			<?php [m
[31m-				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan");[m
[31m-				$jlmmember = mysqli_num_rows($query);[m
[31m-				if($jlmmember<1){[m
[31m-					$jlmmember=0;[m
[31m-				}[m
[31m-			 ?>[m
[31m-		      <span class="card-title">Laporan Masuk<b class="right"><?php echo $jlmmember; ?></b></span>[m
[31m-		      <p></p>[m
[31m-		    </div>[m
[31m-		  </div>[m
[31m-		</div>	[m
[31m-[m
[31m-		<div class="col s4">[m
[31m-		    <div class="card teal">[m
[31m-		    <div class="card-content white-text">[m
[31m-			<?php [m
[31m-				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='selesai'");[m
[31m-				$jlmmember = mysqli_num_rows($query);[m
[31m-				if($jlmmember<1){[m
[31m-					$jlmmember=0;[m
[31m-				}[m
[31m-			 ?>[m
[31m-		      <span class="card-title">Laporan Selesai <b class="right"><?php echo $jlmmember; ?></b></span>[m
[31m-		      <p></p>[m
[31m-		    </div>[m
[31m-		  </div>[m
[31m-		</div>[m
[31m-	</div>[m
\ No newline at end of file[m
[1mdiff --git a/admin/index.php b/admin/index.php[m
[1mdeleted file mode 100644[m
[1mindex 2d0bc84..0000000[m
[1m--- a/admin/index.php[m
[1m+++ /dev/null[m
[36m@@ -1,175 +0,0 @@[m
[31m-<?php [m
[31m-	session_start();[m
[31m-	include '../conn/koneksi.php';[m
[31m-	if(!isset($_SESSION['username'])){[m
[31m-		header('location:../index.php');[m
[31m-	}[m
[31m-	elseif($_SESSION['data']['level'] != "admin"){[m
[31m-		header('location:../index.php');[m
[31m-	}[m
[31m- ?>[m
[31m-  <!DOCTYPE html>[m
[31m-  <html>[m
[31m-    <head>[m
[31m-    	<title>Aplikasi Pengaduan masyarakat</title>[m
[31m-      <!--Import Google Icon Font-->[m
[31m-      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">[m
[31m-      <!--Import materialize.css-->[m
[31m-      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>[m
[31m-[m
[31m-      <!-- Compiled and minified CSS -->[m
[31m-      <link rel="stylesheet" h