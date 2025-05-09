<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class InternRegisterRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
        ];

        if($this->isMethod('post')) {
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
        
    }
    
    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        $messages = [
            'name.required' => 'Please enter your name',
            
        ];

        if($this->isMethod('post')) {
            $messages['email.required'] = 'Please enter your email address';
            $messages['email.email'] = 'Please enter a valid email address';
            $messages['email.unique'] = 'This email is already registered';
            $messages['password.required'] = 'Please enter a password';
            $messages['password.confirmed'] = 'Password confirmation does not match';
        }

        return $messages;
    }
} 