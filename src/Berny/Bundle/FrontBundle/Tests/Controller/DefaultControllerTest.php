<?php

namespace Berny\Bundle\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHome()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertCount(1, $crawler->filter('html head + body'));
        $this->assertCount(1, $crawler->filter('form'));

        $button = $crawler->selectButton('rnycc_urlshortener[save]');
        $form = $button->form();
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirection());

        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
