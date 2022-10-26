<?php
namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    /**
     * @dataProvider data
     * @param $input
     * @param $expected
     * @return void
     */
    public function test_it_parse_string($input, $expected)
    {
        $result = (new TagParser())->parse($input);
        $this->assertEquals($expected, $result);
    }

    protected function data()
    {
        return [
            'single item' => ['personal', ['personal']],
            'comma and space' => ['personal, money, family', ['personal', 'money', 'family']],
            'pipe space' => ['personal | money | family', ['personal', 'money', 'family']],
            'comma no space' => ['personal,money,family', ['personal', 'money', 'family']],
            'pipe comma' => ['personal| money,family | friend, house', ['personal', 'money', 'family', 'friend', 'house']],
            'exclamation pipe space' => ['personal! money!family | friend! house', ['personal', 'money', 'family', 'friend', 'house']],
            'exclamation pipe comma space' => ['personal, money! family , friend | house', ['personal', 'money', 'family', 'friend', 'house']],
        ];
    }
}
