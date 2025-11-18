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
      <!-- HEADER E BOTÃO -->
      <?php include 'header.php'; ?>
      <!-- NAV -->
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
    <button class="botao"><b>+</b> Adicionar</button>
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
          
        </tbody>
      </table>
    </div>
  </main>

  <!-- RODAPÉ -->
  <?php include 'footer.php'; ?>
  <script src="js/carrega_dados_livros.js"></script>
  <script src="js/tema.js"></script>
</body>
</html>