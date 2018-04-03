# Yapay
[![MIT license](https://img.shields.io/dub/l/vibe-d.svg)](http://opensource.org/licenses/MIT)

Esse pacote irá permitir o envio e consulta de pagamentos da Yapay.

### SOMENTE GERAÇÃO DE BOLETO

### CONSULTAR PAGAMENTO
```shell

$ya = new Yapay();
$ya->geral()->ambiente(YapayAmbiente::HOMOLOGACAO);
$ya->geral()->token(''); 
$ya->geral()->transacao('');

if ($ya->consultarPagamento()){
    print_r($ya->retorno());
    $ya->buscarBoleto($ya->retorno()->url(), 'teste.pdf');
}else{
    print_r($ya->retorno()->erros());
}

```

### ENVIAR PAGAMENTO
```shell

$ya = new Yapay();
$ya->geral()->ambiente(YapayAmbiente::HOMOLOGACAO);
$ya->geral()->token(''); 

$ya->geral()->desconto(0);
$ya->geral()->acrescimo(0);
$ya->geral()->dataVencimento(date('d/m/Y'));
$ya->geral()->observacao('Observação da fatura');

$ya->cliente()->nome('Cliente de teste');
$ya->cliente()->cpf('000.000.000-00');
$ya->cliente()->email('email@empresa.com.br');
$ya->cliente()->nomeFantasia('Empresa');
$ya->cliente()->razaoSocial('Empresa Ltda');
$ya->cliente()->cnpj('00.000.000/0000-00');

$ya->cliente()->contatos()->adicionar(YapayClienteContatoTipo::COMERCIAL, '(00) 00000000');
$ya->cliente()->enderecos()->adicionar(YapayClienteEnderecoTipo::COBRANCA, 'Rua XV de Novembro', '100', '', 'Centro', 'Cidade', 'UF', '99999-999');

$ya->produtos()->adicionar('1', 'Produto 1', 10, 1, 'Observação do produto');

if ($ya->enviarPagamento()){
    print_r($ya->retorno());
}else{
    print_r($ya->retorno()->erros());
}

```

