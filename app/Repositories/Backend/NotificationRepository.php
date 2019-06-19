<?php

namespace App\Repositories\Backend;

use App\Models\Notification;
use InfyOm\Generator\Common\BaseRepository;

class NotificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Notification::class;
    }
}
