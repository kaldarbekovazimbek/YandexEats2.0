<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'descriptions' => ['required', 'string'],
            'price' => ['required', 'decimal:2'],
            'category' => ['required', 'string', 'in:fast food, cool drinks, health food, national food, desserts'],
            'restaurant_id' => ['required', 'integer'],
        ];
    }
}
