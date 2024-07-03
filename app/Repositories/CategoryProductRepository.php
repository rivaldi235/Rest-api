<?php

namespace App\Repositories;

use App\Models\CategoryProduct;

class CategoryProductRepository
{
    public function getAll()
    {
        return CategoryProduct::paginate(10);
    }

    public function create(array $category)
    {
        return CategoryProduct::create($category);
    }

    public function getById(string $id)
    {
        return CategoryProduct::findOrFail($id);
    }

    public function update(CategoryProduct $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete(CategoryProduct $category)
    {
        $category->delete();
    }
}