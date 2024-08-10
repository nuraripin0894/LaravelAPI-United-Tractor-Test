<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\UploadedFile;

class ProductService
{
    public function create(array $request)
    {
        // validation
        $validator = Validator::make($request, [
            'product_category_id' => 'required',
            'name' => 'required|max:100|unique:products',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        // creating
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $imagePath = null;
        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            $imagePath = $request['image']->store('images');
        }

        $product = new Product();
        $product->product_category_id = $request['product_category_id'];
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->image = $imagePath;
        $product->save();

        return $product;
    }

    public function getAll()
    {
        return Product::all()->sortBy("id");
    }

    public function getById($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ModelNotFoundException('Product not found.');
        }

        return $product;
    }

    public function update($id, array $request)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ModelNotFoundException('Product not found.');
        }

        // validation
        $validator = Validator::make($request, [
            'name' => 'required|max:100|unique:products',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        // creating
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $imagePath = null;
        $storedImage = public_path('storage/' . $product->image);
        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            $imagePath = $request['image']->store('images');
            if ($product->image != null && file_exists($storedImage)) {
                unlink($storedImage);
            }
        }

        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->image = $imagePath;

        $product->save();

        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ModelNotFoundException('Product not found.');
        }

        $storedImage = public_path('storage/' . $product->image);
        if ($product->image != null && file_exists($storedImage)) {
            unlink($storedImage);
        }

        return $product->delete();
    }
}
