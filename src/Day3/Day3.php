<?php

namespace AOC2024\Day3;

use AOC2024\BaseClass;

class Day3 extends BaseClass
{
    public bool $withPerformance = false;

    public function setupPath() : void
    {
        $this->filePath = __DIR__ . '/input.txt';
    }

    public function run() : void
    {
        $this->part1();
        $this->part2();
    }

    private function getMulSum(array $strings): int
    {
        $regex   = '/mul\(\d{1,3}\,\d{1,3}\)/';
        $matches = [];
        $total   = 0;

        $string = array_reduce($strings, function($carry, $line) {
            return $carry . $line;
        });

        preg_match_all($regex, $string, $matches);

        foreach ( $matches[0] as $match ) {
            $numbers = [];
            preg_match('/(\d{1,3})?\,(\d{1,3})?/', $match, $numbers);
            $a     = intval($numbers[1]);
            $b     = intval($numbers[2]);

            $total += $a * $b;
        }

        return $total;
    }

    public function part1() : void
    {
        $this->part1Answer = $this->getMulSum($this->data);
    }

    public function part2() : void
    {
        $string = array_reduce($this->data, function($carry, $line) {
            return $carry . $line;
        });

        $do = true;
        $string_len = strlen($string);
        $mul_pairs = [];

        for ($idx = 0; $idx < $string_len; $idx++) {
            $char = $string[$idx];
            // Check if we have a "do()" or don't() command and flip the $do accordingly.
            if ( $char === 'd' ) {
                if (substr($string, $idx, 4) === 'do()') {
                    // dump('DO');
                    $do = true;
                } elseif (substr($string, $idx, 7) === "don't()") {
                    // dump('DONT');
                    $do = false;
                }
            }

            if ( $char === 'm' && $do === true ) {
                // Extract the next 12 characters (maximum length of "mul(999,999)")
                $substring = substr($string, $idx, 12);

                // Check if it matches the "mul(%d,%d)" pattern.
                if (preg_match('/^mul\((\d{1,3}),(\d{1,3})\)/', $substring, $matches)) {
                    $num1 = (int) $matches[1];
                    $num2 = (int) $matches[2];

                    // dump('ADD PAIR: ' . $num1 . ', ' . $num2);

                    $mul_pairs[] = [$num1, $num2];
                }
            }
        }

        $this->part2Answer = array_reduce($mul_pairs, function($carry, $pair) {
            return $carry + ($pair[0] * $pair[1]);
        });
    }
}
