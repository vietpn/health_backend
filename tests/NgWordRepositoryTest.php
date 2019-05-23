<?php

use App\Models\NgWord;
use App\Repositories\NgWordRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NgWordRepositoryTest extends TestCase
{
    use MakeNgWordTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var NgWordRepository
     */
    protected $ngWordRepo;

    public function setUp()
    {
        parent::setUp();
        $this->ngWordRepo = App::make(NgWordRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateNgWord()
    {
        $ngWord = $this->fakeNgWordData();
        $createdNgWord = $this->ngWordRepo->create($ngWord);
        $createdNgWord = $createdNgWord->toArray();
        $this->assertArrayHasKey('id', $createdNgWord);
        $this->assertNotNull($createdNgWord['id'], 'Created NgWord must have id specified');
        $this->assertNotNull(NgWord::find($createdNgWord['id']), 'NgWord with given id must be in DB');
        $this->assertModelData($ngWord, $createdNgWord);
    }

    /**
     * @test read
     */
    public function testReadNgWord()
    {
        $ngWord = $this->makeNgWord();
        $dbNgWord = $this->ngWordRepo->find($ngWord->id);
        $dbNgWord = $dbNgWord->toArray();
        $this->assertModelData($ngWord->toArray(), $dbNgWord);
    }

    /**
     * @test update
     */
    public function testUpdateNgWord()
    {
        $ngWord = $this->makeNgWord();
        $fakeNgWord = $this->fakeNgWordData();
        $updatedNgWord = $this->ngWordRepo->update($fakeNgWord, $ngWord->id);
        $this->assertModelData($fakeNgWord, $updatedNgWord->toArray());
        $dbNgWord = $this->ngWordRepo->find($ngWord->id);
        $this->assertModelData($fakeNgWord, $dbNgWord->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteNgWord()
    {
        $ngWord = $this->makeNgWord();
        $resp = $this->ngWordRepo->delete($ngWord->id);
        $this->assertTrue($resp);
        $this->assertNull(NgWord::find($ngWord->id), 'NgWord should not exist in DB');
    }
}
