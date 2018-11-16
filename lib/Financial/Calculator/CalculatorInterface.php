<?php

namespace Financial\Calculator;

use Financial\Model\InvestmentInterface;

/**
 * Interface Calculator
 * @package Financial\Calculator
 */
interface CalculatorInterface
{
    const PERCENT_MULTIPLIER = 100.0;

    /**
     * @param InvestmentInterface $investment
     *
     * @return float
     */
    public function calculate(InvestmentInterface $investment);
}
