<?php

namespace AOC2024\Day1;

use AOC2024\BaseClass;

class Day1 extends BaseClass
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

    /**
     * Insert a value into a sorted array at the correct position.
     */
    private function insertInOrder(array &$array, int $value): void
    {
        // Binary search for the correct position
        $low = 0;
        $high = count($array);

        while ($low < $high) {
            $mid = intdiv($low + $high, 2);
            if ($array[$mid] < $value) {
                $low = $mid + 1;
            } else {
                $high = $mid;
            }
        }

        // Insert at the found position
        array_splice($array, $low, 0, $value);
    }

    public function part1() : void
    {
        $left  = [];
        $right = [];

        // Sort into left / right.
        foreach ( $this->data as $line ) {
            $pair = array_map('intval', preg_split('/\s+/', trim($line)));

            // Insert into the left array in sorted order.
            $this->insertInOrder($left, $pair[0]);

            // Insert into the right array in sorted order.
            $this->insertInOrder($right, $pair[1]);
        }

        $this->part1Answer = 0;

        foreach ( $left as $l_idx => $l_item ) {
            $r_item = $right[$l_idx];

            $this->part1Answer += abs($l_item - $r_item);
        }
    }

    public function part2() : void
    {
        $left  = [];
        $right = [];

        foreach ( $this->data as $line ) {
            $pair = array_map('intval', preg_split('/\s+/', trim($line)));

            // Insert into left normally.
            $left[] = $pair[0];

            // Right is a map of the number of times we've seen it.
            if ( isset( $right[$pair[1]] ) ) {
                $right[$pair[1]] += 1;
            } else {
                $right[$pair[1]] = 1;
            }
        }

        $this->part2Answer = 0;
        foreach ( $left as $l_item ) {
            if ( isset( $right[$l_item] ) ) {
                $this->part2Answer += $l_item * $right[$l_item];
            }
        }
    }
}
