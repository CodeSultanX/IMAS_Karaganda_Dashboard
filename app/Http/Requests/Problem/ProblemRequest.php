<?php

namespace App\Http\Requests\Problem;

use Illuminate\Foundation\Http\FormRequest;

class ProblemRequest extends FormRequest
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
           'title' => 'required|string',
           'result' => 'required|string',
           'status' => 'required|string',
           'level' => 'required|string',
           'color' => 'required|string',
           'project_id' => 'required|integer',
           'regions' => 'required|array',
           'images' => 'nullable|array',
           'user_id' => 'nullable|integer',
        ];
    }
}
