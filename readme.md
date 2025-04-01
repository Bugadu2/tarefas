1. Configuração Inicial
Define o header para application/json (a API retorna dados em JSON).
Captura o método HTTP (GET, POST, DELETE, etc.).
Lê os dados JSON enviados pelo cliente.

2. Lista de Usuários
Cria um array com 5 usuários fictícios (com id, login, senha, nome, perfil).

3. Tratamento dos Métodos HTTP
POST (Criar Usuário)
Verifica se login e senha foram enviados.
Se faltar algum, retorna um erro (400).
Se estiver tudo certo, adiciona um novo usuário e retorna (201).

GET (Listar Usuários)
Retorna os 5 primeiros usuários da lista.

DELETE (Excluir Usuário)
Pega o ID do usuário pela URL.
Se não houver ID, retorna erro (400).
Remove o usuário da lista e retorna uma mensagem de sucesso (200).

Método Não Permitido
Se for um método diferente de GET, POST ou DELETE, retorna um erro (405).