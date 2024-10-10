<?php
$db = new SQLite3('database.sqlite');

if (!$db) {
    echo("Koneksi ke database gagal: " . $db->lastErrorMsg());
}

$query = "CREATE TABLE IF NOT EXISTS olahraga (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    jenis_olahraga TEXT NOT NULL,
    durasi INTEGER NOT NULL,
    tanggal TEXT NOT NULL
)";

if ($db->query($query)) {
    echo "Tabel 'olahraga' berhasil dibuat atau sudah ada.";
} else {
    echo "Error saat membuat tabel: " . $db->lastErrorMsg();
}

$db->close();
?>
