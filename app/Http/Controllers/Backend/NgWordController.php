<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateNgWordRequest;
use App\Http\Requests\Backend\UpdateNgWordRequest;
use App\Models\BaseModel;
use App\Models\NgWord;
use App\Repositories\Backend\NgWordRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class NgWordController extends AppBaseController
{
    /** @var  NgWordRepository */
    private $ngWordRepository;

    public function __construct(NgWordRepository $ngWordRepo)
    {
        $this->ngWordRepository = $ngWordRepo;
    }

    /**
     * Display a listing of the NgWord.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $word = Input::get('word', '');
        $pronounce = Input::get('pronounce', '');
        $status = Input::get('status', '');
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');

        $query = NgWord::select();
        if (!empty($word)){
            $query->where('word', 'like', '%'.$word.'%');
        }

        if (!empty($pronounce)){
            $query->where('pronounce', 'like', '%'.$pronounce.'%');
        }

        if (isset($status) && $status !== ''){
            $query->where(['status' => $status]);
        }

        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }

        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }

        $ngWords = $query->paginate();

        return view('backend.ng_words.index')
            ->with(['ngWords' => $ngWords, 'word' => $word, 'pronounce' => $pronounce, 'status' => $status, 'start_time' => $start_time, 'end_time' => $end_time]);
    }

    /**
     * Show the form for creating a new NgWord.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.ng_words.create');
    }

    /**
     * Store a newly created NgWord in storage.
     *
     * @param CreateNgWordRequest $request
     *
     * @return Response
     */
    public function store(CreateNgWordRequest $request)
    {
        $input = $request->all();

        $ngWord = $this->ngWordRepository->create($input);
        Flash::success('Ng Word saved successfully.');

        return redirect(route('backend.ngWords.index'));
    }

    /**
     * Display the specified NgWord.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ngWord = $this->ngWordRepository->findWithoutFail($id);

        if (empty($ngWord)) {
            Flash::error('Ng Word not found');

            return redirect(route('backend.ngWords.index'));
        }

        return view('backend.ng_words.show')->with('ngWord', $ngWord);
    }

    /**
     * Show the form for editing the specified NgWord.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ngWord = $this->ngWordRepository->findWithoutFail($id);

        if (empty($ngWord)) {
            Flash::error('Ng Word not found');

            return redirect(route('backend.ngWords.index'));
        }

        return view('backend.ng_words.edit')->with('ngWord', $ngWord);
    }

    /**
     * Update the specified NgWord in storage.
     *
     * @param  int              $id
     * @param UpdateNgWordRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNgWordRequest $request)
    {
        $ngWord = $this->ngWordRepository->findWithoutFail($id);

        if (empty($ngWord)) {
            Flash::error('Ng Word not found');

            return redirect(route('backend.ngWords.index'));
        }

        $ngWord = $this->ngWordRepository->update($request->all(), $id);

        Flash::success('Ng Word updated successfully.');

        return redirect(route('backend.ngWords.index'));
    }

    /**
     * Remove the specified NgWord from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ngWord = $this->ngWordRepository->findWithoutFail($id);

        if (empty($ngWord)) {
            Flash::error('Ng Word not found');

            return redirect(route('backend.ngWords.index'));
        }

        $this->ngWordRepository->delete($id);

        Flash::success('Ng Word deleted successfully.');

        return redirect(route('backend.ngWords.index'));
    }
}
