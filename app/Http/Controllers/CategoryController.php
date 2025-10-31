<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Interfaces\Category\ICategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private ICategoryService $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ($this->categoryService->index([]))->toResourceCollection();

       return sendSuccessResponse(data: $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $category = ($this->categoryService->store($data))->toResource();

        return sendSuccessResponse(message: 'تم انشاء التصنيف بنجاح',data: $category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return sendSuccessResponse(message: 'تم ارجاع التصنيف بنجاح',data: $category->toResource());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $data = $request->validated();

        $category = ($this->categoryService->update(id: $id, data: $data))->toResource();

        return sendSuccessResponse(message: 'تم تحديث التصنيف بنجاح',data: $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryService->delete(id: $id);

        return sendSuccessResponse(status_code: 204);
    }
}
