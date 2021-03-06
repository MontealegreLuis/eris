<?php
namespace Eris\Generator;

use Eris\Generator;

function oneOf(/*$a, $b, ...*/)
{
    return new OneOfGenerator(func_get_args());
}

class OneOfGenerator implements Generator
{
    private $generator;

    public function __construct($generators) {
        $this->generator = new FrequencyGenerator($this->allWithSameFrequency($generators));
    }

    public function __invoke($size)
    {
        return $this->generator->__invoke($size);
    }

    public function shrink($element)
    {
        return $this->generator->shrink($element);
    }

    public function contains($element)
    {
        return $this->generator->contains($element);
    }

    private function allWithSameFrequency($generators)
    {
        return array_map(
            function($generator) {
                return [1, $generator];
            },
            $generators
        );
    }
}
