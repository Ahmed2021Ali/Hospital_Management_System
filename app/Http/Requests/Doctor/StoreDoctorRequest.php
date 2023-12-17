<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email','unique:doctors'],
            'password' => ['required', 'string','min:4'],
            'phone' => ['required', 'max:20'],
            'section_id' => ['required', 'numeric'],
            'appointments' => ['required'],
            'image' => ['nullable','file','mimes:jpeg,png,gif|max:2048'],
        ];
    }
}
