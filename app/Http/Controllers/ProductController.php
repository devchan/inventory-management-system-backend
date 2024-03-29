<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Notifications\CreateAccountNotification;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_products');
        return ResponseHelper::findSuccess("list", ProductResource::collection($this->productRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('store_product');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->has('image_file') && $request->get('image_file') != null) {
                $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'products');
            }
            $product = $this->productRepository->store($data);
            DB::commit();
            return ResponseHelper::createSuccess("product", new ProductResource($product));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize('show_product');
        $product->load('category');
        return ResponseHelper::findSuccess("product", new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update_product');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->has('image_file') && $request->get('image_file') != null) {
                $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'products');
            }
            $product = $this->productRepository->update($product->id,  $data);
            DB::commit();
            return ResponseHelper::updateSuccess("product", new ProductResource($product));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('destroy_product');
        return ResponseHelper::deleteSuccess("product", $this->productRepository->delete($product->id));
    }
}
