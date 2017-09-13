<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/auth', function (Request $request, Response $response) use ($app) {
    $info = $request->getParsedBody();

    $usuario = WEB\UsuarioQuery::create()->filterByUsario($info['usuario'])->filterBySenha(md5($info['senha']))->findOne();

    if ($usuario instanceof WEB\Base\Usuario) {
        $jwt = \Auth\JWTAuth::encode([
                    'expiration_sec' => 3600,
                    'iss' => $_SERVER['SERVER_NAME'],
                    'userdata' => [
                        'id' => $usuario->getId(),
                        'user' => $usuario->getUsario()
                    ]
        ]);

        $_SESSION['token'] = $jwt;
        return $response->withJson(['login' => true], 200)
                        ->withHeader('Content-type', 'application/json');
    }

    return $response->withJson(["erro" => 'Sem permissão de acesso!', 'login' => false], 400)
                    ->withHeader('Content-type', 'application/json');
});
