<?php


namespace Financial\Model;

/**
 * Class CashFlowEntity
 * @package Financial\Model
 */
class CashFlowEntity
{
    const TYPE_INVESTMENT = 1;
    const TYPE_REVENUE  = 2;

    /**
     * @var float
     */
    private $value;

    /**
     * @var float
     */
    private $type;

    /**
     * @var int
     */
    private $dayOffset;

    /**
     * CashFlowEntity constructor.
     * @param float $type
     * @param float $value
     * @param int   $dayOffset
     */
    public function __construct($type, $value, $dayOffset)
    {
        $this->type = $type;
        $this->value = $value;
        $this->dayOffset = $dayOffset;
    }

    /**
     * @return int
     */
    public function getDayOffset()
    {
        return $this->dayOffset;
    }

    /**
     * @return float
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}
