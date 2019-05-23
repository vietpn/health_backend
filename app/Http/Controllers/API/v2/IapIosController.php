<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateIapIosAPIRequest;
use App\Http\Requests\API\UpdateIapIosAPIRequest;
use App\Models\BaseModel;
use App\Models\IapIos;
use App\Models\IapIosCharging;
use App\Repositories\Api\IapIosRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Input;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use ReceiptValidator\iTunes\Validator as iTunesValidator;
use Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class IapIosController
 * @package App\Http\Controllers\API
 */

class IapIosController extends AppBaseController
{
    /** @var  IapIosRepository */
    private $iapIosRepository;

    public function __construct(IapIosRepository $iapIosRepo)
    {
        $this->iapIosRepository = $iapIosRepo;
    }

    /**
     * Display a listing of the IapIos.
     * GET|HEAD /iapIos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iapIosRepository->pushCriteria(new RequestCriteria($request));
        $this->iapIosRepository->pushCriteria(new LimitOffsetCriteria($request));
        $iapIos = $this->iapIosRepository->all();

        return $this->sendResponse($iapIos->toArray(), 'Iap Ios retrieved successfully');
    }

    /**
     * Store a newly created IapIos in storage.
     * POST /iapIos
     *
     * @param CreateIapIosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIapIosAPIRequest $request)
    {
        $input = $request->all();

        $iapIos = $this->iapIosRepository->create($input);

        return $this->sendResponse($iapIos->toArray(), 'Iap Ios saved successfully');
    }

    /**
     * Display the specified IapIos.
     * GET|HEAD /iapIos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var IapIos $iapIos */
        $iapIos = $this->iapIosRepository->findWithoutFail($id);

        if (empty($iapIos)) {
            return $this->sendError('Iap Ios not found');
        }

        return $this->sendResponse($iapIos->toArray(), 'Iap Ios retrieved successfully');
    }

    /**
     * Update the specified IapIos in storage.
     * PUT/PATCH /iapIos/{id}
     *
     * @param  int $id
     * @param UpdateIapIosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIapIosAPIRequest $request)
    {
        $input = $request->all();

        /** @var IapIos $iapIos */
        $iapIos = $this->iapIosRepository->findWithoutFail($id);

        if (empty($iapIos)) {
            return $this->sendError('Iap Ios not found');
        }

        $iapIos = $this->iapIosRepository->update($input, $id);

        return $this->sendResponse($iapIos->toArray(), 'IapIos updated successfully');
    }

    /**
     * Remove the specified IapIos from storage.
     * DELETE /iapIos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var IapIos $iapIos */
        $iapIos = $this->iapIosRepository->findWithoutFail($id);

        if (empty($iapIos)) {
            return $this->sendError('Iap Ios not found');
        }

        $iapIos->delete();

        return $this->sendResponse($id, 'Iap Ios deleted successfully');
    }

    /**
     *
     * @return array
     */
    public function iosCharge(){
        $isValid = false;
        $receipt = Input::get('receipt_data');
        $productId = Input::get('product_id');
        $appleId = Input::get('apple_id');

        //Check receipt was exist.
        $iic = IapIosCharging::select('id')->where(['purchase_token' => $receipt, 'response' => 200])->first();

        if (!empty($iic)){
            return [
                'success' => false,
                'message' => trans('app.token.exist'),
                'charging' => trans('app.invalid.billing'),
            ];
        }

        $isValid = $this->validateBilling($receipt);

        $point = 0;
        $price = 0;
        $iapIos = IapIos::where(['product_id' =>$productId, 'apple_id' =>$appleId])->first();

        if (isset($iapIos)){
            $point = $iapIos->point;
            $price = $iapIos->price;
        }

        $user = \Auth::user();
        if (!isset($user)){
            throw new NotFoundHttpException(trans('app.not.exits.token'));
        }

        //Check add point
        if ($isValid == true){ //Billing Android success
            $response = User::billingPoint(User::PLUS, $point);

            if (isset($response)){
                //Log to billing chargin
                $iapCharging = new IapIosCharging();
                $iapCharging->apple_id = $appleId;
                $iapCharging->product_id = $productId;
                $iapCharging->point = $point;
                $iapCharging->amount = $price;
                $iapCharging->profile_id = $user->id;
                $iapCharging->purchase_token = $receipt;
                $iapCharging->charge_status = BaseModel::STATUS_ENABLE; //Success
                $iapCharging->response = '200'; //Success add Icash
                $iapCharging->save();
            }

        } else { //Giao dich billing loi
            $iapCharging = new IapIosCharging();
            $iapCharging->apple_id = $appleId;
            $iapCharging->product_id = $productId;
            $iapCharging->point = $point;
            $iapCharging->amount = $price;
            $iapCharging->profile_id = $user->id;
            $iapCharging->purchase_token = $receipt;
            $iapCharging->charge_status = BaseModel::STATUS_ENABLE; //Success
            $iapCharging->response = '500'; //Error add Icash
            $iapCharging->save();

            return [
                'success' => false,
                'message' => trans('app.invalid.billing'),
                'charging' => trans('app.invalid.billing'),
            ];
        }

        $returnCharge = $iapCharging->toArray();
        $returnCharge['total_point'] = $user->point;

        return [
            'success' => true,
            'message' => trans('app.billing.success'),
            'charging' => $returnCharge,
        ];
    }

    /**
     *
     * @param $receiptData
     * @return bool
     */
    public function validateBilling($receiptData){
        $isValid = false;
        $validator = new iTunesValidator(iTunesValidator::ENDPOINT_PRODUCTION);

        try {
            $response = $validator->setReceiptData($receiptData)->validate();
        } catch (\Exception $e) {
            echo 'got error = ' . $e->getMessage() . PHP_EOL;
        }

        if ($response->isValid()) {
            //'Receipt is valid.' . PHP_EOL;
            //Receipt data = ' . print_r($response->getReceipt()) . PHP_EOL;
            $isValid = true;
        } else {
            //'Receipt is not valid.' . PHP_EOL;
            //'Receipt result code = ' . $response->getResultCode() . PHP_EOL;
            $isValid = false;
        }

        return $isValid;
    }
}
