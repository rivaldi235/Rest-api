<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::paginate(10);
    }

    public function create(array $product)
    {
        return Product::create($product);
    }

    public function getById(string $id)
    {
        return Product::findOrFail($id);
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}