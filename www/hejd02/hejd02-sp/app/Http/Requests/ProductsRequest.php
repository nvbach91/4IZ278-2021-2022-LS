<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['product_name' => "string", 'price' => "string", 'color' => "string", 'category_id' => "string", 'description' => "string", 'sizes' => "string"])] public function rules()
    {
        return [
            'product_name' => 'required|unique:products|max:255',
            'price' => 'required|numeric|min:1',
            'color' => 'required|string',
            'category_id' => 'required|exists:App\Models\Category,category_id|min:1|numeric',
            'description' => 'required|min:5|string',
            'sizes' => 'required|array',
        ];
    }

}
