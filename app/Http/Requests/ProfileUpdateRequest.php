<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name_ku' => ['required', 'string', 'max:255'],
            'name_ar' => ['nullable', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];

        if ($this->user()->isDoctor()) {
            $rules = array_merge($rules, [
                'specialization_id' => ['required', 'exists:specializations,id'],
                'experience_years' => ['required', 'integer', 'min:0'],
                'consultation_fee' => ['required', 'numeric', 'min:0'],
                'qualifications' => ['nullable', 'string'],
                'bio' => ['nullable', 'string'],
                'profile_image' => ['nullable', 'image', 'max:2048'],
            ]);
        }

        return $rules;
    }
}
