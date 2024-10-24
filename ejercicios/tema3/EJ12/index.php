<?php
// Definir el contenido
$titulo = "Boletín de notas";

// Notas de las asignaturas en tres trimestres
$notas = [
    "Matemáticas" => [8, 7, 9],
    "Historia" => [6, 5, 7],
    "Ciencias" => [9, 8, 10],
    "Literatura" => [7, 9, 8],
    "Arte" => [10, 9, 9]
];

$tablaNotas = "<table style='margin: auto; border-collapse: collapse;'>";
$tablaNotas .= "<tr><th>Asignatura</th><th>Trimestre 1</th><th>Trimestre 2</th><th>Trimestre 3</th><th>Media</th></tr>";

$mediaTotal = 0;
$totalAsignaturas = count($notas);

foreach ($notas as $asignatura => $valores) {
    $mediaAsignatura = array_sum($valores) / count($valores);
    $mediaTotal += $mediaAsignatura;

    $tablaNotas .= "<tr>
                        <td>$asignatura</td>
                        <td>{$valores[0]}</td>
                        <td>{$valores[1]}</td>
                        <td>{$valores[2]}</td>
                        <td>" . number_format($mediaAsignatura, 2) . "</td>
                    </tr>";
}

$mediaTotal /= $totalAsignaturas;
$tablaNotas .= "</table>";

$media = "Media general de todas las asignaturas: " . number_format($mediaTotal, 2);

// Presentar el contenido
echo "<html>
<head>
    <title>$titulo</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #7CDDFF; text-align: center }
        h1 { color: #333; }
        p { color: #555; }
        table { border: 1px solid #333; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <hr>
    <h1>$titulo</h1>
    <hr>
    <br>
    $tablaNotas
    <p>$media</p>
</body>
</html>";
?>
