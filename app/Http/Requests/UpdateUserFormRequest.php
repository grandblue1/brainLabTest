<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'string|min:8|nullable',
            'status' => 'string',
            'avatar' => 'nullable|string',
        ];
    }

    protected function prepareForValidation()
    {
        if (empty($this->password)) {
            $this->request->remove('password');
        }
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        return $validated;
    }
}
