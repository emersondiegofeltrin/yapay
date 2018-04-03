<?php

namespace edfdans\yapay;

/**
 * Classe utilizada para gerenciar as configurações do pagamento
 */
class YapayGeral {

    /**
     * Ambiente do sistema de pagamento
     * @var YapayAmbiente
     */
    private $ambiente = YapayAmbiente::HOMOLOGACAO;

    /**
     * Data de vencimento boleto
     * @var date
     */
    private $dataVencimento;

    /**
     * Valor do desconto
     * @var numeric
     */
    private $desconto = 0;

    /**
     * Valor do acrescimo
     * @var numeric
     */
    private $acrescimo = 0;

    /**
     * Transação do pagamento
     * @var string
     */
    private $transacao = '';

    /**
     * Quantidade de parcelas para pagamento
     * @var int
     */
    private $parcelas = 1;

    /**
     * Número do pedido
     * @var string
     */
    private $pedido = '';

    /**
     * Observação do pedido
     * @var string
     */
    private $observacao = '';

    /**
     * Forma de pagamento
     * @var YapayClienteFormaPagamento
     */
    private $pagamento;

    /**
     * Token para pagamento
     * @var string
     */
    private $token = '';

    /**
     * Atribui e retorna o ambiente do sistema de pagamento
     * 
     * @param YapayAmbiente $valor [opcional]
     * @return (YapayAmbiente)
     */
    public function ambiente($valor = false) {
        if ($valor === false) {
            return $this->ambiente;
        } else {
            if (in_array($valor, [YapayAmbiente::HOMOLOGACAO, YapayAmbiente::PRODUCAO])) {
                $this->ambiente = $valor;
            } else {
                throw new Exception('Ambiente informado desconhecido');
            }
        }
    }

    /**
     * Atribui e retorna a data de vencimento
     * 
     * @param date $valor [opcional]
     * 
     * Formato dd/mm/yyyy Ex: date('d/m/y')
     * 
     * @return (date)
     */
    public function dataVencimento($valor = false) {
        if ($valor === false) {
            return $this->dataVencimento;
        } else {
            if (preg_match('/^([0-2]{1}[0-9]{1}|3[0-1]{1})\/(0[1-9]{1}|1[0-2]{1})\/[0-9]{4}$/', $valor)) {
                $this->dataVencimento = $valor;
            } else {
                throw new Exception('Data de vencimento inválida!');
            }
        }
    }

    /**
     * Atribui e retorna o valor do desconto
     * 
     * @param numeric $valor [opcional]
     * @return (numeric)
     */
    public function desconto($valor = false) {
        if ($valor === false) {
            return $this->desconto;
        } else {
            $this->desconto = $valor;
        }
    }

    /**
     * Atribui e retorna o valor do acréscimo
     * 
     * @param numeric $valor [opcional]
     * @return (numeric)
     */
    public function acrescimo($valor = false) {
        if ($valor === false) {
            return $this->acrescimo;
        } else {
            $this->acrescimo = $valor;
        }
    }

    /**
     * Atribui e retorna a observação do pagamento
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

    /**
     * Atribui e retorna a forma de pagamento
     * 
     * @param YapayClienteFormaPagamento $valor [opcional]
     * @return (YapayClienteFormaPagamento)
     */
    public function pagamento($valor = false) {
        if ($valor === false) {
            return $this->pagamento;
        } else {
            if (in_array($valor, [YapayClienteFormaPagamento::BOLETO])) {
                $this->pagamento = $valor;
            } else {
                throw new Exception('Tipo de pagamento não permitido!');
            }
        }
    }

    /**
     * Atribui e retorna as parcelas
     * 
     * @param int $valor [opcional]
     * @return (int)
     */
    public function parcelas($valor = false) {
        if ($valor === false) {
            return $this->parcelas;
        } else {
            $this->parcelas = $valor;
        }
    }

    /**
     * Atribui e retorna o número do pedido
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function pedido($valor = false) {
        if ($valor === false) {
            return $this->pedido;
        } else {
            $this->pedido = $valor;
        }
    }

    /**
     * Atribui e retorna o token para pagamento
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
     * Atribui e retorna a transação do pagamento
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

}
