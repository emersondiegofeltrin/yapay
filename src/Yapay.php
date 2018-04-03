<?php

namespace emersondiegofeltrin\yapay;

/**
 * Classe de pagamento para o yapay
 * 
 * Essa classe foi desenvolvida para agilizar o envio e consulta de pagamentos do
 * provedor do serviço de pagamento yapay.
 * Esse pacote é independente da empresa prestadora do serviço.
 *
 * Para iniciar utilize o exemplo teste.php
 * 
 * @package    emersondiegofeltrin
 * @subpackage yapay
 * @author     Emerson Diego Feltrin <emerson.diego.feltrin@gmail.com>
 * @version    1.0.0
 */
class Yapay {

    /**
     * Cliente
     * @var YapayCliente
     */
    private $cliente;

    /**
     * Geral
     * @var YapayGeral
     */
    private $geral;

    /**
     * Produtos
     * @var YapayProdutos
     */
    private $produtos;

    /**
     * Retorno da transação
     * @var YapayRetorno
     */
    private $retorno;

    /**
     * Gera os dados que serão enviados via post para a consulta da transação
     * @return (array)
     */
    private function consultaGerarDados() {
        return [
            'token_account' => $this->geral()->token(),
            'token_transaction' => $this->geral()->transacao()
        ];
    }

    /**
     * Retorna a URL que será usado na consulta da transação conforme o ambiente definido
     * @return (string)
     */
    private function consultaURL() {
        if ($this->geral()->ambiente() == YapayAmbiente::HOMOLOGACAO) {
            //return 'https://api.sandbox.traycheckout.com.br/v2/transactions/get_by_token';
            return 'https://api.intermediador.sandbox.yapay.com.br/api/v3/transactions/get_by_token';
        } else {
            //return 'https://api.traycheckout.com.br/v2/transactions/get_by_token';
            return 'http://api.intermediador.yapay.com.br/v3/transactions/get_by_token';
        }
    }

    /**
     * Gera os dados que serão enviados via post para o envio do pagamento
     * @return (array)
     */
    private function pagamentoGerarDados() {
        $dados = [];

        $dados['token_account'] = $this->geral()->token();
        $dados['customer[name]'] = $this->cliente()->nome();
        $dados['customer[cpf]'] = $this->cliente()->cpf();
        $dados['customer[email]'] = $this->cliente()->email();
        $dados['customer[trade_name]'] = $this->cliente()->nomeFantasia();
        $dados['customer[company_name]'] = $this->cliente()->razaoSocial();
        $dados['customer[cnpj]'] = $this->cliente()->cnpj();

        for ($i = 0; $i < $this->cliente()->contatos()->getTotalLista(); $i++) {
            $dados['customer[contacts][' . $i . '][type_contact]'] = $this->cliente()->contatos()->getIndexLista($i)->tipo();
            $dados['customer[contacts][' . $i . '][number_contact]'] = $this->cliente()->contatos()->getIndexLista($i)->numero();
        }

        for ($i = 0; $i < $this->cliente()->enderecos()->getTotalLista(); $i++) {
            $dados['customer[addresses][' . $i . '][type_address]'] = $this->cliente()->enderecos()->getIndexLista($i)->tipo();
            $dados['customer[addresses][' . $i . '][postal_code]'] = $this->cliente()->enderecos()->getIndexLista($i)->cep();
            $dados['customer[addresses][' . $i . '][street]'] = $this->cliente()->enderecos()->getIndexLista($i)->logradouro();
            $dados['customer[addresses][' . $i . '][number]'] = $this->cliente()->enderecos()->getIndexLista($i)->numero();
            $dados['customer[addresses][' . $i . '][neighborhood]'] = $this->cliente()->enderecos()->getIndexLista($i)->bairro();
            $dados['customer[addresses][' . $i . '][completion]'] = $this->cliente()->enderecos()->getIndexLista($i)->complemento();
            $dados['customer[addresses][' . $i . '][city]'] = $this->cliente()->enderecos()->getIndexLista($i)->cidade();
            $dados['customer[addresses][' . $i . '][state]'] = $this->cliente()->enderecos()->getIndexLista($i)->UF();
        }

        for ($i = 0; $i < $this->produtos()->getTotalLista(); $i++) {
            $dados['transaction_product[' . $i . '][code]'] = $this->produtos()->getIndexLista($i)->codigo();
            $dados['transaction_product[' . $i . '][description]'] = $this->produtos()->getIndexLista($i)->nome();
            $dados['transaction_product[' . $i . '][quantity]'] = $this->produtos()->getIndexLista($i)->quantidade();
            $dados['transaction_product[' . $i . '][price_unit]'] = $this->produtos()->getIndexLista($i)->valorUnitario();
            $dados['transaction_product[' . $i . '][extra]'] = $this->produtos()->getIndexLista($i)->observacao();
        }

        $dados['order_number'] = $this->geral()->pedido();
        $dados['free'] = $this->geral()->observacao();
        $dados['payment[payment_method_id]'] = $this->geral()->pagamento();
        $dados['payment[split]'] = $this->geral()->parcelas();
        $dados['payment[billet_date_expiration]'] = $this->geral()->dataVencimento();
        $dados['transaction[price_discount]'] = $this->geral()->desconto();
        $dados['transaction[price_additional]'] = $this->geral()->acrescimo();

        return $dados;
    }

