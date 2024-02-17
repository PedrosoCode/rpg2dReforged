<?php
include 'connection.php'; // inclui o arquivo de conexão
?>


<!DOCTYPE html>
<html>
<head>
    <title>CRUD com PHP e MySQL</title>
</head>
<body>
<?php
include_once 'includes/navbar.php';
?>

    <h2>Adicionar Novo Usuário</h2>
    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username"><br>
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <label>Endereço:</label><br>
        <input type="text" name="address"><br>
        <input type="submit" name="submit" value="Adicionar Usuário">
    </form>
    <?php
// Função para limpar dados de entrada
function clean_input($data) {
    global $conn; // faz a variável de conexão global para poder utilizá-la aqui
    return htmlspecialchars(stripslashes(trim($data)));
}

// Operação de criação (CREATE)
if(isset($_POST['submit'])) {
    $username = clean_input($_POST['username']);
    $email = clean_input($_POST['email']);
    $address = clean_input($_POST['address']);
    
    $sql = "INSERT INTO users (username, email, address) VALUES ('$username', '$email', '$address')";
    if ($conn->query($sql) === TRUE) {
        echo "Novo registro criado com sucesso";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Operação de atualização (UPDATE)
if(isset($_POST['update'])) {
    $id = clean_input($_POST['id']);
    $newUsername = clean_input($_POST['new_username']);
    $newEmail = clean_input($_POST['new_email']);
    $newAddress = clean_input($_POST['new_address']);
    
    $sql = "UPDATE users SET username='$newUsername', email='$newEmail', address='$newAddress' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }
}

// Operação de exclusão (DELETE)
if(isset($_POST['delete'])) {
    $id = clean_input($_POST['id']);
    
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Registro excluído com sucesso";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erro ao excluir registro: " . $conn->error;
    }
}

// Seleciona todos os dados da tabela users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados em uma tabela
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Ação</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["username"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["address"]."</td>
                <td>
                    <form method='post' action=''>
                        <input type='hidden' name='id' value='".$row["id"]."'>
                        <input type='text' name='new_username' placeholder='Novo username'>
                        <input type='text' name='new_email' placeholder='Novo email'>
                        <input type='text' name='new_address' placeholder='Novo endereço'>
                        <input type='submit' name='update' value='Atualizar'>
                        <input type='submit' name='delete' value='Excluir'> <!-- Botão de exclusão -->
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
?>
<br> fim do código
</body>
</html>
