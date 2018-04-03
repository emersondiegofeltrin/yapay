<?php

namespace edfdans\yapay;

/**
 * Classe utilizada para organizar os objetos dos produtos
 */
class Produtos {

    /**
     * Código do produto
     * @var string
     */
    private $codigo = '';

    /**
     * Nome do produto
     * @var string
     */
    private $nome = '';

    /**
     * Quantidade do produto
     * @var numeric
     */
    private $quantidade = 1;

    /**
     * Valor unitário do produto
     * @var numeric
     */
    private $valorUnitario = 0;

    /**
     * Observação do produto
     * @var string
     */
    private $observacao = '';

    /**
     * Atribui e retorna o código do produto
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function codigo($valor = false) {
        if ($valor === false) {
            return $this->codigo;
        } else {
            $this->codigo = $valor;
        }
    }

    /**
     * Atribui e retorna o nome do produto
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
     * Atribui e retorna a quantidade do produto
     * 
     * @param numeric $valor [opcional]
     * @return (numeric)
     */
    public function quantidade($valor = false) {
        if ($valor === false) {
            return $this->quantidade;
        } else {
            $this->quantidade = $valor;
        }
    }

    /**
     * Atribui e retorna o valor unitário do produto
     * 
     * @param numeric $valor [opcional]
     * @return (numeric)
     */
    public function valorUnitario($valor = false) {
        if ($valor === false) {
            return $this->valorUnitario;
        } else {
            $this->valorUnitario = $valor;
        }
    }

    /**
     * Atribui e retorna a observação do produto
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function observacao($valor = false) {
        if ($valor === false) {
            return $this->observacao;
        } else {
            $this->observacao = $valor;
        }
    }

}
