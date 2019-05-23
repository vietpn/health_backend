<?php

namespace App\Repositories\Backend;

use App\Models\NgWord;
use InfyOm\Generator\Common\BaseRepository;

class NgWordRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'word',
        'pronounce',
        'description',
        'status',
        'created_id',
        'created_at',
        'updated_id',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NgWord::class;
    }
}
