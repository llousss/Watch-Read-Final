<?php
session_start();

// Se o usuário não estiver logado, volta pro login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

require "db.php";

$usuario_id = $_SESSION["usuario_id"];

/* ------------------------
      CONTADORES GERAIS
-------------------------*/

// Séries
$sqlSeriesTotal = "SELECT COUNT(*) AS total FROM series WHERE usuario_id = $usuario_id";
$sqlSeriesConcluidas = "SELECT COUNT(*) AS total FROM series WHERE usuario_id = $usuario_id AND stts = 'Assistido'";
$sqlSeriesAndamento = "SELECT COUNT(*) AS total FROM series WHERE usuario_id = $usuario_id AND stts = 'Assistindo'";

$seriesTotal = $conn->query($sqlSeriesTotal)->fetch_assoc()['total'];
$seriesConcluidas = $conn->query($sqlSeriesConcluidas)->fetch_assoc()['total'];
$seriesAndamento = $conn->query($sqlSeriesAndamento)->fetch_assoc()['total'];

// Filmes
$sqlFilmesTotal = "SELECT COUNT(*) AS total FROM filmes WHERE usuario_id = $usuario_id";
$filmesTotal = $conn->query($sqlFilmesTotal)->fetch_assoc()['total'];

// Livros
$sqlLivrosTotal = "SELECT COUNT(*) AS total FROM livros WHERE usuario_id = $usuario_id";
$sqlLivrosLendo = "SELECT COUNT(*) AS total FROM livros WHERE usuario_id = $usuario_id AND stts = 'Lendo'";
$sqlLivrosLidos = "SELECT COUNT(*) AS total FROM livros WHERE usuario_id = $usuario_id AND stts = 'Lido'";

$livrosTotal = $conn->query($sqlLivrosTotal)->fetch_assoc()['total'];
$livrosLendo = $conn->query($sqlLivrosLendo)->fetch_assoc()['total'];
$livrosLidos = $conn->query($sqlLivrosLidos)->fetch_assoc()['total'];

/* ------------------------
    CONTADORES MENSAIS
-------------------------*/

// === FILMES ASSISTIDOS NO MÊS ===
$sqlFilmesMes = "SELECT COUNT(*) AS total FROM filmes 
    WHERE usuario_id = $usuario_id 
    AND stts = 'Assistido'
    AND MONTH(data_registro) = MONTH(CURRENT_DATE())
    AND YEAR(data_registro) = YEAR(CURRENT_DATE())";
$filmesMes = $conn->query($sqlFilmesMes)->fetch_assoc()['total'];

// === LIVROS LIDOS NO MÊS ===
$sqlLivrosMes = "SELECT COUNT(*) AS total FROM livros 
    WHERE usuario_id = $usuario_id 
    AND stts = 'Lido'
    AND MONTH(data_registro) = MONTH(CURRENT_DATE())
    AND YEAR(data_registro) = YEAR(CURRENT_DATE())";
$livrosMes = $conn->query($sqlLivrosMes)->fetch_assoc()['total'];

// === SÉRIES ASSISTIDAS NO MÊS ===
$sqlSeriesMes = "SELECT COUNT(*) AS total FROM series 
    WHERE usuario_id = $usuario_id 
    AND stts = 'Assistido'
    AND MONTH(data_registro) = MONTH(CURRENT_DATE())
    AND YEAR(data_registro) = YEAR(CURRENT_DATE())";
$seriesMes = $conn->query($sqlSeriesMes)->fetch_assoc()['total'];

/* ------------------------
   ÚLTIMOS ADICIONADOS
-------------------------*/

$sqlRecentes = "
(
    SELECT titulo, 'Série' AS tipo, stts, data_registro 
    FROM series WHERE usuario_id = $usuario_id
)
UNION ALL
(
    SELECT titulo, 'Filme' AS tipo, stts, data_registro 
    FROM filmes WHERE usuario_id = $usuario_id
)
UNION ALL
(
    SELECT titulo, 'Livro' AS tipo, stts, data_registro 
    FROM livros WHERE usuario_id = $usuario_id
)
ORDER BY data_registro DESC
LIMIT 5
";

