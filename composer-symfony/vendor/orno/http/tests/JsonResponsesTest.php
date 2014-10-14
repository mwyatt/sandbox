<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace OrnoTest\Http;

use Orno\Http\JsonResponse;

class JsonResponsesTest extends \PHPUnit_Framework_Testcase
{
    /**
     * Assert that an Accepted response is cinstructed correctly
     *
     * @return void
     */
    public function testAcceptedJsonResonseIsConstructedCorrectly()
    {
        $response = new JsonResponse\AcceptedJsonResponse(['key' => 'value']);

        $this->assertJsonStringEqualsJsonString('{"key":"value"}', $response->getContent());
        $this->assertSame(202, $response->getStatusCode());
    }

    /**
     * Assert that an Created response is cinstructed correctly
     *
     * @return void
     */
    public function testCreatedJsonResonseIsConstructedCorrectly()
    {
        $response = new JsonResponse\CreatedJsonResponse(['key' => 'value']);

        $this->assertJsonStringEqualsJsonString('{"key":"value"}', $response->getContent());
        $this->assertSame(201, $response->getStatusCode());
    }

    /**
     * Assert that an No Content response is cinstructed correctly
     *
     * @return void
     */
    public function testNoContentJsonResonseIsConstructedCorrectly()
    {
        $response = new JsonResponse\NoContentJsonResponse;

        $this->assertSame(204, $response->getStatusCode());
    }

    /**
     * Assert that an Non Authoritative Information response is cinstructed correctly
     *
     * @return void
     */
    public function testNonAuthoritativeInformationJsonResonseIsConstructedCorrectly()
    {
        $response = new JsonResponse\NonAuthoritativeInformationJsonResponse(['key' => 'value']);

        $this->assertJsonStringEqualsJsonString('{"key":"value"}', $response->getContent());
        $this->assertSame(203, $response->getStatusCode());
    }

    /**
     * Assert that an Partial Content response is cinstructed correctly
     *
     * @return void
     */
    public function testPartialContentJsonResonseIsConstructedCorrectly()
    {
        $response = new JsonResponse\PartialContentJsonResponse(['key' => 'value']);

        $this->assertJsonStringEqualsJsonString('{"key":"value"}', $response->getContent());
        $this->assertSame(206, $response->getStatusCode());
    }

    /**
     * Assert that an Reset Content response is cinstructed correctly
     *
     * @return void
     */
    public function testResetContentJsonResonseIsConstructedCorrectly()
    {
        $response = new JsonResponse\ResetContentJsonResponse;

        $this->assertSame(205, $response->getStatusCode());
    }
}
