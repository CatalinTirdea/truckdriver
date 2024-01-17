<?php
include 'dbconnection.php';

$sql = "SELECT role, COUNT(*) as total FROM Informatii GROUP BY role";
$result = $conn->query($sql);

$numar_admin = 0;
$numar_normal = 0;

while ($row = $result->fetch_assoc()) {
    if ($row['role'] == 'Admin') {
        $numar_admin = $row['total'];
    } elseif ($row['role'] == 'User') {
        $numar_normal = $row['total'];
    }
}

require_once ('./jpgraph/src/jpgraph.php');
require_once ('./jpgraph/src/jpgraph_pie.php');
// Crează un obiect grafic
$graph = new PieGraph(400, 300);

// Adaugă datele într-un array
$data = array($numar_admin, $numar_normal);

// Creează un obiect pie plot
$pieplot = new PiePlot($data);

// Adaugă plot-ul la grafic
$graph->Add($pieplot);
// Setează legenda
$legenda = array('Admin', 'Utilizatori Normali');
$pieplot->SetLegends($legenda);

// Afișează graficul
$graph->Stroke();
?>
