<?php

namespace AOC2024\Day1;

use AOC2024\BaseClass;

class Day1 extends BaseClass
{
    public bool $withPerformance = false;

    public function setupPath() : void
    {
        $this->filePath = __DIR__ . '/input-example.txt';
    }

    // public function parseInput() : void
    // {
    //     $pairs = [];

    //     foreach ($this->data as $line) {
    //         $numbers = explode("   ", $line);
    //         $pairs[] = [(int) $numbers[0], (int) $numbers[1]];
    //     }
    // }

    public function run() : void
    {
        // $this->parseInput();
    
        $this->part1();
        $this->part2();
    }

    public function part1() : void
    {
        dd($this->data);
    }

    public function part2() : void
    {
        
    }
}
