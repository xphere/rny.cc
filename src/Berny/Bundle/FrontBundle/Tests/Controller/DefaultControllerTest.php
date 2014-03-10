<?php

namespace Berny\Bundle\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group functional
 */
class DefaultControllerTest extends WebTestCase
{
    public function test_home_renders_successfully()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful(), 'Response is not successful');
        $this->assertCount(1, $crawler->filter('html head + body'), 'Response content must include <html> <head> and <body> tags');
        $this->assertCount(1, $crawler->filter('form[name=rnycc_urlshortener]'), 'Response must include url shortener form');
    }

    public function test_home_correct_url_generation()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $button = $crawler->selectButton('rnycc_urlshortener[save]');
        $form = $button->form();
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirection(), 'Must redirect before form processing');

        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isSuccessful(), 'Response before form processing must be successful');
        $this->assertSame('rnycc_frontpage', $client->getRequest()->attributes->get('_route'));
    }
}
