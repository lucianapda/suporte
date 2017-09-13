<?php

namespace WEB;

use WEB\Base\PedidoSuporte as BasePedidoSuporte;

/**
 * Skeleton subclass for representing a row from the 'PEDIDO_SUPORTE' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class PedidoSuporte extends BasePedidoSuporte {

    public function verficaTipo($tipo) {
        $tipo = strtolower($tipo);
        switch ($tipo) {
            case 'problema':
                return true;
                break;
            case 'tarefa':
                return true;
                break;
            case 'novo':
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    public function verficaArea($area) {
        $area = strtolower($area);
        switch ($area) {
            case 'vendas':
                return true;
                break;
            case 'desenvolvimento':
                return true;
                break;
            case 'marketing':
                return true;
                break;
            case 'infraestrutura':
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    public function verficaStatus($status) {
        $status = strtolower($status);
        switch ($status) {
            case 'enviada':
                return true;
                break;
            case 'andamento':
                return true;
                break;
            case 'finalizada':
                return true;
                break;
            default:
                return false;
                break;
        }
    }

}
