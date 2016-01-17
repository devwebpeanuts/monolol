<?php

namespace Monolol\Lolifiers;

class BlackoutTest extends \PHPUnit_Framework_TestCase
{
    private $blackout;

    public function setUp()
    {
        parent::setUp();

        $this->blackout = new Blackout();
    }

    public function testHandling()
    {
        $this->assertTrue($this->blackout->isHandling(array()));
    }

    /**
     * @dataProvider blackoutProvider
     */
    public function testBlackout($expected, $message)
    {
        $record = array('message' => $message);
        $result = $this->blackout->lolify($record);

        $this->assertSame($expected, $result['message']);
    }

    public function blackoutProvider()
    {
        return [
            ['bazinga', 'bazinga'],
            ['I am not crazy, my ... ummm ... wait ... what were we talking about again ?', 'I am not crazy, my mother had me tested.'],
            ['Sorry I\'m late. I also got you a balloon, but ... ummm ... wait ... what were we talking about again ?', 'Sorry I\'m late. I also got you a balloon, but it floated away and I chased it for a while.'],
            [
                'Scissors cuts paper, paper covers rock, rock crushes lizard, lizard poisons Spock, Spock smashes scissors, scissors ... ummm ... wait ... what were we talking about again ?',
                'Scissors cuts paper, paper covers rock, rock crushes lizard, lizard poisons Spock, Spock smashes scissors, scissors decapitates lizard, lizard eats paper, paper disproves Spock, Spock vaporizes rock, and as it always has, rock crushes scissors.'
            ],
            [
                'En hiver, cette place est suffisamment proche du radiateur, du coup elle est bien chaude sans causer pour autant un phénomène de transpiration. Et en été c\'est pratique car elle est dans l\'axe d\'une petite brise provoquée par l\'ouverture de ... ummm ... wait ... what were we talking about again ?',
                'En hiver, cette place est suffisamment proche du radiateur, du coup elle est bien chaude sans causer pour autant un phénomène de transpiration. Et en été c\'est pratique car elle est dans l\'axe d\'une petite brise provoquée par l\'ouverture de nos fenêtres. Elle est en face de la télévision sans être tout à fait à angle droit, ce qui décourage la conversation mais ça ne cause pas d\'erreur de parallaxe. Je pourrais continuer longtemps, mais je crois que je me suis fais comprendre.'
            ],
            ["I\nam\n... ummm ... wait ... what were we talking about again ?", "I\nam\nnot\ncrazy"],
            ["I am not crazy,\nmy ... ummm ... wait ... what were we talking about again ?", "I am not crazy,\nmy mother had me tested."],
            ["I\tam\tnot\tcrazy,\nmy\n\r... ummm ... wait ... what were we talking about again ?", "I\tam\tnot\tcrazy,\nmy\n\rmother\thad me tested."],
        ];
    }
}
