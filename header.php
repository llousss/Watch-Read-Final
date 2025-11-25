<div class="marca">
    <h1>Wacth&Read</h1>
    <p class="tag">Organize Livros, Filmes e Séries com facilidade</p>
</div>

<?php if(isset($_SESSION["usuario_nome"])): ?>
    <b>
        <p class="usuario-logado">Olá, <?= $_SESSION["usuario_nome"] ?>!</p>
    </b>
<?php endif; ?>