<?php

namespace App;

class StringCalculator
{
    protected $delimeter = ",|\n";

    public function add(string $input = "")
    {
        $this->handleEmpty($input);

        return $this->addNumbers($this->parseNumbers($input));
    }

    private function parseNumbers($input)
    {
        $customDelimeter = '\/\/(.)\n';

        if (preg_match("/{$customDelimeter}/", $input, $matches)) {
            $this->delimeter = $matches[1];
            $input = str_replace($matches[0], '', $input);
        }

        return array_map('intval', preg_split("/{$this->delimeter}/", $input));
    }

    private function addNumbers($numbers)
    {
        return array_reduce($numbers, function ($carry, $item) {
           
            if ($item < 0) {
                throw new \InvalidArgumentException("No Negatives Allowed {$item}");
            }

            if ($item > 1000) {
                return $carry;
            }

            return $carry + $item;
        }, 0);
    }

    private function handleEmpty($input)
    {
        if (empty($input)) {
            return 0;
        }
    }
}
