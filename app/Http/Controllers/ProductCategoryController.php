<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductCategoryService;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductCategoryController extends Controller
{
    protected $productCategoriesService;

    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoriesService = $productCategoryService;
        $this->middleware('custom.auth');
    }

    public function index()
    {
        $message = '';
        $productCategories = $this->productCategoriesService->getAll();

        if ($productCategories->isEmpty()) {
            $message = 'Data empty.';
        } else {
            $message = 'Showing all products';
        }

        // sending response json
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $productCategories,
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $productCategories = $this->productCategoriesService->create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Product category has been created.',
                'data' => [
                    'id' => $productCategories->id,
                    'name' => $productCategories->name,
                ],
            ], 201);
        } catch (ValidationException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->errors()
            ], 500);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'message' => 'Product category already exist.'
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $productCategories = $this->productCategoriesService->getById($id);

            return response()->json([
                'status' => true,
                'message' => 'Product category found.',
                'data' => $productCategories,
            ], 200);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $productCategories = $this->productCategoriesService->update($id, $request->all());

            return response()->json([
                'status' => true,
                'message' => 'Product category has been updated.',
                'data' => $productCategories,
            ], 201);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage()
            ], 500);
        } catch (ValidationException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->errors()
            ], 500);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'message' => 'Product category already exist.'
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $productCategories = $this->productCategoriesService->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Product category has been deleted.',
            ], 200);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage()
            ], 500);
        }
    }
}