    /**
     * Retorna a URL que será usado no envio do pagamento conforme o ambiente definido
     * @return (string)
     */
    private function pagamentoURL() {
        if ($this->geral()->ambiente() == YapayAmbiente::HOMOLOGACAO) {
            //return 'https://api.sandbox.traycheckout.com.br/v2/transactions/pay_complete';
            return 'https://api.intermediador.sandbox.yapay.com.br/api/v3/transactions/payment';
        } else {
            //return 'https://api.traycheckout.com.br/v2/transactions/pay_complete';
            return 'https://api.intermediador.yapay.com.br/api/v3/transactions/payment';
        }
    }

    /**
     * Inicia a classe com ambiente de homologação, pagamento em boleto e uma parcela
     */
    public function __construct() {
        $this->geral = new YapayGeral();
        $this->cliente = new YapayCliente();
        $this->produtos = new YapayProdutos();

        $this->geral()->ambiente(YapayAmbiente::HOMOLOGACAO);
        $this->geral()->pagamento(YapayClienteFormaPagamento::BOLETO);
        $this->geral()->parcelas(1);
    }

    /**
     * Busca o boleto a partir da URL da transação
     * 
     * @param string $url URL informada no retorno da transação
     * @param string $destino [opcional] informar para salvar o pdf em algum local
     * @return (string)
     */
    public function buscarBoleto($url, $destino = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $pdf = curl_exec($ch);

        curl_close($ch);

        if ($this->geral()->ambiente() == YapayAmbiente::PRODUCAO) {
            $html = explode('window.location = "', $pdf);

            if (count($html) >= 2) {
                $link = explode('"', $html[1])[0];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $link);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0');
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                $pdf = curl_exec($ch);
                curl_close($ch);
            }
        }

        if (!is_null($destino)) {
            file_put_contents($destino, $pdf);
        }

