<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreatePostRequest;
use App\Http\Requests\Backend\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostLike;
use App\Models\PostView;
use App\Repositories\Backend\PostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $content = Input::get('content', '');
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');
        $profile_name = Input::get('profile_name', '');
        $birth_year = Input::get('birth_year', '');
        $gender = Input::get('gender', '');
        $report = Input::get('report', '');

        $query = DB::table('e_post')
            ->orderBy('e_post.id', 'DESC')
            ->leftJoin('e_profile', 'e_profile.id', '=', 'e_post.profile_id')
            ->leftJoin('e_profile_user', 'e_profile_user.profile_id', '=', 'e_post.profile_id')
            ->leftJoin('e_post_comment', 'e_post_comment.post_id', '=', 'e_post.id')
            ->leftJoin('e_post_like', 'e_post_like.post_id', '=', 'e_post.id')
            ->leftJoin('e_post_report', 'e_post_report.post_id', '=', 'e_post.id')
            ->leftJoin('e_post_view', 'e_post_view.post_id', '=', 'e_post.id')
            ->select('e_post.*', 'e_profile.name', 'e_profile_user.birth_year', 'e_profile_user.gender',
                DB::raw('count(DISTINCT e_post_comment.id) as comments'),
                DB::raw('count(DISTINCT e_post_like.id) as likes'),
                DB::raw('count(DISTINCT e_post_report.id) as reports'),
                DB::raw('count(DISTINCT e_post_view.id) as views'))
            ->groupBy('e_post.id');


        // query
        if (!empty($content)) {
            $query->where('e_post.content', 'like', '%' . $content . '%');
        }
        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('e_post.created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }
        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('e_post.created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }
        if (!empty($profile_name)) {
            $query->where('e_profile.name', 'like', '%' . $profile_name . '%');
        }
        if (!empty($birth_year)) {
            $query->where('e_profile_user.birth_year', '=', $birth_year);
        }
        if (!empty($gender) || $gender === '0') {
            $query->where('e_profile_user.gender', '=', $gender);
        }

        if ($report === '1') {
            $query->whereNotNull('e_post_report.post_id');
        } else if ($report === '0') {
            $query->whereNull('e_post_report.post_id');
        }

        // pagination
        $posts = $query->paginate(5);

        $posts->appends('content', $content);
        $posts->appends('start_time', $start_time);
        $posts->appends('end_time', $end_time);
        $posts->appends('profile_name', $profile_name);
        $posts->appends('birth_year', $birth_year);
        $posts->appends('gender', $gender);
        $posts->appends('report', $report);

        return view('backend.posts.index', compact('content', 'start_time', 'end_time'))
            ->with('posts', $posts);
    }

    /**
     * Display the specified Post. and search comment
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->findWithoutFail($id);
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');
        $content = Input::get('content', '');
        $profile_name = Input::get('profile_name', '');
        $birth_year = Input::get('birth_year', '');
        $gender = Input::get('gender', '');


        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('backend.posts.index'));
        }

        $query = DB::table('e_post_comment')
            ->leftJoin('e_profile', 'e_profile.id', '=', 'e_post_comment.profile_id')
            ->leftJoin('e_profile_user', 'e_profile_user.profile_id', '=', 'e_post_comment.profile_id')
            ->leftJoin('e_post_comment_like', 'e_post_comment_like.post_comment_id', '=', 'e_post_comment.id')
            ->where('e_post_comment.post_id', '=', $id)
            ->select('e_post_comment.*', 'e_profile.name',
                DB::raw('count(DISTINCT e_post_comment_like.id) as likes'))
            ->groupBy('e_post_comment.id');


        // query
        if (!empty($content)) {
            $query->where('e_post_comment.content', 'like', '%' . $content . '%');
        }
        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('e_post_comment.created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }
        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('e_post_comment.created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }
        if (!empty($profile_name)) {
            $query->where('e_profile.name', 'like', '%' . $profile_name . '%');
        }
        if (!empty($birth_year)) {
            $query->where('e_profile_user.birth_year', '=', $birth_year);
        }
        if (!empty($gender) || $gender === '0') {
            $query->where('e_profile_user.gender', '=', $gender);
        }

        // pagination
        $comments = $query->paginate(3);

        $comments->appends('content', $content);
        $comments->appends('start_time', $start_time);
        $comments->appends('end_time', $end_time);
        $comments->appends('profile_name', $profile_name);
        $comments->appends('birth_year', $birth_year);
        $comments->appends('gender', $gender);

        return view('backend.posts.show', compact('content', 'start_time', 'end_time'))
            ->with('post', $post)
            ->with('comments', $comments);
    }

    /**
     * Show comment
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showComment($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('backend.posts.index'));
        }

        $query = DB::table('e_post_comment')
            ->leftJoin('e_profile', 'e_profile.id', '=', 'e_post_comment.profile_id')
            ->leftJoin('e_profile_user', 'e_profile_user.profile_id', '=', 'e_post_comment.profile_id')
            ->leftJoin('e_post_comment_like', 'e_post_comment_like.post_comment_id', '=', 'e_post_comment.id')
            ->leftJoin('e_post_comment_report', 'e_post_comment_report.post_comment_id', '=', 'e_post_comment.id')
            ->where('e_post_comment.post_id', '=', $id)
            ->select('e_post_comment.*', 'e_profile.name',
                DB::raw('count(DISTINCT e_post_comment_like.id) as likes'),
                DB::raw('count(DISTINCT e_post_comment_report.id) as reports'))
            ->groupBy('e_post_comment.id');

        $comments = $query->paginate(3);

        return view('backend.posts.show_comment')
            ->with('post', $post)
            ->with('comments', $comments);
    }

    /**
     * Delete comment of post
     * @param $commentId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyComment($commentId)
    {
        Flash::success('Comment deleted successfully.');
        $postComment = PostComment::where('id', '=', $commentId);
        if (empty($postComment)) {
            if (empty($post)) {
                Flash::error('Comment not found');

                return redirect(route('backend.posts.index'));
            }
        }

        // delete like of comment
        $postCommentLikes = PostCommentLike::where('post_comment_id', '=', $commentId);

        $postId = $postComment->get()[0]->post_id;
        $postCommentLikes->delete();
        $postComment->delete();

        Flash::success('Comment deleted successfully.');
        return redirect(route('backend.comments.index', $postId));
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('backend.posts.index'));
        }

        return view('backend.posts.edit')->with('post', $post);
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('backend.posts.index'));
        }

        // delete relation ship
        $postLikes = PostLike::where('post_id', '=', $id);
        $postLikes->delete();
        $postViews = PostView::where('post_id', '=', $id);
        $postViews->delete();
        $postComments = PostComment::where('post_id', '=', $id);
        foreach ($postComments->get() as $postComment) {
            $postCommentLikes = PostCommentLike::where('post_comment_id', '=', $postComment->id);
            $postCommentLikes->delete();
        }
        $postComments->delete();

        // delete post
        $this->postRepository->delete($id);
        Flash::success('Post deleted successfully.');

        return redirect(route('backend.posts.index'));
    }
}
