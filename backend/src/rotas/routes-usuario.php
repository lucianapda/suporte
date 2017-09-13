<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/usuario/{id}', function(Request $request, Response $response) use($app) {
    $id = $request->getAttribute('id');
    $data = $request->getAttribute('tokenD');

    $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

    $usuario = \WEB\UsuarioQuery::create()->filterById($id)->findOne();
    if ($usuario instanceof \WEB\Base\Usuario && ($usuarioReq->isIsadmin() || $usuarioReq->getId() == $usuario->getId())) {
        return $response->withJson($usuario->toArray(), 200)
                        ->withHeader('Content-type', 'application/json');
    } else {
        return $response->withJson(["erro" => 'Usuario não existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
});

$app->get('/usuarios', function(Request $request, Response $response) use($app) {
    $usuarios = \WEB\UsuarioQuery::create()->find();
    return $response->withJson(["users" => $usuarios->toArray()], 200)
                    ->withHeader('Content-type', 'application/json');
})->add($verify);

$app->post('/usuario/cadastro', function(Request $request, Response $response) use($app) {
    $info = $request->getParsedBody();

    if (isset($info['usuario']))
        $usuario = \WEB\UsuarioQuery::create()->filterByUsario($info['usuario'])->findOneOrCreate();
    else {
        return $response->withJson(["erro" => 'Usuario não informado!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    if (!$usuario->isNew()) {
        return $response->withJson(["erro" => 'Usuario já existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    if (isset($info['nome']))
        $usuario->setNome($info['nome']);
    if (isset($info['email']))
        $usuario->setEmail($info['email']);
    if (isset($info['telefone']))
        $usuario->setTelefone($info['telefone']);
    if (isset($info['senha']))
        $usuario->setSenha(md5($info['senha']));
    else {
        return $response->withJson(["erro" => 'Senha não informada!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    if (isset($info['isAdm']))
        $usuario->setIsadmin($info['isAdm']);


    if (!$usuario->save()) {
        return $response->withJson(["erro" => 'Erro ao salvar!'], 400)
                        ->withHeader('Content-type', 'application/json');
    } else {
        return $response->withJson(["success" => "Usuario cadastrado com sucesso!"], 200)
                        ->withHeader('Content-type', 'application/json');
    }
})->add($verify);

$app->put('/usuario/alterar/{id}', function(Request $request, Response $response) use($app) {
    $info = $request->getParsedBody();
    $id = $request->getAttribute('id');
    $usuario = \WEB\UsuarioQuery::create()->filterById($id)->findOne();
    if (!$usuario instanceof WEB\Base\Usuario) {
        return $response->withJson(["erro" => 'Usuario não existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }

    $data = $request->getAttribute('tokenD');
    $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

    if (!$usuarioReq->isIsadmin() && $usuarioReq->getId() != $usuario->getId()) {
        return $response->withJson(["erro" => 'Usuario sem permissão para alterar os dados!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    if (isset($info['usuario']))
        $usuario->setUsario($info['usuario']);
    if (isset($info['nome']))
        $usuario->setNome($info['nome']);
    if (isset($info['email']))
        $usuario->setEmail($info['email']);
    if (isset($info['telefone']))
        $usuario->setTelefone($info['telefone']);
    if (isset($info['senha']))
        $usuario->setSenha(md5($info['senha']));
    if (isset($info['isAdm']))
        $usuario->setIsadmin($info['isAdm']);


    if (!$usuario->save()) {
        return $response->withJson(["erro" => 'Erro ao salvar!'], 400)
                        ->withHeader('Content-type', 'application/json');
    } else {
        return $response->withJson(["success" => "Usuario alterado com sucesso!"], 200)
                        ->withHeader('Content-type', 'application/json');
    }
});

$app->delete('/usuario/deletar/{id}', function(Request $request, Response $response) use($app) {
    $id = $request->getAttribute('id');
    $usuario = \WEB\UsuarioQuery::create()->filterById($id)->findOne();
    if (!$usuario instanceof WEB\Base\Usuario) {
        return $response->withJson(["erro" => 'Usuario não existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    $usuario->delete();
    return $response->withJson(["success" => "Usuario deletado com sucesso!"], 200)
                    ->withHeader('Content-type', 'application/json');
})->add($verify);
