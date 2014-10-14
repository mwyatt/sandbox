<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace OrnoTest\Http;

use Orno\Http\Response;

class ResponseTest extends \PHPUnit_Framework_Testcase
{
    /**
     * Asserts that cookie params are set and returned
     *
     * @return void
     */
    public function testCookieParamsSetAndReturned()
    {
        $response = new Response;

        $this->assertInternalType('array', $response->cookie());
        $this->assertSame($response->cookie('default', 'default_value'), 'default_value');
    }

    /**
     * Asserts that headers params are set and returned
     *
     * @return void
     */
    public function testHeadersParamsSetAndReturned()
    {
        $response = new Response;

        $response->headers()->set('param', 'value');

        $this->assertSame($response->headers('param'), 'value');
        $this->assertSame($response->headers('default', 'default_value'), 'default_value');
    }
}
