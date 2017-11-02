<?php

namespace Anax\Route;

/**
 * Routes.
 *
 */
class CRouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     *
     * @return void
     */
    public function testDefaultRoute()
    {
        $route = new \Anax\Route\CRouteBasic();
        
        $route->set('', null);
        $this->assertTrue($route->match(''));
        $this->assertFalse($route->match('-'));

        $route->set('*', null);
        $this->assertTrue($route->match(''));
        $this->assertTrue($route->match('controller'));
        $this->assertTrue($route->match('controller/action'));

        $route->set('doc', null);
        $this->assertFalse($route->match('do'));
        $this->assertFalse($route->match('docs'));
        $this->assertTrue($route->match('doc'));

        $route->set('doc/index', null);
        $this->assertFalse($route->match('doc'));
        $this->assertFalse($route->match('doc/inde'));
        $this->assertFalse($route->match('doc/indexx'));
        $this->assertTrue($route->match('doc/index'));

        $route->set('doc/*', null);
        $this->assertFalse($route->match('docs'));
        $this->assertTrue($route->match('doc'));
        $this->assertTrue($route->match('doc/'));
        $this->assertTrue($route->match('doc/index'));
        $this->assertTrue($route->match('doc/index/index'));

        $route->set('doc/*/index', null);
        $this->assertFalse($route->match('doc'));
        $this->assertFalse($route->match('doc/index'));
        $this->assertFalse($route->match('doc/index/index1'));
        $this->assertTrue($route->match('doc/index/index'));

    }
}
