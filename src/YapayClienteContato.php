<?php

namespace edfdans\yapay;

/**
 * Classe utilizada para gerenciar os contatos do clientes
 */
class YapayClienteContato {

    /**
     * Lista de contatos
     * @var array
     */
    private $lista = [];

    /**
     * Adiciona contato ao cliente
     * 
     * @param YapayClienteContatoTipo $tipo Tipo do contato
     * @param string $numero Número do contato
     * @return (integer) Retorna o index do objeto adicionado
     */
    public function adicionar($tipo, $numero) {
        $tc = new ClienteContato();
        $tc->tipo($tipo);
        $tc->numero($numero);

        array_push($this->lista, $tc);

        return $this->getTotalLista() - 1;
    }

    /**
     * Remove contato do cliente
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
     * Retorna a lista de contatos
     * @return (array) Retorna um array de ClienteContato
     */
    public function getLista() {
        return $this->lista;
    }

    /**
     * Retorna o total de itens da lista de contatos
     * @return (int)
     */
    public function getTotalLista() {
        return count($this->lista);
    }

    /**
     * Retorna um contato da lista
     * 
     * @param int $index Index da lista
     * @return (ClienteContato)
     */
    public function getIndexLista($index) {
        if (isset($this->lista[$index])) {
            return $this->lista[$index];
        } else {
            return new ClienteContato();
        }
    }

}
