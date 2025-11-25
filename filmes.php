<?php
session_start();

// Se não estiver logado → login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

require "db.php";

// Pegamos SOMENTE os filmes do usuário logado
$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT * FROM filmes WHERE usuario_id = $usuario_id ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Watch&Read — Filmes</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- CABEÇALHO -->
  <header class="cabecalho">
    <div class="container cabecalho-interno">
      <?php include 'header.php'; ?>
      <?php include 'nav.php'; ?>
    </div>
  </header>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="container">

    <section class="introducao">
      <h2>Meus Filmes</h2>
      <p>Acompanhe seus filmes em andamento, concluídos e pendentes.</p>
    </section>

    <!-- AÇÕES -->
    <div class="acoes-geral">
      <!-- Botão para adicionar -->
      <a href="FilmesCRUD/add.php" class="botao"><b>+</b> Adicionar</a>

      <input type="text" placeholder="Pesquisar Filme..." class="barra-pesquisa">
    </div>

    <!-- TABELA DE FILMES -->
    <div class="tabela-container">
      <table class="tabela-livros">
        <thead>
          <tr>
            <th>Capa</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Status</th>
            <th>Avaliação</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>

          <?php if ($resultado->num_rows > 0): ?>
            <?php while ($f = $resultado->fetch_assoc()): ?>

              <tr>
                <!-- CAPA -->
                <td>
                  <?php if ($f['capa']): ?>
                    <img src="imagens/<?= $f['capa'] ?>" alt="Capa" class="capa">
                  <?php else: ?>
                    <span>—</span>
                  <?php endif; ?>
                </td>

                <td><?= htmlspecialchars($f['titulo']) ?></td>
                <td><?= htmlspecialchars($f['genero']) ?></td>
                <td><?= htmlspecialchars($f['stts']) ?></td>

                <td>
                  <?= $f['avaliacao'] !== null ? $f['avaliacao'] . "/10" : "—" ?>
                </td>

                <!-- EDITAR -->
                <td>
                  <a href="FilmesCRUD/editar.php?id=<?= $f['id'] ?>" class="botao botao-editar">Editar</a>
                </td>

                <!-- DELETAR -->
                <td>
                  <a href="FilmesCRUD/deletar.php?id=<?= $f['id'] ?>" 
                     class="botao botao-excluir"
                     onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                    Excluir
                  </a>
                </td>

              </tr>

            <?php endwhile; ?>

          <?php else: ?>
            <tr>
              <td colspan="7" style="text-align:center; padding:20px;">
                Nenhum filme cadastrado ainda.
              </td>
            </tr>
          <?php endif; ?>

        </tbody>

      </table>
    </div>
  </main>

  <!-- RODAPÉ -->
  <?php include 'footer.php'; ?>
  
  <script src="js/tema.js"></script>
  
</body>
</html>
