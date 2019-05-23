<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProfileBusinessRequest;
use App\Http\Requests\Backend\UpdateProfileBusinessRequest;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostLike;
use App\Models\PostView;
use App\Repositories\Backend\ProfileBusinessRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use DB;

class ProfileBusinessController extends AppBaseController
{
    /** @var  ProfileBusinessRepository */
    private $profileBusinessRepository;

    public function __construct(ProfileBusinessRepository $profileBusinessRepo)
    {
        $this->profileBusinessRepository = $profileBusinessRepo;
    }

    /**
     * Display a listing of the ProfileBusiness.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');
        $profile_name = Input::get('profile_name', '');
        $location_string = Input::get('location_string', '');

        $query = DB::table('e_profile_bussines')
            ->orderBy('e_post.id', 'DESC')
            ->join('e_post', 'e_post.profile_id', '=', 'e_profile_bussines.profile_id')
            ->select('e_profile_bussines.*',
                'e_post.id as post_id',
                'e_post.longitude',
                'e_post.latitude',
                'e_post.location_string',
                'e_post.created_at as post_created_at');

        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('e_post.created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }
        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('e_post.created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }
        if (!empty($profile_name)) {
            $query->where('e_profile_bussines.name', 'like', '%' . $profile_name . '%');
        }

        if (!empty($location_string)){
            $query->where('e_post.location_string', 'like', '%'.$location_string.'%');
        }

        // pagination
        $profileBusinesses = $query->paginate(5);
        $profileBusinesses->appends('profile_name', $profile_name);
        $profileBusinesses->appends('start_time', $start_time);
        $profileBusinesses->appends('end_time', $end_time);
        $profileBusinesses->appends('location_string', $location_string);

        return view('backend.profile_businesses.index', compact('start_time', 'end_time'))
            ->with('profileBusinesses', $profileBusinesses);
    }

    /**
     * Display the specified ProfileBusiness.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($postId)
    {
        $query = DB::table('e_profile_bussines')
            ->orderBy('e_post.id', 'DESC')
            ->join('e_post', 'e_post.profile_id', '=', 'e_profile_bussines.profile_id')
            ->select('e_profile_bussines.*',
                'e_post.id as post_id',
                'e_post.longitude',
                'e_post.latitude',
                'e_post.content',
                'e_post.location_string',
                'e_post.created_at as post_created_at');

        $query->where('e_post.id', '=', $postId);

        $profileBusiness = $query->first();

        if (empty($profileBusiness)) {
            Flash::error('Post not found');

            return redirect(route('backend.profileBusinesses.index'));
        }

        return view('backend.profile_businesses.show')->with('profileBusiness', $profileBusiness);
    }

    /**
     * Remove the specified ProfileBusiness from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($postId)
    {
        $post = Post::where('id', '=', $postId);
        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('backend.profileBusinesses.index'));
        }

        // delete relation ship
        $postLikes = PostLike::where('post_id', '=', $postId);
        $postLikes->delete();
        $postViews = PostView::where('post_id', '=', $postId);
        $postViews->delete();
        $postComments = PostComment::where('post_id', '=', $postId);
        foreach ($postComments->get() as $postComment) {
            $postCommentLikes = PostCommentLike::where('post_comment_id', '=', $postComment->id);
            $postCommentLikes->delete();
        }
        $postComments->delete();
        $post->delete();

        Flash::success('Post deleted successfully.');

        return redirect(route('backend.profileBusinesses.index'));
    }
}
