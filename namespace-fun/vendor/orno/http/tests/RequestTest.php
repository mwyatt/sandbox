<?php
/**
 * The Orno Component Library
 *
 * @author  Phil Bennett @philipobenito
 * @license MIT (see the LICENSE file)
 */
namespace OrnoTest\Http;

use Orno\Http\Request;

class RequestTest extends \PHPUnit_Framework_Testcase
{
    /**
     * Asserts that query params are set and returned
     *
     * @return void
     */
    public function testQueryParamsSetAndReturned()
    {
        $request = new Request;

        $request->query()->set('param', 'value');

        $this->assertSame($request->query('param'), 'value');
        $this->assertSame($request->query('default', 'default_value'), 'default_value');
    }

    /**
     * Asserts that post params are set and returned
     *
     * @return void
     */
    public function testPostParamsSetAndReturned()
    {
        $request = new Request;

        $request->post()->set('param', 'value');

        $this->assertSame($request->post('param'), 'value');
        $this->assertSame($request->post('default', 'default_value'), 'default_value');
    }

    /**
     * Asserts that server params are set and returned
     *
     * @return void
     */
    public function testServerParamsSetAndReturned()
    {
        $request = new Request;

        $request->server()->set('param', 'value');

        $this->assertSame($request->server('param'), 'value');
        $this->assertSame($request->server('default', 'default_value'), 'default_value');
    }

    /**
     * Asserts that files params are set and returned
     *
     * @return void
     */
    public function testFilesParamsSetAndReturned()
    {
        $request = new Request;

        $request->files()->set('param', ['key' => 'val']);

        $this->assertSame($request->files('param'), ['key' => 'val']);
        $this->assertSame($request->files('default', ['key' => 'default_val']), ['key' => 'default_val']);
    }

    /**
     * Asserts that cookie params are set and returned
     *
     * @return void
     */
    public function testCookieParamsSetAndReturned()
    {
        $request = new Request;

        $request->cookie()->set('param', 'value');

        $this->assertSame($request->cookie('param'), 'value');
        $this->assertSame($request->cookie('default', 'default_value'), 'default_value');
    }

    /**
     * Asserts that headers params are set and returned
     *
     * @return void
     */
    public function testHeadersParamsSetAndReturned()
    {
        $request = new Request;

        $request->headers()->set('param', 'value');

        $this->assertSame($request->headers('param'), 'value');
        $this->assertSame($request->headers('default', 'default_value'), 'default_value');
    }

    /**
     * Asserts that the correct uri segment is returned
     *
     * @return void
     */
    public function testUriSegmentReturnsCorrectSegment()
    {
        $request = Request::create('/acme/route/whatever');

        $this->assertSame('acme', $request->uriSegment(1));
        $this->assertSame('route', $request->uriSegment(2));
        $this->assertSame('whatever', $request->uriSegment(3));
    }
}
