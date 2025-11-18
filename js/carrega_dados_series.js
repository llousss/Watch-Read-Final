const tabelaCorpo = document.getElementById('corpo-tabela-series');
const urlDados = 'data/series.json';

function carregarSeriesJSON() {

    fetch(urlDados)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro ao buscar dados: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            renderizarSeries(data);
        })
        .catch(error => {
            console.error('Houve um erro ao carregar o catálogo:', error);
            tabelaCorpo.innerHTML = `<tr><td colspan="5">Erro ao carregar as séries.</td></tr>`;
        });

}

function renderizarSeries(series) {
    let htmlSeries = '';

    series.forEach(serie => {
        htmlSeries += ` 
            <tr> 
                <td><img src="${serie.imagem.src}" alt="${serie.imagem.alt}" width="70"></td> 
                <td>${serie.titulo}</td>
                <td>${serie.genero}</td>
                <td>${serie.tempat}</td>
                <td>${serie.status}</td>
                <td>${serie.avaliação}</td>
            </tr> 
        `;
    });

    tabelaCorpo.innerHTML = htmlSeries;
}

// Inicia o carregamento
carregarSeriesJSON();
