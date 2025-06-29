<html>
  <head>
    <meta charset="UTF-8"/>
    <title>Факти за България</title>
  </head>
  <body>
    <div align="center">
      <h1>Факти за България</h1>
      <img src="bulgaria-map.png" />
      <table>
        <tr>
          <td>Площ</td>
          <td></td>
          <td>110 993.6 кв.км.</td>
        </tr>
        <tr>
          <td>Население</td>
          <td></td>
          <td>7 101 859</td>
        </tr>
        <tr>
          <td>Столица</td>
          <td></td>
          <td>София</td>
        </tr>
      </table>

      <h2>Големи градове</h2>
      <table border="1" cellpadding="5" cellspacing="0">
        <tr>
          <th>Град</th>
          <th>Население</th>
        </tr>
        <?php
        $host = 'db'; // име на контейнера в swarm
        $user = 'web_user';
        $password = trim(@file_get_contents('/run/secrets/db_root_password'));
        $database = 'bulgaria';

        $conn = new mysqli($host, $user, $password, $database);
        if ($conn->connect_error) {
            echo "<tr><td colspan='2'>Грешка при свързване с базата: " . htmlspecialchars($conn->connect_error) . "</td></tr>";
        } else {
            $sql = "SELECT city_name, population FROM cities ORDER BY population DESC";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row["city_name"]) . "</td><td>" . htmlspecialchars(number_format($row["population"], 0, '', ' ')) . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Няма налични данни</td></tr>";
            }
            $conn->close();
        }
        ?>
      </table>
    </div>
  </body>
</html>

