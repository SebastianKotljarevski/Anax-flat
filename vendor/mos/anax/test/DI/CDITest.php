<?php

namespace Anax\DI;

/**
 * Testing the Dependency Injector service container.
 *
 */
class CDITest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     *
     * @return void
     *
     * @expectedException \Exception
     */
    public function testLoadFailesInServiceCreation()
    {
        $di = new CDI();
        $service = 'failsWithException';

        $di->set($service, function () {
            throw new \Anax\Exception("Failed creating service.");
        });

        $di->get($service);
    }



    /**
     * Test
     *
     * @return void
     *
     */
    public function testOverwritePreviousDefinedService()
    {
        $di = new CDIFactoryDefault();
        $service = 'session';

        $di->set($service, function () {
            $session = new \Anax\Session\CSession();
            $session->configure('session.php');
            $session->name();
            //$session->start();
            return $session;
        });

        $session = $di->get($service);
        $this->assertInstanceOf('\Anax\Session\CSession', $session);
    }
}
