<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\CategoryProductService;
use App\Http\Requests\CategoryProductRequest;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\CategoryProductResource;
use App\Http\Resources\SuccessResponseResource;

class CategoryProductController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryProductService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = $this->categoryService->getCategories();

            return SuccessResponseResource::jsonResponse(
                'OK', 200, CategoryProductResource::collection($categories)
            );
        } catch (\Exception $e) {
            return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryProductRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
            ];

            $category = $this->categoryService->createCategory($data);

            return SuccessResponseResource::jsonResponse(
                'Successfully create data!', 201, (new CategoryProductResource($category))
            ); 
        } catch (\Exception $e) {
            return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = $this->categoryService->getCategory($id);

            return SuccessResponseResource::jsonResponse(
                'OK', 200, (new CategoryProductResource($category))
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
    public function update(CategoryProductRequest $request, string $id)
    {
        try {
            $category = $this->categoryService->getCategory($id);

            $data = [
                'name' => $request->input('name', $category->name),
            ];

            $updatedCategory = $this->categoryService->updateCategory($id, $data);

            return SuccessResponseResource::jsonResponse(
                'Successfully update data!', 201, (new CategoryProductResource($updatedCategory))
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
            $category = $this->categoryService->deleteCategory($id);

            return SuccessResponseResource::jsonResponse(
                'OK', 200
            );
        } catch (\ModelNotFoundException $e) {
            return ErrorResponseResource::jsonResponse('Data Not Found!', 404);
        } catch (\Exception $e) {
            return ErrorResponseResource::jsonResponse('Internal Server Error', 500);
        }
    }
}
