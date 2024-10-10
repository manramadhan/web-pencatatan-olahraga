<?php
$db = new SQLite3('database.sqlite');

if (!$db) {
    echo "Koneksi ke database gagal: " . $db->lastErrorMsg();
}

$results = $db->query("SELECT * FROM olahraga");

if (!$results) {
    echo "Query Error: " . $db->lastErrorMsg();
}

$message = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_olahraga = $_POST['jenis_olahraga'];
    $durasi = $_POST['durasi'];
    $tanggal = $_POST['tanggal'];


    $query = "INSERT INTO olahraga (jenis_olahraga, durasi, tanggal) VALUES ('$jenis_olahraga', $durasi, '$tanggal')";
    $result = $db->query($query); 

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        $message = "Error saat menyimpan data: " . $db->lastErrorMsg();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatat Rutin Olahraga</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../pencatatan_rutin_olahraga/style.css">   
</head>
<body>

<div class="container">
    <h1>Pencatat Rutin Olahraga</h1>

    <?php if ($message): ?>
        <script>alert("<?php echo htmlspecialchars($message); ?>");</script>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-row">
            <input type="text" name="jenis_olahraga" placeholder="Jenis Olahraga" autocomplete="off" required>
        </div>
        <div class="form-row">
            <input type="number" name="durasi" placeholder="Durasi (Menit)" required>
        </div>
        <div class="form-row">
            <input type="date" name="tanggal" required>
        </div>
        <input type="submit" value="Catat Olahraga">
    </form>

    <table>
    <tr>
        <th>No</th>
        <th>Jenis Olahraga</th>
        <th>Durasi (Menit)</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    <?php
    $number = 1; 
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($number) . "</td>"; // Tampilkan nomor urut
        echo "<td>" . htmlspecialchars($row['jenis_olahraga']) . "</td>";
        echo "<td>" . htmlspecialchars($row['durasi']) . "</td>";
        echo "<td>" . htmlspecialchars(date('d-m-Y', strtotime($row['tanggal']))) . "</td>";
        echo "<td>
                <a class='button' href='edit.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a> 
                <a class='button' href='hapus.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
              </td>";
        echo "</tr>";
        $number++; 
    }
    ?>
    </table>
</div>
</body>
</html>
