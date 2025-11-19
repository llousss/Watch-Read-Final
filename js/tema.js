document.addEventListener('DOMContentLoaded', function() {

    const body = document.body;
    const btnAlternarTema = document.getElementById('alternaTema');

    function carregarTema() {
    // captura o tema salvo no localstorage
        const temaSalvo = localStorage.getItem('preferenciaTema') || 'light';

        if (temaSalvo === 'dark') {
            body.classList.add('tema-escuro');
            if (btnAlternarTema) {
            btnAlternarTema.textContent = '☀️';
            }
        } else {
            body.classList.remove('tema-escuro');
            if (btnAlternarTema) {
            btnAlternarTema.textContent = '🌙';
            }
        }
    }

    // SALVAR O TEMA
    function alternarESalvarTema() {
        // liga/desliga
        body.classList.toggle('tema-escuro');

        let novoTema;

        if (body.classList.contains('tema-escuro')) {
            novoTema = 'dark';
            btnAlternarTema.textContent = '☀️';
        } else {
            novoTema = 'light';
            btnAlternarTema.textContent = '🌙';
    }

    localStorage.setItem('preferenciaTema', novoTema);
    }

    // ----------------------------------------------------
    // INICIALIZAÇÃO
    // ----------------------------------------------------

    // 1. Carrega o tema imediatamente ao carregar a página
    carregarTema();

    // 2. Adiciona o evento de clique APENAS se o botão existir na página
    if (btnAlternarTema) {
        btnAlternarTema.addEventListener('click', alternarESalvarTema);
    }
});