<?php

namespace emersondiegofeltrin\yapay;

/**
 * Classe utilizada para organizar os objetos dos endereços dos clientes
 */
class ClienteEndereco {

    /**
     * Tipo do endereço
     * @var YapayClienteEnderecoTipo
     */
    private $tipo = YapayClienteEnderecoTipo::ENTREGA;

    /**
     * Logradouro do endereço
     * @var string
     */
    private $logradouro = '';

    /**
     * Número do endereço
     * @var string
     */
    private $numero = '';

    /**
     * Complemento do endereço
     * @var string
     */
    private $complemento = '';

    /**
     * Bairro do endereço
     * @var string
     */
    private $bairro = '';

    /**
     * Cidade do endereço
     * @var string
     */
    private $cidade = '';

    /**
     * UF do endereço
     * @var string
     */
    private $uf = '';

    /**
     * CEP do endereço
     * @var string
     */
    private $cep = '';

    /**
     * Atribui e retorna o tipo do endereço
     *
     * @param YapayClienteEnderecoTipo $valor [opcional]
     * 
     * Opções:
     * YapayClienteEnderecoTipo::COBRANCA
     * YapayClienteEnderecoTipo::ENTREGA
     * 
     * @return (string)
     */
    public function tipo($valor = false) {
        if ($valor === false) {
            return $this->tipo;
        } else {
            if (in_array($valor, [YapayClienteEnderecoTipo::COBRANCA, YapayClienteEnderecoTipo::ENTREGA])) {
                $this->tipo = $valor;
            } else {
                throw new Exception('Tipo do endereço não permitido!');
            }
        }
    }

    /**
     * Atribui e retorna o logradouro do endereço
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function logradouro($valor = false) {
        if ($valor === false) {
            return $this->logradouro;
        } else {
            $this->logradouro = $valor;
        }
    }

    /**
     * Atribui e retorna o número do endereço
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function numero($valor = false) {
        if ($valor === false) {
            return $this->numero;
        } else {
            $this->numero = $valor;
        }
    }

    /**
     * Atribui e retorna o complemento do endereço
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function complemento($valor = false) {
        if ($valor === false) {
            return $this->complemento;
        } else {
            $this->complemento = $valor;
        }
    }

    /**
     * Atribui e retorna o bairro do endereço
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function bairro($valor = false) {
        if ($valor === false) {
            return $this->bairro;
        } else {
            $this->bairro = $valor;
        }
    }

    /**
     * Atribui e retorna a cidade do endereço
     * 
     * @param string $valor [opcional]
     * @return (string)
     */
    public function cidade($valor = false) {
        if ($valor === false) {
            return $this->cidade;
        } else {
            $this->cidade = $valor;
        }
    }

    /**
     * Atribui e retorna a UF do endereço
     * 
     * @param string $valor [opcional]
     * 
     * Use a sigla com dois caracteres, ex: PR
     * 
     * @return (string)
     */
    public function UF($valor = false) {
        if ($valor === false) {
            return $this->uf;
        } else {
            if (strlen($valor) == 2) {
                if (preg_match('/^[A-Z]{2}$/', $valor)) {
                    $this->uf = $valor;
                } else {
                    throw new Exception('UF inválida!');
                }
            } else {
                throw new Exception('UF inválida!');
            }
        }
    }

    /**
     * CEP do endereço
     * 
     * @param string $valor [opcional]
     * 
     * Formato 99999-999
     * 
     * @return (string)
     */
    public function cep($valor = false) {
        if ($valor === false) {
            return $this->cep;
        } else {
            if (preg_match('/^[0-9]{5}\-[0-9]{3}$/', $valor)) {
                $this->cep = $valor;
            } else {
                throw new Exception('CEP inválido!');
            }
        }
    }

}
