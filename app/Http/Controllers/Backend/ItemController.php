<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateItemRequest;
use App\Http\Requests\Backend\UpdateItemRequest;
use App\Models\Item;
use App\Models\NmCategoryItem;
use App\Repositories\Backend\ItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ItemController extends AppBaseController
{
    /** @var  ItemRepository */
    private $itemRepository;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    /**
     * Display a listing of the Item.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $name = Input::get('name', '');
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');
        $point_min = Input::get('point_min', '');
        $point_max = Input::get('point_max', '');
        $furigana = Input::get('furigana', '');

        $query = Item::select('e_item.*');

        if (!empty($name)){
            $query->where('e_item.name', 'like', '%'.$name.'%');
        }

        if (!empty($point_min)){
            $query->where('e_item.point', '>=', intval($point_min));
        }

        if (!empty($point_max)){
            $query->where('e_item.point', '<=', intval($point_max));
        }

        if (!empty($furigana)){
            $query->where('e_item.furigana', 'like', '%'.$furigana.'%');
        }

        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('e_item.created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }

        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('e_item.created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }

        //Chi lay item cha. Khong lay item con trong set
        $items = $query->where('parent_id', 0)
                ->orderBy('category_id', 'DESC')->orderBy('id', 'DESC')->paginate();

        return view('backend.items.index')
            ->with('items', $items);
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.items.create')->with('arrCate', []);
    }

    /**
     * Store a newly created Item in storage.
     *
     * @param CreateItemRequest $request
     *
     * @return Response
     */
    public function store(CreateItemRequest $request)
    {
        $input = $request->all();

        $model = new Item();
        $model->name = Input::get('name', "");
        $model->point = Input::get('point',0);
        $model->description = Input::get('description', 0);
        $model->position = Input::get('position');
        $model->status = Input::get('status');
        $model->category_id = Input::get('category_id');
        $model->is_set = Input::get('is_set', 0);
        $model->furigana = Input::get('furigana', '');

        $start_buying = Input::get('start_buying', null);
        $end_buying = Input::get('end_buying', null);
        $model->start_buying = isset($start_buying)? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $start_buying))) : $start_buying;
        $model->end_buying = isset($end_buying)? date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $end_buying))) : $end_buying;

        $file = Input::file('avatar');
        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);
            $model->avatar = $destinationPath.'/'.$fileName;
        }
        $model->save();

        if ($model->is_set){

            //Luu item kieu set
            $set_avatar = [];
            if($request->hasFile('set_avatar')){
                foreach($request->file('set_avatar') as $file) {
                    $set_avatar[] = $file;
                }
            }
            $set_name = Input::get('set_name', []);
            $set_point = Input::get('set_point', []);
            $set_position = Input::get('set_position', []);
            foreach ($set_avatar as $key => $value){
                if ( isset($value) && $value->isValid()){
                    $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
                    $extension = $value->getClientOriginalExtension();
                    $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
                    $value->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);

                    $itm = new Item();
                    $itm->avatar = $destinationPath.'/'.$fileName;
                    $itm->name = $set_name[$key];
                    $itm->point = $set_point[$key];
                    $itm->position = $set_position[$key];
                    $itm->status = $model->status;
                    $itm->category_id = $model->category_id;
                    $itm->parent_id = $model->id;
                    $itm->save();
                }
            }
        }

        Flash::success('Item saved successfully.');

        return redirect(route('backend.items.index'));
    }

    /**
     * Display the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $item = $this->itemRepository->findWithoutFail($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('backend.items.index'));
        }

        return view('backend.items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $item = $this->itemRepository->findWithoutFail($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('backend.items.index'));
        }

        return view('backend.items.edit')->with(['item'=>$item]);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param  int              $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemRequest $request)
    {
        $model = $this->itemRepository->findWithoutFail($id);

        if (empty($model)) {
            Flash::error('Item not found');

            return redirect(route('backend.items.index'));
        }
        $model->name = Input::get('name', "");
        $model->point = Input::get('point',0);
        $model->description = Input::get('description', 0);
        $model->position = Input::get('position');
        $model->status = Input::get('status');
        $model->category_id = Input::get('category_id');
        $model->is_set = Input::get('is_set', 0);
        $model->furigana = Input::get('furigana', '');

        $start_buying = Input::get('start_buying', null);
        $end_buying = Input::get('end_buying', null);
        $model->start_buying = isset($start_buying)? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $start_buying))) : $start_buying;
        $model->end_buying = isset($end_buying)? date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $end_buying))) : $end_buying;

        $file = Input::file('avatar');
        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);
            $model->avatar = $destinationPath.'/'.$fileName;
        }
        $model->save();

        if ($model->is_set){
            $item_set_new = [];

            //Luu item kieu set
            $set_avatar = [];
            $files = $_FILES['set_avatar'];
            if ($files) {
                $file_ary = $this->reArrayFiles($files);
                foreach ($file_ary as $file) {
                    $set_avatar[] = $file;
                }
            }

            $set_name = Input::get('set_name', []);
            $set_point = Input::get('set_point', []);
            $set_position = Input::get('set_position', []);
            $item_set_id = Input::get('itemSetId', []);
            foreach ($set_point as $key => $value){
                $eItmSet = Item::where('id', $item_set_id[$key])->first();
                //Update items set
                if (isset($eItmSet)){
                    if ( !empty($set_avatar[$key]['tmp_name'])){
                        $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
                        $fileName = substr(md5(rand()), 0, 16) . "." . $set_avatar[$key]['name'];
                        move_uploaded_file($set_avatar[$key]['tmp_name'], storage_path(STORAGE_PATH) . '/'. $destinationPath.'/'.$fileName);
                        $eItmSet->avatar = $destinationPath.'/'.$fileName;
                    }

                    $eItmSet->name = $set_name[$key];
                    $eItmSet->point = $set_point[$key];
                    $eItmSet->position = $set_position[$key];
                    $eItmSet->status = $model->status;
                    $eItmSet->category_id = $model->category_id;
                    $eItmSet->parent_id = $model->id;
                    $eItmSet->save();
                } else {
                    //Add new items set
                    $eItmSet = new Item();
                    if ( !empty($set_avatar[$key]['tmp_name'])){
                        $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
                        $fileName = substr(md5(rand()), 0, 16) . "." . $set_avatar[$key]['name'];
                        move_uploaded_file($set_avatar[$key]['tmp_name'], storage_path(STORAGE_PATH) . '/'. $destinationPath.'/'.$fileName);
                        $eItmSet->avatar = $destinationPath.'/'.$fileName;
                    }
                    $eItmSet->name = $set_name[$key];
                    $eItmSet->point = $set_point[$key];
                    $eItmSet->position = $set_position[$key];
                    $eItmSet->status = $model->status;
                    $eItmSet->category_id = $model->category_id;
                    $eItmSet->parent_id = $model->id;
                    $eItmSet->save();
                }
                $item_set_new[] = $eItmSet->id;
            }

            //Delete items set if user delete
            $item_set_old = Item::select('id')->where('parent_id', $model->id)->get();
            foreach ($item_set_old as $value){
                if ( !in_array($value['id'], $item_set_new)){
                    Item::findOrFail($value['id'])->delete();
                }
            }
        }

        Flash::success('Item updated successfully.');

        return redirect(route('backend.items.index'));
    }

    function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    /**
     * Remove the specified Item from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $item = $this->itemRepository->findWithoutFail($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('backend.items.index'));
        }

        $this->itemRepository->delete($id);

        Flash::success('Item deleted successfully.');

        return redirect(route('backend.items.index'));
    }
}
