<?php
session_start();

// Se o usuário não estiver logado, volta pro login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

require "db.php";

// Pegamos os livros SOMENTE do usuário logado
$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT * FROM livros WHERE usuario_id = $usuario_id ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Wacth&Read — Livros</title>
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
      <h2>Meus Livros</h2>
      <p>Acompanhe seus livros em leitura, concluídos e pendentes.</p>
    </section>

    <!-- AÇÕES -->
    <div class="acoes-geral">
      <a href="LivrosCRUD/add.php" class="botao"><b>+</b> Adicionar</a>
      <input type="text" placeholder="Pesquisar livro..." class="barra-pesquisa">
    </div>

    <!-- TABELA DE LIVROS -->
    <div class="tabela-container">
      <table class="tabela-livros">
        <thead>
          <tr>
            <th>Capa</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Status</th>
            <th>Avaliação</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody id="corpo-tabela-livros">
          <?php if ($resultado->num_rows > 0): ?>
            <?php while ($livro = $resultado->fetch_assoc()): ?>
              <tr>
                <td>
                  <img src="imagens/<?php echo $livro['capa']; ?>" 
                       alt="Capa" 
                       style="width: 50px; height: 70px; object-fit: cover; border-radius: 4px;">
                </td>
                <td><?php echo $livro['titulo']; ?></td>
                <td><?php echo $livro['autor']; ?></td>
                <td><?php echo $livro['stts']; ?></td>
                <td><?php echo $livro['avaliacao']; ?></td>

                <td>
                  <a href="LivrosCRUD/editar.php?id=<?php echo $livro['id']; ?>" class="botao botao-editar">
                    Editar
                  </a>
                </td>

                <td>
                  <a href="LivrosCRUD/deletar.php?id=<?php echo $livro['id']; ?>"
                     onclick="return confirm('Tem certeza que deseja excluir este livro?')"
                     class="botao botao-excluir">
                    Excluir
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" style="text-align: center; padding: 15px;">
                Nenhum livro adicionado ainda.
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
