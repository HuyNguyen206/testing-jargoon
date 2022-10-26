<?php


use PHPUnit\Framework\TestCase;

class PrimeFactorTest extends TestCase
{

    /**
     * @dataProvider data
     * @return void
     */
    public function test_it_generate_prime_factor_for_1($a, $b)
    {
        $this->assertEquals($a + 1, $b);
//        $factor = new PrimeFactor;
//
//        $this->assertEquals([], $factor->generate(1));
    }

    protected function data()
    {
        return [
            [1,2],
            [2,3]
        ];
    }
}
