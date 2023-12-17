<?php

namespace App\Http\Requests\Doctor;

use App\Models\Doctor\Doctor;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
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
            'email' => ['unique:doctors,email,'.$this->id.',id'],
            'phone' => ['required', 'max:20'],
            'section_id' => ['required', 'numeric'],
            'appointments' => ['required'],
            'image' => ['nullable','file','mimes:jpeg,png,gif|max:2048'],
        ];
    }
}
