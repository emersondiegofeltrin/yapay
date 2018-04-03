<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace emersondiegofeltrin\yapay;

/**
 * Description of YapayRetorno
 *
 * @author Emerson
 */
class YapayRetorno {

    /**
     * Status da transação
     * @var string
     */
    private $status = '';

    /**
     * ID da transação
     * @var string
     */
    private $transacao = '';

    /**
     * Token da transação
     * @var string
     */
    private $token = '';

    /**
     * URL para pagamento
     * @var string
     */
    private $url = '';

    /**
     * Linha digitável boleto
     * @var string
     */
    private $linhaDigitavel = '';

    /**
     * XML do retorno
     * @var string
     */
    private $xml = '';

    /**
     * Lista de erros
     * @var array
     */
    private $erros = [];

    /**
     * Adiciona e retorna a lista de erros
     * 
     * @param string $valor [opcional]
     * @return (array)
     */
    public function erros($valor = false) {
        if ($valor === false) {
            return $this->erros;
        } else {
            array_push($this->erros, $valor);
        }
    }

    /**
     * Atribui e retorna o status da transação
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function status($valor = false) {
        if ($valor === false) {
            return $this->status;
        } else {
            $this->status = $valor;
        }
    }

    /**
     * Atribui e retorna o ID da transação
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function transacao($valor = false) {
        if ($valor === false) {
            return $this->transacao;
        } else {
            $this->transacao = $valor;
        }
    }

    /**
     * Atribui e retorna o token da transação
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function token($valor = false) {
        if ($valor === false) {
            return $this->token;
        } else {
            $this->token = $valor;
        }
    }

    /**
     * Atribui e retorna a URL para pagamento
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function url($valor = false) {
        if ($valor === false) {
            return $this->url;
        } else {
            $this->url = $valor;
        }
    }

    /**
     * Atribui e retorna a linha digitável para pagamento do boleto
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function linhaDigitavel($valor = false) {
        if ($valor === false) {
            return $this->linhaDigitavel;
        } else {
            $this->linhaDigitavel = $valor;
        }
    }

    /**
     * Atribui e retorna o xml do retorno
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function xml($valor = false) {
        if ($valor === false) {
            return $this->xml;
        } else {
            $this->xml = $valor;
        }
    }

}
