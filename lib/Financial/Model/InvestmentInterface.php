<?php


namespace Financial\Model;

/**
 * Interface InvestmentInterface
 * @package Financial\Model
 */
interface InvestmentInterface
{
    /**
     * @return CashFlowEntity[]
     */
    public function getCashFlow();
}
