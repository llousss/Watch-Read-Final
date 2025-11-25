<?php
session_start();

// Se o usuário não estiver logado, volta pro login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Wacth&Read — Contato</title>
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
  <main class="container" style="justify-items: center;">
    <section class="introducao">
      <h2>Fale com a gente</h2>
      <p>Preencha o formulário abaixo para entrar em contato com nossa equipe de desenvolvimento.</p>
    </section>

    <section class="cartoes card-contato">
      <article class="card">
        <form action="salvar_contato.php" method="post" class="formulario-contato">
          <div class="campo-formulario">
            <label for="id_nome">Nome:</label>
            <input type="text" name="nome" id="id_nome" placeholder="Seu nome completo" required>
          </div>

          <div class="campo-formulario">
            <label for="id_email">Email:</label>
            <input type="email" name="email" id="id_email" placeholder="seuemail@exemplo.com" required>
          </div>

          <div class="campo-formulario">
            <label for="id_cpf">CPF:</label>
            <input type="text" name="cpf" id="id_cpf" placeholder="999.999.999-99" maxlength="14" required>
          </div>

          <div class="campo-formulario">
            <label for="id_assunto">Assunto:</label>
            <input type="text" name="assunto" id="id_assunto" placeholder="Motivo do contato" required>
          </div>

          <!-- SELETOR DE CLASSE AFETANDO TEXTAREA -->
          <div class="campo-formulario">
            <label for="id_mensagem">Mensagem:</label>
            <textarea name="mensagem" id="id_mensagem" rows="6" placeholder="Escreva sua mensagem aqui" required></textarea>
          </div>

          <button type="submit" class="botao botao-contato">Enviar Mensagem</button>
        </form>
      </article>
    </section>
  </main>

  <!-- RODAPÉ -->
  <?php include 'footer.php'; ?>
  <script src="js/validacao.js"></script>
  <script src="js/tema.js"></script>
</body>
</html>