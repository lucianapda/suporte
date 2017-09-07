<?php

    $app->add(function ($request, $response, $next) {
        $jwt = $request->getHeader('token');
        if ($request->getUri()->getPath() == "/auth" && empty($jwt)) {
            $response = $next($request, $response);
            return $response;
        } else if (empty($jwt)) {
            return $response->withStatus(302)->withHeader('Location', '/auth');
        }

        if ($jwt) {
            try {
                $app['jwt'] = \Auth\JWTAuth::decode($jwt[0]);
            } catch (Exception $ex) {
                if ($request->getUri()->getPath() == "/auth" && !empty($jwt)) {
                    $response = $next($request, $response);
                    return $response;
                }
                return $response->withStatus(302)->withHeader('Location', '/auth');
            }
        } else {
            return $response->withJson(["erro" => 'Token não informado!'], 400)
                            ->withHeader('Content-type', 'application/json');
        }
        if ($request->getUri()->getPath() == "/auth" && !empty($jwt)) {
            return $response->withJson(['success' => 'Voce já está autenticado!', 'login' => true], 200)
                            ->withHeader('Content-type', 'application/json');
        }
        $data = $app['jwt']->data;

        $usuario = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

        if ($usuario instanceof WEB\Base\Usuario) {
            $request = $request->withAttribute('tokenD', $data);
            $response = $next($request, $response);
            return $response;
        }
        return $response->withJson(["erro" => 'Sem permissão de acesso!'], 400)
                        ->withHeader('Content-type', 'application/json');
    });

    $verify = function ($request, $response, $next) {
        $data = $request->getAttribute('tokenD');

        $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

        if ($usuarioReq->isIsadmin()) {
            $response = $next($request, $response);
            return $response;
        }
        return $response->withJson(["erro" => 'Sem permissão de acesso a essa função!'], 400)
                        ->withHeader('Content-type', 'application/json');
    };
    