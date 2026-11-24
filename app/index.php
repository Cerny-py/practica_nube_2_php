<?php
// Parámetros de conexión: vienen de las variables de entorno del contenedor
$dbHost     = getenv('DB_HOST');
$dbUser     = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$dbName     = getenv('DB_NAME');

mysqli_report(MYSQLI_REPORT_OFF);
$conn = @new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_errno) {
    http_response_code(503);
    exit('Error: no se pudo conectar a la base de datos del gimnasio.');
}

$conn->set_charset('utf8mb4');
$result = $conn->query('SELECT id, nombre, plan, estado FROM socios ORDER BY id');

if (!$result) {
    http_response_code(500);
    exit('Error al consultar la tabla socios.');
}

$socios = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

function h($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gimnasio - Socios</title>
  <style>
    body { font-family: sans-serif; margin: 2rem; }
    table { border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: .5rem 1rem; text-align: left; }
    th { background: #eee; }
  </style>
</head>
<body>
  <h1>Socios del Gimnasio</h1>
  <p>Total de socios: <strong id="total"><?= count($socios) ?></strong></p>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Plan</th><th>Estado</th></tr>
    <?php foreach ($socios as $s): ?>
    <tr class="socio">
      <td><?= h($s['id']) ?></td>
      <td><?= h($s['nombre']) ?></td>
      <td><?= h($s['plan']) ?></td>
      <td><?= h($s['estado']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
