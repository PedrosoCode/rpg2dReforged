<?php
include './connection.php'; // inclui o arquivo de conexão

?>

<?php
//FIXME - esse código por inteiro ainda não funciona, o erro provavelmente está no banco de dados
// Consulta SQL para selecionar todas as entradas da tabela tb_attributes
$sql = "SELECT * FROM tb_attributes";
$result = $conn->query($sql);

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPG DB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php include './includes/navbar.php'; ?>

    <div class="container">
      <h1>Entradas da Tabela de Atributos</h1>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Verifica se há resultados na consulta
          if ($result->num_rows > 0) {
              // Itera sobre cada linha de resultados
              while ($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $row["id_attribute"] . "</td><td>" . $row["nome"] . "</td></tr>";
              }
          } else {
              echo "<tr><td colspan='2'>Nenhum resultado encontrado</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
