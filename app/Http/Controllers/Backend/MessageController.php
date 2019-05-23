<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateMessageRequest;
use App\Http\Requests\Backend\UpdateMessageRequest;
use App\Models\Message;
use App\Repositories\Backend\MessageRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MessageController extends AppBaseController
{
    /** @var  MessageRepository */
    private $messageRepository;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepository = $messageRepo;
    }

    /**
     * Display a listing of the Message.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $sender = Input::get('sender', '');
        $receiver = Input::get('receiver', '');
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');


        $query = Message::select('e_messages.*', 'e_profile.email as sender');
        $query->join('e_profile', 'e_messages.profile_sent', '=', 'e_profile.id');


        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('e_messages.created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }

        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('e_messages.created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }

        if (!empty($sender)) {
            $query->where('email', 'like', '%'.$sender.'%');
        }

        if (!empty($receiver)) {
            $receiver_ids = User::select('id')->where('email','like', '%'.$receiver.'%')->get();
            $listReceiver = [];
            foreach ($receiver_ids as $key => $value){
                $listReceiver[] = $value['id'];
            }
            $query->whereIn('profile_recive',$listReceiver);
        }

        $messages = $query->orderBy('e_messages.profile_sent', 'ASC')->paginate();

        return view('backend.messages.index')
            ->with(['messages' => $messages, 'sender' => $sender, 'receiver' => $receiver, 'start_time' => $start_time, 'end_time' => $end_time]);
    }

    /**
     * Show the form for creating a new Message.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.messages.create');
    }

    /**
     * Store a newly created Message in storage.
     *
     * @param CreateMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request)
    {
        $input = $request->all();

        $message = $this->messageRepository->create($input);

        Flash::success('Message saved successfully.');

        return redirect(route('backend.messages.index'));
    }

    /**
     * Display the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('backend.messages.index'));
        }
        $profile_sent = $message->profile_sent;
        $profile_recive = $message->profile_recive;

        $message = Message::whereIn('profile_sent', [$profile_sent, $profile_recive])->whereIn('profile_recive', [$profile_sent, $profile_recive])->orderBy('id','ASC')->get();

        return view('backend.messages.show')->with(['message' => $message, 'profile_sent' => $profile_sent, 'profile_recive' => $profile_recive]);
    }

    /**
     * Show the form for editing the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
//    public function edit($id)
//    {
//        $message = $this->messageRepository->findWithoutFail($id);
//
//        if (empty($message)) {
//            Flash::error('Message not found');
//
//            return redirect(route('backend.messages.index'));
//        }
//
//        return view('backend.messages.edit')->with('message', $message);
//    }

    /**
     * Update the specified Message in storage.
     *
     * @param  int              $id
     * @param UpdateMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMessageRequest $request)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('backend.messages.index'));
        }

        $message = $this->messageRepository->update($request->all(), $id);

        Flash::success('Message updated successfully.');

        return redirect(route('backend.messages.index'));
    }

    /**
     * Remove the specified Message from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('backend.messages.index'));
        }

        $this->messageRepository->delete($id);

        Flash::success('Message deleted successfully.');

        return redirect(route('backend.messages.index'));
    }

    public function delete($id)
    {
        if (\Request::ajax()) {
            $message = $this->messageRepository->findWithoutFail($id);

            if (empty($message)) {
                $return = ['error' => true, 'message' => 'Message not found'];
            }

            try {
                $this->messageRepository->delete($id);
                $return['error'] = false;
                $return['message'] = 'Delete success';
            } catch (\Exception $e) {
                $return['message'] = $e->getMessage();
            }
            return Response::json($return);
        }
    }

}
