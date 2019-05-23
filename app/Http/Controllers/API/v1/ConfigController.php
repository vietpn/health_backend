<?php

namespace App\Http\Controllers\API\v1;

use App\Define\Systems;
use App\Http\Requests\API\CreateConfigAPIRequest;
use App\Http\Requests\API\UpdateConfigAPIRequest;
use App\Models\BloodType;
use App\Models\Config;
use App\Models\ZodiacSigns;
use App\Repositories\Api\ConfigRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ConfigController
 * @package App\Http\Controllers\API
 */
class ConfigController extends AppBaseController
{
    /** @var  ConfigRepository */
    private $configRepository;

    public function __construct(ConfigRepository $configRepo)
    {
        $this->configRepository = $configRepo;
    }

    /**
     * Display a listing of the Config.
     * GET|HEAD /configs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $configs = $this->configRepository->findWhere(['status' => STATUS_ENABLE]);

        $result = [
            'config' => $configs->toArray(),
        ];
        return $this->sendResponse($result, 'Configs retrieved successfully');
    }
}
