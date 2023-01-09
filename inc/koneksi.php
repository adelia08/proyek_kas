<?php
$koneksi = new mysqli("localhost", "root", "", "satibi");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
