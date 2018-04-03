<?php

namespace edfdans\yapay;

/**
 * Classe utilizada para gerenciar os endereços do clientes
 */
class YapayClienteEndereco {

    /**
     * Lista de contatos
     * @var array
     */
    private $lista = [];

    /**
     * Adiciona endereço ao cliente
     * 
     * @param YapayClienteEnderecoTipo $tipo Tipo do endereço
     * @param string $logradouro Logradouro do endereço
     * @param string $numero Número do endereço
     * @param string $complemento Complemento do endereço
     * @param string $bairro Bairro do endereço
     * @param string $cidade Cidade do endereço
     * @param string $uf UF do endereço
     * @param string $cep CEP do endereço
     * @return (integer) Retorna o index do objeto adicionado
     */
    public function adicionar($tipo, $logradouro, $numero, $complemento, $bairro, $cidade, $uf, $cep) {
        $tc = new ClienteEndereco();
        $tc->tipo($tipo);
        $tc->logradouro($logradouro);
        $tc->numero($numero);
        $tc->complemento($complemento);
        $tc->bairro($bairro);
        $tc->cidade($cidade);
        $tc->UF($uf);
        $tc->cep($cep);

        array_push($this->lista, $tc);

        return $this->getTotalLista() - 1;
    }

    /**
     * Remove endereço do cliente
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
     * Retorna a lista de endereços
     * @return (array) Retorna um array de ClienteEndereco
     */
    public function getLista() {
        return $this->lista;
    }

    /**
     * Retorna o total de itens da lista de endereços
     * @return (int)
     */
    public function getTotalLista() {
        return count($this->lista);
    }

    /**
     * Retorna um endereço da lista
     * 
     * @param int $index Index da lista
     * @return (ClienteEndereco)
     */
    public function getIndexLista($index) {
        if (isset($this->lista[$index])) {
            return $this->lista[$index];
        } else {
            return new ClienteEndereco();
        }
    }

}
