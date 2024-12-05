<?php

namespace AOC2024\Day4;

use AOC2024\BaseClass;

class Day4 extends BaseClass
{
    public bool $withPerformance = false;

    public int $rowCount;
    public int $colCount;

    public static array $directions = [
        'up_left'    => [-1, -1],
        'up'         => [0, -1],
        'up_right'   => [1, -1],
        'right'      => [1, 0],
        'down_right' => [1, 1],
        'down'       => [0, 1],
        'down_left'  => [-1, 1],
        'left'       => [-1, 0],
    ];

    public function setupPath() : void
    {
        $this->filePath = __DIR__ . '/input.txt';
    }

    public function run() : void
    {
        $this->rowCount = count($this->data);
        $this->colCount = strlen($this->data[0]);

        // $this->part1();
        $this->part2();
    }

    private function xmasCount(int $row, int $col, string $word, array $direction, int $index = 0): int
    {
        // Check for Out of Bounds
        if ( $row < 0 || $col < 0 ||
            $row >= $this->rowCount || $col >= $this->colCount ) {
            return 0;
        }
        
        $char = $this->data[$row][$col];

        if ($char === 'S' && $index === strlen($word) - 1) {
            return 1; // Found the word
        }

        // Mismatch
        if ( ! isset($word[$index]) || $char !== $word[$index] ) {
            return 0;
        }

        return $this->xmasCount(
            $row + $direction[0],
            $col + $direction[1],
            $word,
            $direction,
            $index + 1
        );
    }

    public function part1() : void
    {
        for ($row = 0; $row < $this->rowCount; $row++) {
            for($col = 0; $col < $this->colCount; $col++) {
                $char = $this->data[$row][$col];
                if ( $char === 'X' ) {
                    foreach ( self::$directions as $d ) {
                        $this->part1Answer += $this->xmasCount($row, $col, 'XMAS', $d);
                    }
                }
            }
        }
    }

    public function part2() : void
    {
        $this->part2Answer = 0;

        for ($row = 0; $row < $this->rowCount; $row++) {
            for($col = 0; $col < $this->colCount; $col++) {
                $char = $this->data[$row][$col];
                if ( $char === 'A' ) {
                    if ( $row === 0 || $col === 0 || $row === $this->rowCount - 1 || $col === $this->colCount - 1 ) {
                        continue;
                    }

                    // Check top left & bottom right.
                    if ( ( $this->data[$row - 1][$col - 1] === 'S'
                        && $this->data[$row + 1][$col + 1] === 'M' )
                        || ( $this->data[$row - 1][$col - 1] === 'M'
                        && $this->data[$row + 1][$col + 1] === 'S' )
                    ) {
                        // Check bottom left & top right.
                        if ( ( $this->data[$row + 1][$col - 1] === 'S'
                            && $this->data[$row - 1][$col + 1] === 'M' )
                            || ( $this->data[$row + 1][$col - 1] === 'M'
                            && $this->data[$row - 1][$col + 1] === 'S' )
                        ) {
                            $this->part2Answer++;
                        }
                    }

                }
            }
        }
    }
}
