<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Wacth&Read — Filmes</title>
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
      <h2>Meus Filmes</h2>
      <p>Acompanhe seus filmes em andamento, concluídos e pendentes.</p>
    </section>

  <!-- AÇÕES -->
  <div class="acoes-geral">
    <button class="botao"><b>+</b> Adicionar</button>
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
        <tbody id="corpo-tabela-filmes">
          
        </tbody>
      </table>
    </div>
  </main>

  <!-- RODAPÉ -->
  <?php include 'footer.php'; ?>
  <script src="js/carrega_dados_filmes.js"></script>
  <script src="js/tema.js"></script>
</body>
</html>