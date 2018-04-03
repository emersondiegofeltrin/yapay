<?php

namespace emersondiegofeltrin\yapay;

/**
 * Classe utilizada para organizar os status dos pagamentos
 */
class YapayStatus {

    /**
     * Aguardando pagamento
     * @var integer
     */
    const AGUARDANDOPAGAMENTO = 4;

    /**
     * Pagamento em processamento
     * @var integer
     */
    const EMPROCESSAMENTO = 5;

    /**
     * Pagamento aprovado
     * @var integer
     */
    const APROVADA = 6;

    /**
     * Pagamento cancelado
     * @var integer
     */
    const CANCELADA = 7;

    /**
     * Pagamento em contestacao
     * @var integer
     */
    const EMCONTESTACAO = 24;

    /**
     * Pagamento em monitoramento
     * @var integer
     */
    const EMMONITORAMENTO = 87;

    /**
     * Pagamento em recuperação
     * @var integer
     */
    const EMRECUPERACAO = 88;

    /**
     * Pagamento reprovado
     * @var integer
     */
    const REPROVADA = 89;

}
