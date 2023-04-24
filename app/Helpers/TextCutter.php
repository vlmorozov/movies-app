<?php

namespace App\Helpers;

class TextCutter
{
    private const LENGTH_SHORT = 50;
    private const LENGTH_MIDDLE = 100;
    private const LENGTH_LONG = 255;

    public function cut(string $text, int $length): string
    {
        if (mb_strlen($text) <= $length) {
            return $text;
        }

        $text = mb_substr($text, 0, $length);

        if (false !== mb_strrpos($text, ' ')) {
            $text = mb_substr($text, 0, mb_strrpos($text, ' '));
        }

        return $text;
    }

    public function short(string $text): string
    {
        return $this->cut($text, self::LENGTH_SHORT);
    }

    public function middle(string $text): string
    {
        return $this->cut($text, self::LENGTH_MIDDLE);
    }

    public function long(string $text): string
    {
        return $this->cut($text, self::LENGTH_LONG);
    }
}
