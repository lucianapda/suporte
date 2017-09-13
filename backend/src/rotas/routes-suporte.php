<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/suporte/{id}', function(Request $request, Response $response) use($app) {
    $id = $request->getAttribute('id');

    $data = $request->getAttribute('tokenD');
    $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

    $suporte = \WEB\PedidoSuporteQuery::create()->filterById($id)->findOne();
    $usuario = \WEB\UsuarioQuery::create()->filterById($suporte->getIdusuarioCriador())->findOne();
    if ($suporte instanceof \WEB\Base\PedidoSuporte && ($usuarioReq->isIsadmin() || $usuarioReq->getId() == $usuario->getId())) {
        return $response->withJson($usuario->toArray(), 200)
                        ->withHeader('Content-type', 'application/json');
    } else {
        return $response->withJson(["erro" => 'Usuario não existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
});

$app->get('/suportes', function(Request $request, Response $response) use($app) {
    $suportes = \WEB\PedidoSuporteQuery::create()->find();
    return $response->withJson(["suport" => $suportes->toArray()], 200)
                    ->withHeader('Content-type', 'application/json');
})->add($verify);

$app->post('/suporte/cadastro', function(Request $request, Response $response) use($app) {
    $info = $request->getParsedBody();
    $data = $request->getAttribute('tokenD');

    $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

    $suporte = new \WEB\PedidoSuporte;

    if ($suporte->verficaArea($info['area'])) {
        $suporte->setArea($info['area']);
    } else {
        return $response->withJson(["erro" => 'Area informada não existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    if ($suporte->verficaStatus($info['status'])) {
        $suporte->setStatus($info['status']);
    } else {
        return $response->withJson(["erro" => 'Status informado não existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    if ($suporte->verficaTipo($info['tipo'])) {
        $suporte->setTipo($info['tipo']);
    } else {
        return $response->withJson(["erro" => 'Tipo informado não existe!'], 400)
                        ->withHeader('Content-type', 'application/json');
    }
    $suporte->setIdusuarioCriador($usuarioReq->getId());
    if ($info['titulo']) {
        $suporte->setTitulo($info['titulo']);
    }
    if ($info['descricao']) {
        $suporte->setDescricao($info['descricao']);
    }
    $suporte->save();
});
