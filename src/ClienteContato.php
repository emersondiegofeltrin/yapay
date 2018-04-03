<?php

namespace emersondiegofeltrin\yapay;

/**
 * Classe utilizada para organizar os objetos dos contatos dos clientes
 */
class ClienteContato {

    /**
     * Tipo do contato
     * @var YapayClienteContatoTipo
     */
    private $tipo = YapayClienteContatoTipo::RESIDENCIAL;

    /**
     * Número do contato
     * @var string
     */
    private $numero = '';

    /**
     * Atribui e retorna o tipo do contato
     *
     * @param YapayClienteContatoTipo $valor [opcional]
     * 
     * Opções:
     * YapayClienteContatoTipo::RESIDENCIAL
     * YapayClienteContatoTipo::COMERCIAL
     * YapayClienteContatoTipo::CELULAR
     * 
     * @return (YapayClienteContatoTipo)
     */
    public function tipo($valor = false) {
        if ($valor === false) {
            return $this->tipo;
        } else {
            if (in_array($valor, [YapayClienteContatoTipo::RESIDENCIAL, YapayClienteContatoTipo::COMERCIAL, YapayClienteContatoTipo::CELULAR])) {
                $this->tipo = $valor;
            } else {
                throw new Exception('Tipo do contato não permitido!');
            }
        }
    }

    /**
     * Atribui e retorna o número do contato
     * 
     * @param string $valor [opcional]
     * 
     * Formato (99) 99999999X
     * 
     * @return (string)
     */
    public function numero($valor = false) {
        if ($valor === false) {
            return $this->numero;
        } else {
            if (preg_match('/^([0-9]{10,11})|(\([0-9]{2}\)\ [0-9]{8,9})$/', $valor)) {
                $this->numero = $valor;
            } else {
                throw new Exception('Número do contato inválido!');
            }
        }
    }

}
