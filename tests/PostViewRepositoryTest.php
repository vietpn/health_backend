<?php

use App\Models\PostView;
use App\Repositories\PostViewRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostViewRepositoryTest extends TestCase
{
    use MakePostViewTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PostViewRepository
     */
    protected $postViewRepo;

    public function setUp()
    {
        parent::setUp();
        $this->postViewRepo = App::make(PostViewRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePostView()
    {
        $postView = $this->fakePostViewData();
        $createdPostView = $this->postViewRepo->create($postView);
        $createdPostView = $createdPostView->toArray();
        $this->assertArrayHasKey('id', $createdPostView);
        $this->assertNotNull($createdPostView['id'], 'Created PostView must have id specified');
        $this->assertNotNull(PostView::find($createdPostView['id']), 'PostView with given id must be in DB');
        $this->assertModelData($postView, $createdPostView);
    }

    /**
     * @test read
     */
    public function testReadPostView()
    {
        $postView = $this->makePostView();
        $dbPostView = $this->postViewRepo->find($postView->id);
        $dbPostView = $dbPostView->toArray();
        $this->assertModelData($postView->toArray(), $dbPostView);
    }

    /**
     * @test update
     */
    public function testUpdatePostView()
    {
        $postView = $this->makePostView();
        $fakePostView = $this->fakePostViewData();
        $updatedPostView = $this->postViewRepo->update($fakePostView, $postView->id);
        $this->assertModelData($fakePostView, $updatedPostView->toArray());
        $dbPostView = $this->postViewRepo->find($postView->id);
        $this->assertModelData($fakePostView, $dbPostView->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePostView()
    {
        $postView = $this->makePostView();
        $resp = $this->postViewRepo->delete($postView->id);
        $this->assertTrue($resp);
        $this->assertNull(PostView::find($postView->id), 'PostView should not exist in DB');
    }
}
