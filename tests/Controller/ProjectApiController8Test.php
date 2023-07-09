<?php

namespace App\Controller;

use App\Project\CardFactory;
use App\Project\Deck;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController8Test extends WebTestCase
{
    public function testApiResults(): void
    {

        $client = static::createClient();


        $factory = $this->createMock(CardFactory::class);
        $factory->method('fullSet')->willReturn(
            [
                "8D","11C","4S","8H","10C","9D","9C","8S","2D","6C",
                "9S","9H","14D","8C","5S","3C","7S","13S","11H","6H",
                "4D","2H","2S","13H","11S","14S","6D","5H","10S","7C",
                "10H","7H","4C","3H","14H","12D","13C","6S","3S","14C",
                "4H","12C","5C","12S","10D","12H","5D","11D","3D","7D",
                "13D", "2C"
            ]
        );
        $deck = new Deck($factory);

        $container = $client->getContainer();
        $container->set(Deck::class, $deck);

        $client->request('POST', '/proj/api/results');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-results');

        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('"results":{"rows":{"0":{"name":"One Pair","points":2},"4":{"name":"One Pair","points":2},"3":{"name":"Full House","points":25},"2":{"name":"Four Of A Kind","points":50},"1":{"name":"Two Pairs","points":5}},"cols":{"0":{"name":"None","points":0},"2":{"name":"None","points":0},"4":{"name":"None","points":0},"1":{"name":"One Pair","points":2},"3":{"name":"Full House","points":25}},"total":111},"grid":{"cardCount":25,"rows":{"0":{"0":"2C","2":"14C","4":"6S","1":"14H","3":"7H"},"4":{"4":"13D","3":"7D","2":"11D","0":"13C","1":"10S"},"3":{"4":"3D","3":"5D","2":"3S","1":"3H","0":"5H"},"2":{"1":"12H","2":"12S","3":"5C","0":"12C","4":"12D"},"1":{"1":"10D","2":"4H","0":"4C","4":"10H","3":"7C"}}},"remaining cards":{"cards":["8D","11C","4S","8H","10C","9D","9C","8S","2D","6C","9S","9H","14D","8C","5S","3C","7S","13S","11H","6H","4D","2H","2S","13H","11S","14S","6D"]', $response);
    }
}
