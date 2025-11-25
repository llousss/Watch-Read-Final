<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

require "db.php";

$usuario_id = $_SESSION["usuario_id"];
$sql = "SELECT * FROM series WHERE usuario_id = $usuario_id ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Watch&Read — Séries</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <header class="cabecalho">
    <div class="container cabecalho-interno">
      <?php include 'header.php'; ?>
      <?php include 'nav.php'; ?>
    </div>
  </header>

  <main class="container">

    <section class="introducao">
      <h2>Minhas Séries</h2>
      <p>Acompanhe suas séries em andamento, concluídas e pendentes.</p>
    </section>

    <div class="acoes-geral">
      <a href="SeriesCRUD/add.php" class="botao"><b>+</b> Adicionar</a>
      <input type="text" placeholder="Pesquisar Série..." class="barra-pesquisa">
    </div>

    <div class="tabela-container">
      <table class="tabela-livros">
        <thead>
          <tr>
            <th>Capa</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Temporada</th>
            <th>Status</th>
            <th>Avaliação</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($s = $resultado->fetch_assoc()): ?>

              <tr>
                <td>
                  <?php if ($s['capa']): ?>
                    <img src="imagens/<?= $s['capa'] ?>" class="capa-tabela">
                  <?php else: ?>
                    —
                  <?php endif; ?>
                </td>

                <td><?= htmlspecialchars($s['titulo']) ?></td>
                <td><?= htmlspecialchars($s['genero']) ?></td>
                <td><?= htmlspecialchars($s['temporada']) ?>ª</td>
                <td><?= htmlspecialchars($s['stts']) ?></td>

                <td>
                  <?= $s['avaliacao'] !== null ? $s['avaliacao'] . "/10" : "—" ?>
                </td>

                <td>
                  <a href="SeriesCRUD/editar.php?id=<?= $s['id'] ?>" class="botao botao-editar">Editar</a>
                </td>

                <td>
                  <a href="SeriesCRUD/deletar.php?id=<?= $s['id'] ?>"
                     class="botao botao-excluir"
                     onclick="return confirm('Tem certeza que deseja excluir esta série?')">
                    Excluir
                  </a>
                </td>
              </tr>

            <?php endwhile; ?>

        <?php else: ?>
            <tr>
              <td colspan="8" style="text-align:center; padding:20px;">
                Nenhuma série cadastrada ainda.
              </td>
            </tr>
        <?php endif; ?>
        </tbody>

      </table>
    </div>
  </main>

  <?php include 'footer.php'; ?>
  <script src="js/tema.js"></script>

</body>
</html>
