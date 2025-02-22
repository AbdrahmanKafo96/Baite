<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'note' => 'required|max:150|string',
            //'service_seclected' => 'required',
            'total_price' => 'required',
           // 'quantity_selected' => 'required',
            'service_id' => 'required|exists:my_service_level_tows,id',
            //'user_id' => 'required|exists:customers,id',
        ];
    }
}
