<?php

namespace Tests\Unit\Helpers;

use App\Helpers\TextCutter;
use PHPUnit\Framework\TestCase;

class TextCutterTest extends TestCase
{
    /**
     * @dataProvider cutDataProvider
     */
    public function test_cut(string $text, int $length, string $expected): void
    {
        $actual = (new TextCutter())->cut($text, $length);
        $this->assertEquals($expected, $actual);
        $this->assertLessThanOrEqual($length, mb_strlen($actual));
    }

    public function cutDataProvider(): array
    {
        return [
            [
                'Text text text text',
                11,
                'Text text'
            ],
            [
                '文字 文字 文字 文字',
                4,
                '文字'
            ],
        ];
    }
}
