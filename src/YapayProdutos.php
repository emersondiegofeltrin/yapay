<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace edfdans\yapay;

/**
 * Description of YapayProdutos
 *
 * @author Emerson
 */
class YapayProdutos {

    /**
     * Lista de produtos
     * @var array
     */
    private $lista = [];

    /**
     * Adiciona endereço ao cliente
     * 
     * @param string $codigo Código do produto
     * @param string $nome Nome do produto
     * @param numeric  $quantidade Quantidade do produto
     * @param numeric  $valorUnitario Valor unitário do produto
     * @param string $observacao Observação do produto
     * @return (integer) Retorna o index do objeto adicionado
     */
    public function adicionar($codigo, $nome, $quantidade, $valorUnitario, $observacao) {
        $tc = new Produtos();
        $tc->codigo($codigo);
        $tc->nome($nome);
        $tc->quantidade($quantidade);
        $tc->valorUnitario($valorUnitario);
        $tc->observacao($observacao);

        array_push($this->lista, $tc);

        return $this->getTotalLista() - 1;
    }

    /**
     * Remove produto
     * 
     * @param int $index Index da lista
     * @return (boolean)
     */
    public function remover($index) {
        if (isset($this->lista[$index])) {
            unset($this->lista[$index]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retorna a lista de produtos
     * @return (array) Retorna um array de Produtos
     */
    public function getLista() {
        return $this->lista;
    }

    /**
     * Retorna o total de itens da lista de produtos
     * @return (int)
     */
    public function getTotalLista() {
        return count($this->lista);
    }

    /**
     * Retorna um produto da lista
     * 
     * @param int $index Index da lista
     * @return (Produtos)
     */
    public function getIndexLista($index) {
        if (isset($this->lista[$index])) {
            return $this->lista[$index];
        } else {
            return new Produtos();
        }
    }

}
