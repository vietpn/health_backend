<?php

namespace App\Repositories\Backend;

use App\Models\Message;
use InfyOm\Generator\Common\BaseRepository;

class MessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'messages',
        'profile_id',
        'profile_sent',
        'profile_recive',
        'created_at',
        'updated_at',
        'time_sent',
        'is_image',
        'is_read',
        'is_read_all'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Message::class;
    }
}
