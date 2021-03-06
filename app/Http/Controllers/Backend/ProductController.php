<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProductRequest;
use App\Http\Requests\Backend\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Backend\ProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use DB;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $name = Input::get('name', '');

        $query = Product::select();

        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $products = $query->paginate(10);

        return view('backend.products.index')
            ->with(['products' => $products, 'name' => $name]);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();
        $file = Input::file('image');

        if (isset($file) && $file->isValid()) {
            $destinationPath = 'uploads/product/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/' . $destinationPath, $fileName);
            $input['img_path'] = $destinationPath . '/' . $fileName;
        }

        $product = $this->productRepository->create($input);

        Flash::success('Product saved successfully.');

        return redirect(route('backend.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('backend.products.index'));
        }

        return view('backend.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('backend.products.index'));
        }

        return view('backend.products.edit')->with('product', $product);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('backend.products.index'));
        }
        $input = $request->all();
        $file = Input::file('image');

        if (isset($file) && $file->isValid()) {
            $destinationPath = 'uploads/promotion/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/' . $destinationPath, $fileName);
            $input['img_path'] = $destinationPath . '/' . $fileName;
        }

        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect(route('backend.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('backend.products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('backend.products.index'));
    }
}
