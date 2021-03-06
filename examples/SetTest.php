<?php
use Eris\Generator;
use Eris\TestTrait;

class SetTest extends PHPUnit_Framework_TestCase
{
    use TestTrait;

    public function testSetsOfAnotherGeneratorsDomain()
    {
        $this->forAll(
            Generator\set(Generator\nat())
        )
            ->then(function($set) {
                $this->assertInternalType('array', $set);
                foreach ($set as $element) {
                    $this->assertGreaterThanOrEqual(0, $element);
                }
            });
    }

    public function testSubsetsOfASet()
    {
        $this->forAll(
            Generator\set([
                2, 4, 6, 8, 10
            ])
        )
            // the sizes generated are 0, 1, 3, 6
            ->withMaxSize(6)
            ->then(function($set) {
                $this->assertInternalType('array', $set);
                foreach ($set as $element) {
                    $this->assertTrue($this->isEven($element), "Element $element is not even, where did it come from?");
                }
            });
    }

    private function isEven($number)
    {
        return $number % 2 == 0;
    }
}