        return $pdf;
    }

    /**
     * Acessar os dados do cliente
     * @return (YapayCliente)
     */
    public function cliente() {
        if (is_a($this->cliente, 'emersondiegofeltrin\yapay\YapayCliente')) {
            return $this->cliente;
        } else {
            return new YapayCliente();
        }
    }

    /**
     * Consulta o pagamento a partir do token da transação
     * @return (boolean) Use $objeto->retorno() para acessar o retorno da consulta
     */
    public function consultarPagamento() {
        $url = $this->consultaURL();
        $dados = $this->consultaGerarDados();

        $this->retorno = new YapayRetorno();

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            $xml = curl_exec($ch);
            $erro = curl_error($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->retorno()->xml($xml);
            curl_close($ch);

            if ($code == '200') {
                $resposta = simplexml_load_string($xml);

                if ($resposta->message_response->message == 'success') {
                    $this->retorno()->status((string) $resposta->data_response->transaction->status_id);
                    $this->retorno()->transacao((string) $resposta->data_response->transaction->transaction_id);
                    $this->retorno()->token((string) $resposta->data_response->transaction->token_transaction);
                    $this->retorno()->url((string) $resposta->data_response->transaction->payment->url_payment);
                } else
                if (isset($resposta->error_response->errors)) {
                    foreach ($resposta->error_response->errors->error as $erro) {
                        $this->retorno()->erros((string) $erro->code . ' - ' . (string) $erro->message);
                    }
                }
            } else {
                $this->retorno()->erros($erro);
            }
        } catch (Exception $e) {
            $this->retorno()->erros($e->getMessage());
        }

        return empty($this->retorno()->erros());
    }

    /**
     * Envia o pagamento para o provedor do serviço de pagamento
     * @return (boolean) Use $objeto->retorno() para acessar o retorno da transação
     */
    public function enviarPagamento() {
        $url = $this->pagamentoURL();
        $dados = $this->pagamentoGerarDados();

        $this->retorno = new YapayRetorno();

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            $xml = curl_exec($ch);
            $erro = curl_error($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->retorno()->xml($xml);

            curl_close($ch);

            if ($code == '200') {
                $resposta = simplexml_load_string($xml);

                if ($resposta->message_response->message == 'success') {
                    $this->retorno()->status((string) $resposta->data_response->transaction->status_id);
                    $this->retorno()->transacao((string) $resposta->data_response->transaction->transaction_id);
                    $this->retorno()->token((string) $resposta->data_response->transaction->token_transaction);
                    $this->retorno()->url((string) $resposta->data_response->transaction->payment->url_payment);
                    $this->retorno()->linhaDigitavel((string) $resposta->data_response->transaction->payment->linha_digitavel);
                } else {
                    if (isset($resposta->error_response->general_errors)) {
                        foreach ($resposta->error_response->general_errors->general_error as $erro) {
                            $this->retorno()->erros((string) $erro->code . ' - ' . (string) $erro->message);
                        }
                    }

                    if (isset($resposta->error_response->validation_errors)) {
                        foreach ($resposta->error_response->validation_errors->validation_error as $erro) {
                            $this->retorno()->erros((string) $erro->message_complete);
                        }
                    }
                }
            } else {
                $this->retorno()->erros($erro);
            }
        } catch (Exception $e) {
            $this->retorno()->erros($e->getMessage());
        }

        return empty($this->retorno()->erros());
    }

    /**
     * Acessar os dados gerais
     * @return (YapayGeral)
     */
    public function geral() {
        if (is_a($this->geral, 'emersondiegofeltrin\yapay\YapayGeral')) {
            return $this->geral;
        } else {
            return new YapayGeral();
        }
    }

    public function pagamentoAberto() {
        return in_array($this->retorno()->status(), [YapayStatus::EMPROCESSAMENTO, YapayStatus::AGUARDANDOPAGAMENTO, YapayStatus::EMMONITORAMENTO, YapayStatus::EMRECUPERACAO]);
    }

    public function pagamentoEfetuado() {
        return $this->retorno()->status() == YapayStatus::APROVADA;
    }

    public function pagamentoReprovado() {
        return in_array($this->retorno()->status(), [YapayStatus::REPROVADA, YapayStatus::EMCONTESTACAO, YapayStatus::CANCELADA]);
    }

    /**
     * Acessar os dados dos produtos
     * @return (YapayProdutos)
     */
    public function produtos() {
        if (is_a($this->produtos, 'emersondiegofeltrin\yapay\YapayProdutos')) {
            return $this->produtos;
        } else {
            return new YapayProdutos();
        }
    }

    /**
     * Acessar os dados do retorna da transação
     * @return (YapayRetorno)
     */
    public function retorno() {
        if (is_a($this->retorno, 'emersondiegofeltrin\yapay\YapayRetorno')) {
            return $this->retorno;
        } else {
            return new YapayRetorno();
        }
    }

}
