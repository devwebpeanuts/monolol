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
            ['I am not crazy, my mother ... hum ... i forgot the rest of this sentence', 'I am not crazy, my mother had me tested.'],
            ['Sorry I\'m late. I also got you a balloon, but ... hum ... i forgot the rest of this sentence', 'Sorry I\'m late. I also got you a balloon, but it floated away and I chased it for a while.'],
            [
                'Scissors cuts paper, paper covers rock, rock crushes lizard, lizard poisons Spock, Spock smashes scissors, scissors decapitates ... hum ... i forgot the rest of this sentence',
                'Scissors cuts paper, paper covers rock, rock crushes lizard, lizard poisons Spock, Spock smashes scissors, scissors decapitates lizard, lizard eats paper, paper disproves Spock, Spock vaporizes rock, and as it always has, rock crushes scissors.'
            ],
            [
                'En hiver, cette place est suffisamment proche du radiateur, du coup elle est bien chaude sans causer pour autant un phénomène de transpiration. Et en été c\'est pratique car elle est dans l\'axe d\'une petite brise provoquée par l\'ouverture de nos ... hum ... i forgot the rest of this sentence',
                'En hiver, cette place est suffisamment proche du radiateur, du coup elle est bien chaude sans causer pour autant un phénomène de transpiration. Et en été c\'est pratique car elle est dans l\'axe d\'une petite brise provoquée par l\'ouverture de nos fenêtres. Elle est en face de la télévision sans être tout à fait à angle droit, ce qui décourage la conversation mais ça ne cause pas d\'erreur de parallaxe. Je pourrais continuer longtemps, mais je crois que je me suis fais comprendre.'
            ],
        ];
    }
}