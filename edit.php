<?php
$db = new SQLite3('database.sqlite');

$id = $_GET['id'];
$result = $db->query("SELECT * FROM olahraga WHERE id = $id");

if (!$result) {
    echo "Error retrieving data: " . $db->lastErrorMsg();
    exit;
}

$row = $result->fetchArray(SQLITE3_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_olahraga = $_POST['jenis_olahraga'];
    $durasi = $_POST['durasi'];
    $tanggal = $_POST['tanggal'];
    

    $db->query("UPDATE olahraga SET jenis_olahraga = '$jenis_olahraga', durasi = '$durasi', tanggal = '$tanggal' WHERE id = $id");
    header('Location: index.php');
    exit; 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Olahraga</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Edit Catatan Olahraga</h1>
    <form method="POST" action="edit.php?id=<?= $id ?>">
        <input type="text" name="jenis_olahraga" value="<?= htmlspecialchars($row['jenis_olahraga']) ?>" autocomplete="off" required>
        <input type="number" name="durasi" value="<?= htmlspecialchars($row['durasi']) ?>" required>
        <input type="date" name="tanggal" value="<?= htmlspecialchars($row['tanggal']) ?>" required>
        <div>
            <button type="submit">Update</button>
            <a href="index.php"><button type="button" class="back-button">Kembali</button></a>
        </div>
    </form>
</div>

</body>
</html>
        