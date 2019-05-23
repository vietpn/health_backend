<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NgWordApiTest extends TestCase
{
    use MakeNgWordTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateNgWord()
    {
        $ngWord = $this->fakeNgWordData();
        $this->json('POST', '/api/v1/ngWords', $ngWord);

        $this->assertApiResponse($ngWord);
    }

    /**
     * @test
     */
    public function testReadNgWord()
    {
        $ngWord = $this->makeNgWord();
        $this->json('GET', '/api/v1/ngWords/'.$ngWord->id);

        $this->assertApiResponse($ngWord->toArray());
    }

    /**
     * @test
     */
    public function testUpdateNgWord()
    {
        $ngWord = $this->makeNgWord();
        $editedNgWord = $this->fakeNgWordData();

        $this->json('PUT', '/api/v1/ngWords/'.$ngWord->id, $editedNgWord);

        $this->assertApiResponse($editedNgWord);
    }

    /**
     * @test
     */
    public function testDeleteNgWord()
    {
        $ngWord = $this->makeNgWord();
        $this->json('DELETE', '/api/v1/ngWords/'.$ngWord->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/ngWords/'.$ngWord->id);

        $this->assertResponseStatus(404);
    }
}
