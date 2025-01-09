<?php
$koneksi = mysqli_connect("localhost", "root", "", "sispo_ppdb");

if (mysqli_connect_errno()) {
	echo "koneksi gagal " . mysql_connect_error();
}


