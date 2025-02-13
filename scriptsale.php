<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>scriptsale</title>
</head>
<body>
    <?php
        include("connessione.php");
        $anno = $_POST['anno'];
        $includi_sconosciute = isset($_POST['includi_sconosciute']);
        echo "<h2>Dati inviati</h2>";
        echo "<p>Anno scelto: " . $anno . "</p>";
        $sql = "SELECT * FROM sale WHERE YEAR(DataApertura) = $anno";
        if ($includi_sconosciute) {
            $sql = $sql . " OR DataApertura IS NULL";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<h2>Risultati</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nome</th><th>Data Apertura</th></tr>";
            while($row = $result->fetch_assoc()) {
                $value = $row["DataApertura"];
                if ($value == NULL) {
                    $value = "Data Sconosciuta";
                } else {
                    $value = $row["DataApertura"];
                }
                echo "<tr><td>" . $row["CodSala"] . "</td><td>" . $row["Nome"] . "</td><td>" . $value . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red'>Nessuna sala trovata</p>";
        }
        $conn->close();
    ?>
</body>
</html>