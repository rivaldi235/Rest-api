<?php

namespace App\Service;

use App\Repositories\CategoryProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Class CategoryProductService
{
    protected $categoryRepository;

    public function __construct(CategoryProductRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories()
    {
        $categories = $this->categoryRepository->getAll();
        return $categories;
    }

    public function createCategory(array $data)
    {
        $category = $this->categoryRepository->create($data);
        return $category;
    }

    public function getCategory(string $id)
    {
        $category = $this->categoryRepository->getById($id);
        return $category;
    }

    public function updateCategory(string $id, array $data)
    {
        $category = $this->getCategory($id);
        $category = $this->categoryRepository->update($category, $data);
        return $category;
    }

    public function deleteCategory(string $id)
    {
        $category = $this->getCategory($id);
        $this->categoryRepository->delete($category);
    }
}