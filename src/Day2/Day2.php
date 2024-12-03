<?php

namespace AOC2024\Day2;

use AOC2024\BaseClass;

class Day2 extends BaseClass
{
    public bool $withPerformance = false;

    public function setupPath() : void
    {
        $this->filePath = __DIR__ . '/input-example.txt';
    }

    public function run() : void
    {
        $this->part1();
        $this->part2();
    }

    public function part1() : void
    {
        $this->part1Answer = count($this->data);

        foreach ( $this->data as $line ) {
            $line_levels = array_map('intval', explode(' ', $line));
            
            $safe = true;
            $dir  = $line_levels[0] < $line_levels[1] ? 'asc' : 'desc';

            for ( $idx = 0; $idx < count($line_levels); $idx++ ) {
                if ( $safe === false ) {
                    $this->part1Answer--;
                    break;
                }

                if ( ! isset( $line_levels[$idx + 1] ) ) {
                    continue;
                }

                $first  = $line_levels[$idx];
                $second = $line_levels[$idx + 1];

                // Needs to be increasing / descreasing
                if ( $first === $second ) {
                    $safe = false;
                }

                // Based on the first two items increasing / decreasing the others must also increase / decrease.
                if ( $dir === 'asc' && $first > $second ) {
                    $safe = false;
                }

                // Based on the first two items increasing / decreasing the others must also increase / decrease.
                if ( $dir === 'desc' && $first < $second ) {
                    $safe = false;
                }

                $diff = abs($first - $second);
                if ( $diff > 3 ) {
                    $safe = false;
                }
            }
        }
    }

    public function part2() : void
    {
        $this->part2Answer = count($this->data);

        foreach ( $this->data as $line ) {
            $line_levels = array_map('intval', explode(' ', $line));

            $safe          = true;
            $removed_level = false;
            
            for ( $idx = 0; $idx < count($line_levels); $idx++ ) {
                if ( $safe === false ) {
                    $this->part2Answer--;
                    break;
                }
                
                if ( ! isset( $line_levels[$idx + 1] ) ) {
                    continue;
                }
                
                $first  = $line_levels[$idx];
                $second = $line_levels[$idx + 1];
                $dir    = $first < $second ? 'asc' : 'desc';

                // Needs to be increasing / descreasing
                if ( $first === $second ) {
                    $safe = false;
                }

                // Based on the first two items increasing / decreasing the others must also increase / decrease.
                if ( $dir === 'asc' && $first > $second ) {
                    $safe = false;
                }

                // Based on the first two items increasing / decreasing the others must also increase / decrease.
                if ( $dir === 'desc' && $first < $second ) {
                    $safe = false;
                }

                $diff = abs($first - $second);
                if ( $diff > 3 ) {
                    $safe = false;
                }

                if ( $safe === false && $removed_level === false ) {
                    $safe          = true;
                    $removed_level = true;
                    unset( $line_levels[ $idx + 1 ] );
                    $idx--;
                    if ( $idx < 0 ) {
                        $idx = 0;
                    }
                }
            }
        }
    }
}
