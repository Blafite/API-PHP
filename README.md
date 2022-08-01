# APIReact

Foram realizados a implementação das seguintes funcionalidades na API:

- Empreendimentos
    Cadastrar - (http://localhost:8000/api/empreendimentos) POST
    Listar - (http://localhost:8000/api/empreendimentos) GET
    Editar - (http://localhost:8000/api/empreendimentos/{ID}) PUT
    Remover - (http://localhost:8000/api/empreendimentos/{ID}) DELETE
    Listar quantidade de Estoque Disponivel - Está vindo dentro do Listar
    Listar VGV de Unidades Vendidas - Está vindo dentro do Listar
    Listar VGV de Unidades Reservadas - Está vindo dentro do Listar
    Filtrar - (http://localhost:8000/api/empreendimentos/{ID}) GET

- Unidades
    Cadastrar - (http://localhost:8000/api/unidades) POST
    Listar - (http://localhost:8000/api/unidades) GET
    Editar - (http://localhost:8000/api/unidades/{ID}) PUT
    Remover - (http://localhost:8000/api/unidades/{ID}) DELETE
    Reajustar Valor em Massa das Unidades com status Disponivel (Com geração de log) - (http://localhost:8000/api/reajustarValor) POST
    Cadastro Automizado de Unidades - (http://localhost:8000/api/unidadesAutomatico) POST
    Filtrar - (http://localhost:8000/api/unidades/{ID}) GET

- Usuários
    Cadastrar - (http://localhost:8000/api/usuario) POST
    Login - (http://localhost:8000/api/login) POST

Ressalto que para executar qualquer funcionalidade relacionada a Unidades ou Empreendimentos é necessário se autenticar, foi utilizada a autenticação JWT.

Qualquer dúvida estou à disposição