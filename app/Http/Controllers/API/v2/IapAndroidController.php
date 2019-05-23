<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateIapAndroidAPIRequest;
use App\Http\Requests\API\UpdateIapAndroidAPIRequest;
use App\Models\BaseModel;
use App\Models\CmsUser;
use App\Models\IapAndroid;
use App\Models\IapAndroidCharging;
use App\Repositories\Api\IapAndroidRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Input;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class IapAndroidController
 * @package App\Http\Controllers\API
 */

class IapAndroidController extends AppBaseController
{
    /** @var  IapAndroidRepository */
    private $iapAndroidRepository;

    public function __construct(IapAndroidRepository $iapAndroidRepo)
    {
        $this->iapAndroidRepository = $iapAndroidRepo;
    }

    /**
     * Display a listing of the IapAndroid.
     * GET|HEAD /iapAndroids
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->iapAndroidRepository->pushCriteria(new RequestCriteria($request));
        $this->iapAndroidRepository->pushCriteria(new LimitOffsetCriteria($request));
        $iapAndroids = $this->iapAndroidRepository->all();

        return $this->sendResponse($iapAndroids->toArray(), 'Iap Androids retrieved successfully');
    }

    /**
     * Store a newly created IapAndroid in storage.
     * POST /iapAndroids
     *
     * @param CreateIapAndroidAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIapAndroidAPIRequest $request)
    {
        $input = $request->all();

        $iapAndroids = $this->iapAndroidRepository->create($input);

        return $this->sendResponse($iapAndroids->toArray(), 'Iap Android saved successfully');
    }

    /**
     * Display the specified IapAndroid.
     * GET|HEAD /iapAndroids/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var IapAndroid $iapAndroid */
        $iapAndroid = $this->iapAndroidRepository->findWithoutFail($id);

        if (empty($iapAndroid)) {
            return $this->sendError('Iap Android not found');
        }

        return $this->sendResponse($iapAndroid->toArray(), 'Iap Android retrieved successfully');
    }

    /**
     * Update the specified IapAndroid in storage.
     * PUT/PATCH /iapAndroids/{id}
     *
     * @param  int $id
     * @param UpdateIapAndroidAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIapAndroidAPIRequest $request)
    {
        $input = $request->all();

        /** @var IapAndroid $iapAndroid */
        $iapAndroid = $this->iapAndroidRepository->findWithoutFail($id);

        if (empty($iapAndroid)) {
            return $this->sendError('Iap Android not found');
        }

        $iapAndroid = $this->iapAndroidRepository->update($input, $id);

        return $this->sendResponse($iapAndroid->toArray(), 'IapAndroid updated successfully');
    }

    /**
     * Remove the specified IapAndroid from storage.
     * DELETE /iapAndroids/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var IapAndroid $iapAndroid */
        $iapAndroid = $this->iapAndroidRepository->findWithoutFail($id);

        if (empty($iapAndroid)) {
            return $this->sendError('Iap Android not found');
        }

        $iapAndroid->delete();

        return $this->sendResponse($id, 'Iap Android deleted successfully');
    }

    public function androidCharge(){
        $packageName = '';
        $productId = '';
        $purchaseToken = '';
        $isValid = false;

        $type = Input::get('type');
        $jsonRespose = Input::get('json_response');
        $reposeData = json_decode($jsonRespose);

        foreach ($reposeData as $key => $val){
            if ($key == 'packageName'){
                $packageName = $val;
            }

            if ($key == 'productId'){
                $productId = $val;
            }

            if ($key == 'purchaseToken'){
                $purchaseToken = $val;
            }
        }

        /**
         * Check receipt was exist and Charging success or unsuccess.
         *  If Receipt was exist
         *      => return (Do not charging again)
         *  If Receipt not exist, pleas charging
         *      => return success if valid request
         *      => return error if invalid request
        */
        $iac = IapAndroidCharging::select('id')->where(['purchase_token' => $purchaseToken, 'response' => 200])->first();

        if (!empty($iac)){
            return [
                'success' => false,
                'message' => trans('app.token.exist'),
                'charging' => trans('app.invalid.billing'),
            ];
        }

        $isValid = $this->validateBilling($packageName, $productId, $purchaseToken, $type);
        $point = 0;
        $price = 0;
        $iapAndroid = IapAndroid::where(['product_id' =>$productId])->first();
        if (isset($iapAndroid)){
            $point = $iapAndroid->point;
            $price = $iapAndroid->price;
        }

        $user = \Auth::user();
        if (!isset($user)){
            throw new NotFoundHttpException(trans('app.not.exits.token'));
        }

        //Check thuc hien cong icash
        if ($isValid == true){ //Billing Android thanh cong
            $resposeIcash = User::billingPoint(User::PLUS, $point);
            if (isset($resposeIcash)){
                //Log to billing charging
                $iapCharging = new IapAndroidCharging();
                $iapCharging->package = $packageName;
                $iapCharging->product_id = $productId;
                $iapCharging->point = $point;
                $iapCharging->amount = $price;
                $iapCharging->type = $type;
                $iapCharging->profile_id = $user->id;
                $iapCharging->purchase_token = $purchaseToken;
                $iapCharging->charge_status = BaseModel::STATUS_ENABLE; //Success
                $iapCharging->response = '200'; //Success add Point
                $iapCharging->save();
            }
        } else { //Giao dich billing loi
            $iapCharging = new IapAndroidCharging();
            $iapCharging->package = $packageName;
            $iapCharging->product_id = $productId;
            $iapCharging->point = $point;
            $iapCharging->amount = $price;
            $iapCharging->type = $type;
            $iapCharging->profile_id = $user->id;
            $iapCharging->purchase_token = $purchaseToken;
            $iapCharging->charge_status = BaseModel::STATUS_ENABLE; //Success
            $iapCharging->response = '500'; //Error add Point
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

    /*
     * Check type
     * */
    public function validateBilling($packageName, $productId, $token, $type){
        $isValid = false;

        $googleClient = new \Google_Client();
        $googleClient->setScopes([\Google_Service_AndroidPublisher::ANDROIDPUBLISHER]);
        $googleClient->setApplicationName('Eyeland');
        $googleClient->setAuthConfig('GooglePlayAndroid.json');

        $googleAndroidPublisher = new \Google_Service_AndroidPublisher($googleClient);
        $validator = new \ReceiptValidator\GooglePlay\Validator($googleAndroidPublisher);

        try {
            $valid = $validator->setPackageName($packageName)
                ->setProductId($productId)
                ->setPurchaseToken($token);

            if ($type == BaseModel::TYPE_BILLING_VALIDATE){
                $response = $valid->validate();
            } else if($type == BaseModel::TYPE_BILLING_VALIDATESUB) {
                $response = $valid->validateSubscription();
            }

            if ($response){
                $isValid = true;
            }
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 'Error validate billing');
        }

        return $isValid;
    }
}
