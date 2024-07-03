<?php

namespace App\Service;

use Illuminate\Support\Str;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts()
    {
        $products = $this->productRepository->getAll();
        return $products;
    }

    public function createProduct(array $data)
    {
        $product = $this->productRepository->create($data);
        return $product;
    }

    public function getProduct(string $id)
    {
        $product = $this->productRepository->getById($id);
        return $product;
    }

    public function updateProduct(string $id, array $data)
    {
        $product = $this->getProduct($id);
        $product = $this->productRepository->update($product, $data);
        return $product;
    }

    public function deleteProduct(string $id)
    {
        $product = $this->getProduct($id);
        $this->productRepository->delete($product);
    }

    public function uploadFile($file)
    {
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('uploads', $file, $fileName);
        return 'uploads/' . $fileName;
    }

    public function deleteFile($filePath)
    {
        if ($filePath) {
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }
    }
}