$recentes = $conn->query($sqlRecentes);

/* ------------------------
       EM ANDAMENTO
-------------------------*/

$sqlAndamento = "
(
    SELECT titulo, 'Série' AS tipo FROM series WHERE usuario_id = $usuario_id AND stts = 'Assistindo'
)
UNION ALL
(
    SELECT titulo, 'Filme' AS tipo FROM filmes WHERE usuario_id = $usuario_id AND stts = 'Assistindo'
)
UNION ALL
(
    SELECT titulo, 'Livro' AS tipo FROM livros WHERE usuario_id = $usuario_id AND stts = 'Lendo'
)
LIMIT 5
";

$andamento = $conn->query($sqlAndamento);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Watch&Read — Dashboard</title>
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

  <!-- INTRODUÇÃO -->
  <section class="introducao">
    <h2>Seu Painel de Resumo</h2>
    <p>Acompanhe rapidamente o que você está lendo, assistindo e concluindo.</p>
  </section>

  <!-- AÇÕES -->
  <section class="acoes">
    <a href="LivrosCRUD/add.php" class="botao"><b>+</b> Adicionar Livro</a>
    <a href="FilmesCRUD/add.php" class="botao"><b>+</b> Adicionar Filme</a>
    <a href="SeriesCRUD/add.php" class="botao"><b>+</b> Adicionar Série</a>
  </section>

  <!-- CARTÕES RESUMO -->
  <section class="cards">

    <article class="card">
      <h3>Séries</h3>
      <p class="valor-grande"><?= $seriesConcluidas ?> / <?= $seriesAndamento ?></p>
      <p class="texto-claro">Concluídas / Em andamento</p>
    </article>

    <article class="card">
      <h3>Filmes</h3>
      <p class="valor-grande"><?= $filmesMes ?></p>
      <p class="texto-claro">Vistos este mês</p>
    </article>

    <article class="card">
      <h3>Livros</h3>
      <p class="valor-grande"><?= $livrosLidos ?> / <?= $livrosLendo ?></p>
      <p class="texto-claro">Lidos / Lendo</p>
    </article>

    <!-- EM ANDAMENTO -->
    <article class="card card-destaque">
      <h3>Em andamento</h3>
      <ul class="lista-em-andamento">
        <?php if ($andamento->num_rows > 0): ?>
          <?php while ($a = $andamento->fetch_assoc()): ?>
            <li><strong><?= $a['titulo'] ?>:</strong> <?= $a['tipo'] ?></li>
          <?php endwhile; ?>
        <?php else: ?>
          <li>Nenhum item em andamento.</li>
        <?php endif; ?>
      </ul>
    </article>
  </section>

  <!-- ÚLTIMOS ADICIONADOS -->
  <section class="grade">
    <div class="painel">
      <header class="cabecalho-painel">
        <h3>Últimos adicionados</h3>
        <small>Itens mais recentes cadastrados</small>
      </header>

      <div class="corpo-painel">
        <ul class="lista-recente">
          <?php if ($recentes->num_rows > 0): ?>
            <?php while ($r = $recentes->fetch_assoc()): ?>
              <li><strong><?= $r['titulo'] ?></strong> — <?= $r['tipo'] ?> (<?= $r['stts'] ?>)</li>
            <?php endwhile; ?>
          <?php else: ?>
            <li>Nenhum item adicionado recentemente.</li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <!-- PROGRESSO MENSAL -->
    <div class="painel">
      <header class="cabecalho-painel">
        <h3>Progresso mensal</h3>
        <small>Itens concluídos no mês atual</small>
      </header>

      <div class="corpo-painel">
        <ul>
          <li><strong>Filmes assistidos:</strong> <?= $filmesMes ?></li>
          <li><strong>Livros lidos:</strong> <?= $livrosMes ?></li>
          <li><strong>Séries concluídas:</strong> <?= $seriesMes ?></li>
        </ul>
      </div>
    </div>

  </section>
</main>

<?php include 'footer.php'; ?>
<script src="js/tema.js"></script>
</body>
</html>
