<?php

namespace Monolol\Lolifiers;

class MorseCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $this->assertTrue((new MorseCode())->isHandling(array()));
    }

    /**
     * @dataProvider providerTestMorseCode
     */
    public function testMorseCode($expected, $message)
    {
        $record = array('message' => $message);

        $lolified = (new MorseCode())->lolify($record);

        $this->assertSame($expected, $lolified['message']);
    }

    public function providerTestMorseCode()
    {
        return array(
            array('',''),
            array('.--. --- -. . -.--', 'poney'),
            array('.-.. --- .-. . -- / .. .--. ... ..- --', 'lorem ipsum'),
            array('.-.. --- .-. . -- / .. .--. ... ..- --', 'lorem    ipsum  '),
            array('.-.. --- .-. . -- / .. .--. ... ..- --', '	lorem  	  ipsum  '),
            array('.. -. - . .-. -. .- .-.. / ... . .-. ...- . .-. / . .-. .-. --- .-. ?', 'Internal server error!'),
            array('-.. --- / -. --- - / -... .-. . .- - .... . / -.-. --- -- .--. --- - . --..-- / .. - / -- .- -.- . ... / -.-- --- ..- / -.-. --- ..- --. ....','Do not breathe compote, it makes you cough'),
            array('. -. - .. - -.-- / ? ..... ---.. ----. / -. --- - / ..-. --- ..- -. -..', 'Entity #589 not found'),
            array('-... ..- .-. --. . .-. -....- .--. --- -. -.-- -....- ..- -. .. -.-. --- .-. -.', 'burger-pony-unicorn')
        );
    }
}
