<?php
$koneksi = new mysqli("localhost", "root", "", "kas_dodol_satibi");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
