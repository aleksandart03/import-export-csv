<?php

require_once '../core/Database.php';

if (isset($_POST['upload'])) {
    $filename = $_FILES['csv_file']['tmp_name'];

    if ($_FILES['csv_file']['size'] > 0) {
        $file = fopen($filename, "r");


        $db = new Database();
        $conn = $db->getConnection();

        fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {
            $name = $row[1];
            $price = $row[2];
            $description = $row[3];

            $db->insertProduct($name, $price, $description);
        }

        fclose($file);
        $conn->close();
        echo "Products uploaded successfully.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="csv_file" />
    <button type="submit" name="upload">Upload CSV</button>
</form>