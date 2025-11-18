<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Wacth&Read — Equipe</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <!-- CABEÇALHO -->
  <header class="cabecalho">
    <div class="container cabecalho-interno">
      <!-- HEADER E BOTÃO -->
      <?php include 'header.php'; ?>
      <!-- NAV -->
      <?php include 'nav.php'; ?>
    </div>
  </header>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="container">
    <section class="introducao">
      <h2>Equipe</h2>
      <p>Conheça nossa equipe de desenvolvedores:</p>
    </section>

    <!-- SELETOR ID AFETANDO LISTA -->
    <section class="cartoes">
      <article id="card-equipe">
        <ul>
          <li>Matheus Lima | 202402719181</li>
          <li>Vinicius Silva | 202403554101</li>
        </ul>
      </article>
      <!-- Adicionar membros da equipe aqui -->
    </section>
  </main>

  <!-- RODAPÉ -->
  <?php include 'footer.php'; ?>
  <script src="js/tema.js"></script>
</body>
</html>
