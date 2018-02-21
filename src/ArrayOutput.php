<?php

namespace eiriksm\ArrayOutput;

use Symfony\Component\Console\Output\Output;

class ArrayOutput extends Output
{

    private $lines;

    private $delta;

    public function clear()
    {
        $this->lines = [];
        $this->delta = 0;
    }

    public function fetch()
    {
        return $this->lines;
    }

    /**
     * {@inheritdoc}
     */
    public function __construct($verbosity = self::VERBOSITY_NORMAL, $decorated = false, $formatter = null)
    {
        parent::__construct($verbosity, $decorated, $formatter);
        $this->lines = [];
        $this->delta = 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function doWrite($message, $newline)
    {
        if (empty($this->lines[$this->delta])) {
            $this->lines[$this->delta] = [];
        }
        if ($message) {
            $this->lines[$this->delta][] = trim($message);
        }
        if ($newline) {
            $this->delta++;
        }
    }
}
