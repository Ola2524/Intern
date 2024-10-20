<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:books',
            'description' => 'required',
            'autor_name' => 'required',
            'ISBN' => 'required',
            'publisher_name' => 'required',
            'published_date' => 'required|date',
            'total_pages' => 'required|numeric',
            'category' => 'required',
            'quantity' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Enter book title.',
            'description.required' => 'Enter book description.',
            'autor_name.required' => 'Enter book autor name.',
            'publisher_name.required' => 'Enter book publisher name.',
            'published_date.required' => 'Enter book published date.',
            'published_date.date' => 'The published date field must be a valid date.',
            'total_pages.required' => 'Enter book total pages number.',
            'total_pages.required' => 'The total pages number field must be a number.',
            'category.required' => 'Enter book category.',
            'quantity.required' => 'Enter book quantity.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400)
        );
    }
}
