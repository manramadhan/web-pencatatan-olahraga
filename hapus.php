<?php
$db = new SQLite3('database.sqlite');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $db->query("DELETE FROM olahraga WHERE id = $id");

    $results = $db->query("SELECT * FROM olahraga ORDER BY id ASC");

    $newNumber = 1;
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $currentId = $row['id'];
        $db->exec("UPDATE olahraga SET id = $newNumber WHERE id = $currentId");
        $newNumber++; 
    }

    header('Location: index.php');
} else {
    echo "ID tidak valid.";
}
?>
