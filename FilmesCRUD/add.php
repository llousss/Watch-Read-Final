<?php 
session_start();
include "../db.php"; 

// Se não estiver logado, volta para o login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Filme</title>

    <!-- CSS universal do CRUD -->
    <link rel="stylesheet" href="../css/crud.css">
</head>
<body>

    <div class="crud-container">

        <h2>Adicionar Filme</h2>
        <p style="text-align:center; margin-top:-10px; color:var(--texto-claro);">
            Preencha os campos abaixo para adicionar um novo filme à sua coleção.
        </p>

        <form action="salvar.php" method="POST" enctype="multipart/form-data" class="crud-form">

            <!-- CAPA -->
            <label for="capa">Capa:</label>
            <input type="file" id="capa" name="capa" required>

            <!-- TÍTULO -->
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <!-- GÊNERO -->
            <label for="genero">Gênero:</label>
            <input type="text" id="genero" name="genero">

            <!-- STATUS -->
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Assistindo">Assistindo</option>
                <option value="Assistido">Assistido</option>
                <option value="Pendente">Pendente</option>
            </select>

            <!-- AVALIAÇÃO -->
            <label for="avaliacao">Avaliação (0 a 10):</label>
            <input type="number" id="avaliacao" name="avaliacao" min="0" max="10">

            <!-- ID DO USUÁRIO -->
            <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>">

            <button type="submit">Salvar</button>
        </form>

        <a href="../filmes.php" class="voltar">Voltar</a>

    </div>

</body>
</html>
