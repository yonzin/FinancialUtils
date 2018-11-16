<?php

namespace Financial\Calculator;

use Financial\Math\NewtonRaphsonMethod;
use Financial\Model\CashFlowEntity;
use Financial\Model\InvestmentInterface;
use Financial\Util\Calendar;
use Financial\Util\FunctionCall;

/**
 * Class APR
 */
class APR implements CalculatorInterface
{
    /**
     * @var NewtonRaphsonMethod
     */
    private $newtonRaphsonMethod;

    /**
     * @param NewtonRaphsonMethod $newtonRaphsonMethod
     */
    public function __construct(NewtonRaphsonMethod $newtonRaphsonMethod)
    {
        $this->newtonRaphsonMethod = $newtonRaphsonMethod;
    }

    /**
     * @param InvestmentInterface $investment
     *
     * @return float
     */
    public function calculate(InvestmentInterface $investment)
    {
        return CalculatorInterface::PERCENT_MULTIPLIER * $this->newtonRaphsonMethod->calculate(
            $this->prepareFx($investment),
            $this->prepareDx($investment),
            0
        );
    }

    /**
     * @param InvestmentInterface $investment
     *
     * @return FunctionCall
     */
    private function prepareFx(InvestmentInterface $investment)
    {
        return new FunctionCall(
            function ($i) use ($investment) {
                $result = 0;
                foreach ($investment->getCashFlow() as $payment) {
                    $exponential = -$payment->getDayOffset() / Calendar::DAY_OF_YEAR;

                    if ($payment->getType() == CashFlowEntity::TYPE_REVENUE) {
                        $result -= $payment->getValue() * pow(1 + $i, $exponential);
                    } else {
                        $result += $payment->getValue() * pow(1 + $i, $exponential);
                    }
                }

                return $result;
            }
        );
    }

    /**
     * @param InvestmentInterface $investment
     *
     * @return FunctionCall
     */
    private function prepareDx(InvestmentInterface $investment)
    {
        return new FunctionCall(
            function ($i) use ($investment) {
                $result = 0;
                foreach ($investment->getCashFlow() as $payment) {
                    $exponential = -$payment->getDayOffset() / Calendar::DAY_OF_YEAR;
                    if ($payment->getType() == CashFlowEntity::TYPE_REVENUE) {
                        $result -= $exponential * $payment->getValue() * pow(1 + $i, $exponential - 1);
                    } else {
                        $result += $exponential * $payment->getValue() * pow(1 + $i, $exponential - 1);
                    }
                }

                return $result;
            }
        );
    }
}