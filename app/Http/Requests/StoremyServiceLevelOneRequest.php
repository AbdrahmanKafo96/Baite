<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoremyServiceLevelOneRequest extends FormRequest
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
            'service_name' => 'required|max:150|string',
            'show' => 'required',
            'description' => 'required',
            'service_id' => 'required|exists:my_service_level_ones,id',
            // 'user_id' => 'required|exists:users,id',
        ];
    }
}
