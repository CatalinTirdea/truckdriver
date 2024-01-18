

<?php
session_set_cookie_params(['HttpOnly' => true, 'Secure' => true]);
session_start();
include 'dbconnection.php';



try {

  $id_camion =(int) $_SESSION['id'];
    $sql = "SELECT * FROM Camioane WHERE ID_Camion = " . $id_camion . " ;";
      $result = $conn->query($sql);
  if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();

        echo "<table border='1'>";
        echo "<tr><th>ID_Camion</th><th>ID_Sofer</th><th>Număr înmatriculare</th><th>Model</th><th>An de fabricație</th><th>Capacitate de încărcare</th><th>Alte informații</th></tr>";
        // Iterare prin rândurile rezultatului și afișarea datelor într-un tabel
            echo "<tr><td>{$row['ID_Camion']}</td><td>{$row['Numar_inmatriculare']}</td><td>{$row['Model']}</td><td>{$row['An_fabricatie']}</td><td>{$row['Capacitate_incarcare']}</td><td>{$row['Alte_informatii']}</td></tr>";
        echo "</table>";
    } else {
        echo "Nu există date în tabela 'Camioane'.";
    }
} catch (PDOException $e) {
    echo "Eroare de conectare la baza de date: " . $e->getMessage();
}
?> 




