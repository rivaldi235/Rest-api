<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\SuccessResponseResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = $this->productService->getProducts();

            return SuccessResponseResource::jsonResponse(
                'OK', 200, ProductResource::collection($products)
            );
        } catch (\Exception $e) {
            return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // try {
            $filePath = null;

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $filePath = $this->productService->uploadFile($file);
            }

            $data = [
                'product_category_id' => $request->product_category_id,
                'name' => $request->name,
                'price' => $request->price,
                'qty' => $request->qty,
                'description' => $request->description,
                'image' => $filePath,
            ];

            $product = $this->productService->createProduct($data);

            return SuccessResponseResource::jsonResponse(
                'Successfully create data!', 201, (new ProductResource($product))
            );
        // } catch (\Exception $e) {
        //     return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        // }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = $this->productService->getProduct($id);

            return SuccessResponseResource::jsonResponse(
                'OK', 200, (new ProductResource($product))
            );
        } catch (ModelNotFoundException $e) {
            return ErrorResponseResource::jsonResponse('Data Not Found!', 404);
        } catch (Exception $e) {
            return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = $this->productService->getProduct($id);

            $currentImagePath = $product->image;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $this->productService->uploadFile($file);

                // Delete jika ada data nya
                if ($currentImagePath) {
                    $this->productService->deleteFile($currentImagePath);
                }

            } else {
                $filePath = $currentImagePath;
            }

            $data = [
                'product_category_id' => $request->input('product_category_id', $product->product_category_id),
                'name' => $request->input('name', $product->name),
                'price' => $request->input('price', $product->price),
                'qty' => $request->input('qty', $product->qty),
                'description' => $request->input('description', $product->description),
                'image' => $filePath,
            ];

            $updatedProduct = $this->productService->updateProduct($id, $data);

            return SuccessResponseResource::jsonResponse(
                'Successfully update data!', 200, new ProductResource($updatedProduct)
            );
        } catch (ModelNotFoundException $e) {
            return ErrorResponseResource::jsonResponse('Data Not Found!', 404);
        } catch (Exception $e) {
            return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = $this->productService->getProduct($id);

            $currentImagePath = $product->image;
            $image = $this->productService->deleteFile($currentImagePath);
            $product = $this->productService->deleteProduct($id);

            return SuccessResponseResource::jsonResponse(
                'Successfully deleted data!', 200
            );
        } catch (ModelNotFoundException $e) {
            return ErrorResponseResource::jsonResponse('Data Not Found!', 404);
        } catch (Exception $e) {
            return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        }
    }
}
