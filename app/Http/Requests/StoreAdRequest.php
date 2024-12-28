<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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
            'name' => 'required|max:150|string',
            'show' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            // 'user_id' => 'required|exists:users,id',
            'url' => ['required', 'image', 'max:10240', 'mimes:jpeg,png,jpg'],
        ];
    }
}
