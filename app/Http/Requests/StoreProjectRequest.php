<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => [
                'required',
                'max:200',
                'min:3',
            ],
            'image' => 'nullable|file',
            'content' => 'required',
            'type_id' => 'nullable|exists:types,id',
            'technology' => 'nullable|exists:tecnology,id'
        ];
    }
    public function messages()
    {

        return [
            'title.required' => 'Campo obbligatorio',
            'title.unique' => 'Progetto già esistente',
            'title.max' => 'Il titolo deve avere :max caratteri',
            'title.min' => 'Il titolo deve avere :min caratteri',
            'image.max' => 'L\'immagine non puo\' superare :size kilobytes',
            'content.required' => 'Campo obbligatorio'
        ];
    }
}
