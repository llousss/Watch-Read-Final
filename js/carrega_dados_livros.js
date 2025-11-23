const tabelaCorpo = document.getElementById('corpo-tabela-livros');
const urlDados = 'data/livros.json';

function carregarLivrosJSON() {

    fetch(urlDados)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro ao buscar dados: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            renderizarLivros(data);
        })
        .catch(error => {
            console.error('Houve um erro ao carregar o catálogo:', error);
            tabelaCorpo.innerHTML = `<tr><td colspan="7">Erro ao carregar os livros.</td></tr>`;
        });

}

function renderizarLivros(livros) {
    let htmlLivros = '';

    livros.forEach(livro => {
        htmlLivros += ` 
            <tr> 
                <td><img src="${livro.imagem.src}" alt="${livro.imagem.alt}" width="70"></td> 
                <td>${livro.titulo}</td>
                <td>${livro.autor}</td>
                <td>${livro.status}</td>
                <td>${livro.avaliação}</td>

                <!-- Botões de ação -->
                <td>
                    <a href="livros/edit.php?id=${livro.id}" class="btn-editar">✏️ Editar</a>
                </td>
                <td>
                    <a href="livros/delete.php?id=${livro.id}" 
                       class="btn-excluir"
                       onclick="return confirm('Deseja excluir este livro?')">🗑️ Excluir</a>
                </td>
            </tr> 
        `;
    });

    tabelaCorpo.innerHTML = htmlLivros;
}

// Inicia o carregamento
carregarLivrosJSON();
