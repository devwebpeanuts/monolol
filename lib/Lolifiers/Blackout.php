<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Blackout implements Lolifier
{
    const MESSAGE = '... ummm ... wait ... what were we talking about again ?';

    public function isHandling(array $record)
    {
        return true;
    }

    public function lolify(array $record)
    {
        $record['message'] = $this->forgotHalfSentence($record['message']);

        return $record;
    }

    private function forgotHalfSentence($message)
    {
        $nbWords = str_word_count($message);

        if($nbWords > 1)
        {
            $posHalfSentence = floor(strlen($message) / 2) + 1;
            $cut = substr($message, 0, $posHalfSentence);
            $cut = strrev(strpbrk(strrev($cut), " \t\n\r\0\x0B"));
            $message = $cut . self::MESSAGE;
        }

        return $message;
    }
}
