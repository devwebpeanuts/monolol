<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class MorseCode implements Lolifier
{
    private $morseCodeMap = array(
        'A' => '.-',
        'B' => '-...',
        'C' => '-.-.',
        'D' => '-..',
        'E' => '.',
        'F' => '..-.',
        'G' => '--.',
        'H' => '....',
        'I' => '..',
        'J' => '.---',
        'K' => '-.-',
        'L' => '.-..',
        'M' => '--',
        'N' => '-.',
        'O' => '---',
        'P' => '.--.',
        'Q' => '--.-',
        'R' => '.-.',
        'S' => '...',
        'T' => '-',
        'U' => '..-',
        'V' => '...-',
        'W' => '.--',
        'X' => '-..-',
        'Y' => '-.--',
        'Z' => '--..',
        '0' => '-----',
        '1' => '.----',
        '2' => '..---',
        '3' => '...--',
        '4' => '....-',
        '5' => '.....',
        '6' => '-....',
        '7' => '--...',
        '8' => '---..',
        '9' => '----.',
        '.' => '.-.-.-',
        ',' => '--..--',
        '?' => '..--..',
        ':' => '---...',
        "'" => '.----.',
        '"' => '.-..-.',
        '-' => '-....-',
        '/' => '-..-.',
        '(' => '-.--.',
        ')' => '-.--.-',
        'Ä' => '.-.-',
        'Á' => '.--.-',
        'Å' => '.--.-',
        'É' => '..-..',
        'Ñ' => '--.--',
        'Ö' => '---.',
        'Ü' => '..--',
    );

    public function isHandling(array $record)
    {
        return true;
    }

    public function lolify(array $record)
    {
        $str = strtoupper($record['message']);
        $str = $this->harmonizeSpaces($str);
        $str = $this->addSpacesBetweenSymbols($str);
        $str = $this->replaceSymbolsByDotsAndDashes($str);
        $str = $this->replaceRealSpacesBySpacedSlashes($str);
        $str = $this->replaceUntranslatedSymbols($str);

        $record['message'] = $str;
        
        return $record;
    }

    private function harmonizeSpaces($str)
    {
        return trim(preg_replace('/\s+/i', ' ', $str));
    }

    private function addSpacesBetweenSymbols($str)
    {
        return trim(preg_replace('/(\S)/i', '$1 ', $str));
    }

    private function replaceSymbolsByDotsAndDashes($str)
    {
        return strtr($str, $this->morseCodeMap);
    }

    private function replaceRealSpacesBySpacedSlashes($str)
    {
        return preg_replace('/\s{2}/i', ' / ', $str);
    }

    private function replaceUntranslatedSymbols($str)
    {
        return preg_replace('/[^\.\-\s\/]/i', '?', $str);
    }
}
