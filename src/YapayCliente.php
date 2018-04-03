<?php

namespace edfdans\yapay;

/**
 * Classe utilizada para gerenciar os clientes
 */
class YapayCliente {

    /**
     * Nome do cliente
     * @var string
     */
    private $nome = '';

    /**
     * CPF do cliente
     * @var string
     */
    private $cpf = '';

    /**
     * Email do cliente
     * @var string
     */
    private $email = '';

    /**
     * Nome fantasia do cliente
     * @var string
     */
    private $nomeFantasia = '';

    /**
     * Razão social do cliente
     * @var string
     */
    private $razaoSocial = '';

    /**
     * CNPJ do cliente
     * @var string
     */
    private $cnpj = '';

    /**
     * Contatos do cliente
     * @var YapayClienteContato
     */
    private $contatos;

    /**
     * Contatos do cliente
     * @var YapayClienteEndereco
     */
    private $enderecos;

    /**
     * Inicia a classe com o contato e endereço
     */
    public function __construct() {
        $this->contatos = new YapayClienteContato();
        $this->enderecos = new YapayClienteEndereco();
    }

    /**
     * Acessar os contatos do cliente
     * @return (YapayClienteContato)
     */
    public function contatos() {
        if (is_a($this->contatos, 'edfdans\yapay\YapayClienteContato')) {
            return $this->contatos;
        } else {
            return new YapayClienteContato();
        }
    }

    /**
     * Acessar os endereços do cliente
     * @return (YapayClienteEndereco)
     */
    public function enderecos() {
        if (is_a($this->enderecos, 'edfdans\yapay\YapayClienteEndereco')) {
            return $this->enderecos;
        } else {
            return new YapayClienteEndereco();
        }
    }

    /**
     * Atribui e retorna o nome do cliente
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function nome($valor = false) {
        if ($valor === false) {
            return $this->nome;
        } else {
            $this->nome = $valor;
        }
    }

    /**
     * Atribui e retorna o CPF do cliente
     * 
     * @param string $valor [opcional]
     * 
     * Formato 999.999.999-99
     * 
     * @return (string)
     */
    public function cpf($valor = false) {
        if ($valor === false) {
            return $this->cpf;
        } else {
            if (preg_match('/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/', $valor)) {
                $this->cpf = $valor;
            } else {
                throw new Exception('CPF no formato inválido!');
            }
        }
    }

    /**
     * Atribui e retorna o e-mail do cliente
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function email($valor = false) {
        if ($valor === false) {
            return $this->email;
        } else {
            $this->email = $valor;
        }
    }

    /**
     * Atribui e retorna o nome fantasia do cliente
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function nomeFantasia($valor = false) {
        if ($valor === false) {
            return $this->nomeFantasia;
        } else {
            $this->nomeFantasia = $valor;
        }
    }

    /**
     * Atribui e retorna a razão social do cliente
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function razaoSocial($valor = false) {
        if ($valor === false) {
            return $this->razaoSocial;
        } else {
            $this->razaoSocial = $valor;
        }
    }

    /**
     * Atribui e retorna o CNPJ do cliente
     * 
     * @param string $valor [opcional]
     * 
     * Formato 00.000.000/0000-00
     * 
     * @return (string)
     */
    public function cnpj($valor = false) {
        if ($valor === false) {
            return $this->cnpj;
        } else {
            if (preg_match('/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\/[0-9]{4}\-[0-9]{2}$/', $valor)) {
                $this->cnpj = $valor;
            } else {
                throw new Exception('CNPJ no formato inválido!');
            }
        }
    }

}
