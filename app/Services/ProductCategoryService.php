<?php

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductCategoryService
{
    public function create(array $request)
    {
        // validation
        $validator = Validator::make($request, [
            'name' => ['required', 'max:100', 'unique:product_categories'],
        ]);

        // creating
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $productCategory = new ProductCategory();
        $productCategory->name = $request['name'];
        $productCategory->save();

        return $productCategory;
    }

    public function getAll()
    {
        return ProductCategory::all()->sortBy("id");
    }

    public function getById($id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            throw new ModelNotFoundException('Product category not found.');
        }

        return $productCategory;
    }

    public function update($id, array $data)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            throw new ModelNotFoundException('Product category not found.');
        }

        // validation
        $validator = Validator::make($data, [
            'name' => ['required', 'max:100', 'unique:products'],
        ]);

        // creating
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $productCategory->name = $data['name'];

        $productCategory->save();

        return $productCategory;
    }

    public function delete($id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            throw new ModelNotFoundException('Product category not found.');
        }

        return $productCategory->delete();
    }
}
