<?php

namespace App\Http\Requests\Borrowing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BorrowingRequest extends FormRequest
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
            'book_id' => 'required|integer',
            'returning_date' => 'required|date',
        ];
    }

    public function messages() {
        return [
            'book_id.required' => 'Choose book.',
            'book_id.integer' => 'the book id should number.',
            'returning_date.required' => 'Enter the returning date.',
            'returning_date.date' => 'The returning date should be a valid date.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400)
        );
    }
}
