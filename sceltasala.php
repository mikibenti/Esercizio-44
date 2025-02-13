<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>es44</title>
</head>
<body>
    <?php
        include("connessione.php");
        $sql = "SELECT * FROM sale";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            echo '<h1>Tabella Sale</h1>';
            echo '<table border="1"><tr>';
            while ($fieldinfo = $result->fetch_field()) {
                echo '<th>' . $fieldinfo->name . '</th>';
            }
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . $value . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }  else {
            echo "<p style = color:red>Nessuna sala trovata</p>";
        }
        $conn->close();
    ?>
    <br><form action="scriptsale.php" method="post">
        <label for="anno">Anno di apertura:</label>
        <input type="number" id="anno" name="anno" min="1900" max="2025" required>
        <br>
        <input type="checkbox" id="includi_sconosciute" name="includi_sconosciute">
        <label for="includi_sconosciute">Includi sale con data di apertura sconosciuta</label>
        <br>
        <input type="submit" value="Filtra sale">
    </form>
</body>
</html>