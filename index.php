<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Wacth&Read — Dashboard</title>
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
    <!-- INTRODUÇÃO -->
    <section class="introducao">
      <h2>Organize suas Séries, Filmes e Livros</h2>
      <p>
        Registre o que você já viu e leu, acompanhe o progresso e consulte estatísticas rápidas.
      </p>
    </section>

    <!-- AÇÕES -->
    <section class="acoes">
      <a href="livros/add.html" class="botao"><b>+</b> Adicionar Livro</a>
      <a href="filmes/add.html" class="botao"><b>+</b> Adicionar Filme</a>
      <a href="series/add.html" class="botao"><b>+</b> Adicionar Série</a>
      <!-- <a href="relatorios/" class="botao ghost"> Ver Relatórios</a> -->
    </section>

    <!-- CARTÕES RESUMO -->
    <section class="cards">
      <article class="card">
        <h3>Séries</h3>
        <p class="valor-grande">0</p>
        <p class="texto-claro">Concluídas / Em andamento</p>
      </article>

      <article class="card">
        <h3>Filmes</h3>
        <p class="valor-grande">0</p>
        <p class="texto-claro">Vistos este mês</p>
      </article>

      <article class="card">
        <h3>Livros</h3>
        <p class="valor-grande">0</p>
        <p class="texto-claro">Lidos / Lendo</p>
      </article>

      <!-- CARTÃO: EM ANDAMENTO -->
      <article class="card card-destaque">
        <h3>Em andamento</h3>
        <ul class="lista-em-andamento">
          <li><strong>Exemplo Série:</strong> Em andamento</li>
          <li><strong>Exemplo Filme:</strong> Assistindo</li>
          <li><strong>Exemplo Livro:</strong> Lendo</li>
        </ul>
      </article>
    </section>

    <!-- PROGRESSO MENSAL -->
    <section class="grade">
      <div class="painel">
        <header class="cabecalho-painel">
          <h3>Progresso mensal</h3>
          <small>Variação de consumo por tipo</small>
        </header>
        <div class="corpo-painel">
          <p>Aqui ficará registrado seu progresso mensal.</p>
        </div>
      </div>

      <div class="painel">
        <header class="cabecalho-painel">
          <h3>Últimos adicionados</h3>
          <small>Últimas séries/filmes/livros cadastrados</small>
        </header>
        <div class="corpo-painel">
          <ul class="lista-recente">
            <li><strong>Exemplo Série</strong> — Em andamento</li>
            <li><strong>Exemplo Filme</strong> — Visto</li>
            <li><strong>Exemplo Livro</strong> — Lendo</li>
          </ul>
        </div>
      </div>
    </section>
  </main>

  <!-- RODAPÉ -->
  <?php include 'footer.php'; ?>
  <script src="js/tema.js"></script>
</body>
</html>