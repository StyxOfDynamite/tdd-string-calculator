<?php

namespace App;

class StringCalculator
{
    private $delimeter = ',';

    protected function getDelimiter()
    {
        return $this->delimeter;
    }

    protected function setDelimiter($delimeter) {
        $this->delimeter = $delimeter;
        return $this;
    }

    public function add(string $input) : int
    {
        $input = $this->processInput($input);
    
        if (count($array = \explode(',', $input))) {
            return $this->sum($array);
        }

        return \intval($input);
    }

    private function processInput($input)
    {
        $this->handleEmptyInput($input);

        $this->extractCustomDelimeter($input);

        $input =  $this->normaliseNewLines($input);

        return $this->normaliseDelimeter($input);
    }

    private function normaliseDelimeter($input)
    {
        return \preg_replace('/' . $this->getDelimiter() .'/', ",", $input);
    }

    private function extractCustomDelimeter(string $input = null)
    {
        if (\strpos($input, '//') === 0) {
            \preg_match("/\/\/(.)\\n/", $input, $matches);
            $this->setDelimiter(\array_pop($matches));
        }
    }

    private function normaliseNewLines(string $input = null)
    {
        return str_replace("\n", ',', $input);
    }

    private function sum(array $array)
    {
        return array_reduce($array, function ($carry, $item) {
            if (intval($item) < 0) {
                throw new \InvalidArgumentException(\sprintf("Negatives not allowed %d", $item));
            }
            return $carry + intval($item);
        }, 0);
    }

    private function handleEmptyInput(string $input)
    {
        if (empty($input)) {
            return 0;
        }
    }
}
