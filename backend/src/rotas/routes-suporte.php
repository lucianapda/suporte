<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/suporte/{id}', function(Request $request, Response $response) use($app) {
        $id = $request->getAttribute('id');

        $usuarioReq = \WEB\UsuarioQuery::create()->filterByUsario($request->getHeader('authUser')[0])->findOne();

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
    });
    