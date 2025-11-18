# Estrutura das Páginas



### 1\. Página Inicial (index.php)



Apresentação rápida do sistema (tema e objetivo).



Menu de navegação para Séries, Filmes e Livros.



Painel com resumo (exemplo: “Você já concluiu 12 séries, 5 livros e 20 filmes”).



Destaque para o que está “Em andamento”.



### 2\. Login / Cadastro de Usuário (auth/)



login.php → usuário entra com e-mail/senha.



register.php → novo usuário cria conta.



logout.php → encerra sessão.

🔒 Assim, cada usuário tem seu próprio acervo.



### 3\. Módulo Séries (series/)



list.php → lista todas as séries cadastradas (com status: a assistir, em andamento, concluída).



add.php → formulário para cadastrar nova série (nome, gênero, temporadas, status, nota pessoal).



edit.php → editar informações da série.



delete.php → excluir série.



### 4\. Módulo Filmes (filmes/)



Estrutura idêntica ao módulo de séries:



list.php (listar todos os filmes).



add.php (cadastrar novo filme com nome, gênero, ano, status, nota pessoal).



edit.php, delete.php.



### 5\. Módulo Livros (livros/)



Mesma lógica:



list.php → lista livros (com autor, páginas, status: a ler, lendo, lido).



add.php, edit.php, delete.php.



### 6\. Relatórios (relatorios/)



Resumo por categoria:



Quantidade de filmes vistos, livros lidos, séries concluídas.



Percentual de concluídos vs em andamento.



Gráfico simples (ex.: pizza ou barras) mostrando progresso.



### 7\. Perfil (usuario/perfil.php)



Dados do usuário (nome, e-mail).



Estatísticas pessoais (exemplo: “Já consumiu 120 horas de entretenimento”).



Opção para alterar senha.



📊 Banco de Dados básico teria tabelas como:



### usuarios (login).



series (id, titulo, genero, temporadas, status, nota, usuario\_id).



filmes (id, titulo, genero, ano, status, nota, usuario\_id).



livros (id, titulo, autor, paginas, status, nota, usuario\_id).

