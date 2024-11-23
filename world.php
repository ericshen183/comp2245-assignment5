<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->execute(['country' => "%$country%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($lookup === 'cities') {
  $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population 
              FROM cities 
              JOIN countries ON cities.country_code = countries.code 
              WHERE countries.name LIKE :country");
  $stmt->execute(['country' => "%$country%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table border>
    <tr>
    <th>City Name</th>
    <th>District</th>
    <th>Population</th>
    </tr>
    <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']); ?></td>
      <td><?= htmlspecialchars($row['district']); ?></td>
      <td><?= htmlspecialchars($row['population']); ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php
  exit;
}
?>
<table border>
  <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']); ?></td>
      <td><?= htmlspecialchars($row['continent']); ?></td>
      <td><?= htmlspecialchars($row['independence_year']); ?></td>
      <td><?= htmlspecialchars($row['head_of_state']); ?></td>
    </tr>
  <?php endforeach; ?>
</table>


