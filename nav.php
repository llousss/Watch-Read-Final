<nav class="nav-principal" aria-label="Navegação principal">
    <ul>
        <li><a href="index.php"><b>Dashboard</b></a></li>
        <li><a href="livros.php"><b>Livros</b></a></li>
        <li><a href="filmes.php"><b>Filmes</b></a></li>
        <li><a href="series.php"><b>Séries</b></a></li>
        <!-- <li><a href="relatorios/"><b>Relatórios</b></a></li> -->
        <li><a href="contato.php"><b>Contato</b></a></li>
        <li><a href="equipe.php"><b>Equipe</b></a></li>
        <a id="alternaTema" href="#"><b>Alternar para Tema Escuro</b></a>
        <?php if (!isset($_SESSION["usuario_id"])): ?>
            <b><a href="login.php" class="botao-entrar">Entrar</a></b>
        <?php else: ?>
            <b><a href="logout.php" class="botao-sair">Sair</a></b>
        <?php endif; ?>
    </ul>
</nav>