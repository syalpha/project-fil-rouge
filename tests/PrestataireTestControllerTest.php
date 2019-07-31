<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PrestataireTestControllerTest extends WebTestCase
{
    public function testpresta()
    {
        $prest = static::createClient();
        $crawler = $prest->request('POST', '/prestataire',[],[],
        ['CONTENT_TYPE'=>"application/json"],
        '{("nomentreprise":"yonnel_service","ninea":"1df31sd3fe5f","numcompte":123456,"numregistre":789456
        ,"mail":"df@gamil.com","telephone":774457219,"adresse":"guediawaye","montant":100000)}'
        );
        $rep=$prest->getResponse();
        var_dump($rep);

        $this->assertSame(404,$prest->getResponse()->getStatusCode());
    }
}
