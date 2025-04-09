<?php 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;
use JoaoNogueira\Tarefas\Service\TarefaService;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

// Middleware de erro personalizado para rota não encontrada
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function (
    Request $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write('{"error": "Recurso não foi encontrado"}');
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

// GET /tarefas
$app->get('/tarefas', function (Request $request, Response $response, array $args) {
    $tarefa_service = new TarefaService();
    $tarefas = $tarefa_service->getAllTarefas();
    $response->getBody()->write(json_encode($tarefas));
    return $response->withHeader('content-type', 'application/json');
});

// POST /tarefas
$app->post('/tarefas', function (Request $request, Response $response, array $args) {
    $parametros = (array) $request->getParsedBody(); // CORRIGIDO: nome da variável

    if (!array_key_exists('titulo', $parametros) || empty($parametros['titulo'])) {
        $response->getBody()->write(json_encode([
            "mensagem" => "titulo é obrigatorio"
        ]));
        return $response->withHeader('content-type', 'application/json')->withStatus(400);
    }

    $tarefa = array_merge(['titulo' => '', 'concluido' => false], $parametros);
    $tarefa_service = new TarefaService();
    $tarefa_service->createTarefa($tarefa);
    
    return $response->withStatus(201);
});

// DELETE /tarefas (sem id) — pode ser removida se não for usar
$app->delete('/tarefas', function (Request $request, Response $response, array $args) {
    return $response->withStatus(204);
});

// DELETE /tarefas/{id}
$app->delete('/tarefas/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    // Aqui você pode chamar o método para excluir a tarefa, ex:
    // $tarefa_service = new TarefaService();
    // $tarefa_service->deleteTarefa($id);
    return $response->withStatus(204);
});

// PUT /tarefas/{id}
$app->put('/tarefas/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $dados_para_atualizar = (array) $request->getParsedBody();

    if (array_key_exists('titulo', $dados_para_atualizar) && empty($dados_para_atualizar['titulo'])) {
        $response->getBody()->write(json_encode([
            "mensagem" => "titulo é obrigatorio"
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    // Exemplo de chamada:
    // $tarefa_service = new TarefaService();
    // $tarefa_service->updateTarefa($id, $dados_para_atualizar);

    return $response->withStatus(201);
});

// REMOVIDO: rota PUT /tarefas duplicada que causava erro
$app->run();
