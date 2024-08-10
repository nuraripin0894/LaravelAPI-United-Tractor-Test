<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('custom.auth');
    }

    public function index()
    {
        $message = '';
        $products = $this->productService->getAll();

        if ($products->isEmpty()) {
            $message = 'Data empty.';
        } else {
            $message = 'Showing all products';
        }

        // sending response json
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $product = $this->productService->create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Product has been created.',
                'data' => [
                    'id' => $product->id,
                    'product_category_id' => $product->product_category_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                ]
            ], 201);
        } catch (ValidationException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->errors()
            ], 500);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'message' => 'Product already exist or category not found.'
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getById($id);

            return response()->json([
                'status' => true,
                'message' => 'Product found.',
                'data' => $product,
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
        $data = $request->only(['name', 'price']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        try {
            $product = $this->productService->update($id, $data);

            return response()->json([
                'status' => true,
                'message' => 'Product has been updated.',
                'data' => $product,
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
                'message' => 'Product already exist or category not found.'
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $product = $this->productService->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Product has been deleted.',
            ], 200);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage()
            ], 500);
        }
    }
}
