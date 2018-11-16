<?php


namespace Financial\Util;

/**
 * Class FunctionCall
 * @package Financial\Util
 */
class FunctionCall
{

    private $callback;

    /**
     * FunctionCall constructor.
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param mixed $argument
     *
     * @return mixed
     */
    public function run($argument)
    {
        return call_user_func($this->callback, $argument);
    }
}
