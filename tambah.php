<?php
$db = new SQLite3('database.sqlite');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_olahraga = $_POST['jenis_olahraga'];
    $durasi = $_POST['durasi'];
    $tanggal = $_POST['tanggal'];

    $db->query("INSERT INTO olahraga (jenis_olahraga, durasi, tanggal) VALUES ('$jenis_olahraga', '$durasi', '$tanggal')");
    header('Location: index.php');
}
?>