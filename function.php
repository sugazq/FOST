<?php 
// $koneksi = mysqli_connect("localhost","root","","pengaduan_masyarakat");

// // Check connection
// if (mysqli_connect_errno()){
// 	echo "Koneksi database gagal : " . mysqli_connect_error();
// }
function query($query) {
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$row = [];
	while( $row = mysqli_fetch_assoc($result)) {
		$row[] = $row;
	}
	return $row;
}

function cari($key) {
	$query = "SELECT * FROM pengaduan
					WHERE
				nama LIKE '%$key%'
				";
			return query($query);
}
?>