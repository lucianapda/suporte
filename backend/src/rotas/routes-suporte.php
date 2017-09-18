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
        return $response->withJson(["suporte" => json_encode($suportes->toArray())], 200)
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

    $app->put('/suporte/edita/{id}', function(Request $request, Response $response) use($app) {
        $info = $request->getParsedBody();
        $data = $request->getAttribute('tokenD');

        $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

        $id = $request->getAttribute('id');
        $suporte = \WEB\PedidoSuporteQuery::create()->findOneById($id);

        if ($usuarioReq->getId() != $suporte->getIdusuarioCriador()) {
            return $response->withJson(["erro" => 'Somente o usuario criador pode alterar!'], 400)
                            ->withHeader('Content-type', 'application/json');
        }

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
        if ($info['titulo']) {
            $suporte->setTitulo($info['titulo']);
        }
        if ($info['descricao']) {
            $suporte->setDescricao($info['descricao']);
        }
        $suporte->save();
    });

    $app->put('/suporte/executar/{id}', function(Request $request, Response $response) use($app) {
        $suporte = \WEB\PedidoSuporteQuery::create()->findOneById($request->getAttribute('id'));
        if ($suporte->getIdusuarioExecutor()) {
            return $response->withJson(['erro' => 'Já existe uma usuario executando!'], 400)
                            ->withHeader('Content-type', 'application/json');
        }

        $data = $request->getAttribute('tokenD');
        $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

        $suporte->setIdusuarioExecutor($usuarioReq->getId());
        if ($suporte->save()) {
            return $response->withJson([], 200)
                            ->withHeader('Content-type', 'application/json');
        }
        return $response->withJson([], 400)
                        ->withHeader('Content-type', 'application/json');
    })->add($verify);

    $app->post('/suporte/mensagem/{id}', function(Request $request, Response $response) use($app) {
        $suporte = \WEB\PedidoSuporteQuery::create()->findOneById($request->getAttribute('id'));
        $data = $request->getAttribute('tokenD');
        $usuarioReq = WEB\UsuarioQuery::create()->filterByUsario($data->user)->filterById($data->id)->findOne();

        if ($suporte->getIdusuarioExecutor() != $usuarioReq->getId() && $suporte->getIdusuarioCriador() != $usuarioReq->getId()) {
            return $response->withJson(['erro' => 'Você não pode enviar uma mensagem nesse chamado!'], 400)
                            ->withHeader('Content-type', 'application/json');
        }
        $info = $request->getParsedBody();

        $mensagem = new WEB\Mensagens;
        if (!isset($info['mensagem'])) {
            return $response->withJson(['erro' => 'Mensagem não informada!'], 400)
                            ->withHeader('Content-type', 'application/json');
        }

        $mensagem->setUsuario($usuarioReq);
        $mensagem->setPedidoSuporte($suporte);
        $mensagem->setMensagem($info['mensagem']);

        if ($mensagem->save()) {
            return $response->withJson([], 200)
                            ->withHeader('Content-type', 'application/json');
        }
        return $response->withJson([], 400)
                        ->withHeader('Content-type', 'application/json');
    })->add($verify);

    $app->delete('/suporte/deletar/{id}', function(Request $request, Response $response) use($app) {
        $id = $request->getAttribute('id');
        $suporte = \WEB\PedidoSuporteQuery::create()->findOneById($id);
        if (!$suporte instanceof WEB\PedidoSuporte) {
            return $response->withJson(["erro" => 'Chamado não existe!'], 400)
                            ->withHeader('Content-type', 'application/json');
        }

        $mensagens = WEB\MensagensQuery::create()->findByIdpedidosuporte($suporte->getId());

        foreach ($mensagens as $mensagem) {
            $mensagem->delete();
        }
        $suporte->delete();
        return $response->withJson(["success" => "Chamado deletado com sucesso!"], 200)
                        ->withHeader('Content-type', 'application/json');
    })->add($verify);
    