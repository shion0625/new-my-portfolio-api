<?php declare(strict_types=1);

namespace App\Http\Requests\Skill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateSkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' => 'required|int|max:10',
            'language' => 'required|string',
            'experience' => 'required|numeric',
        ];
    }

    public function skillAttributes()
    {
        return $this->only([
            'category',
            'language',
            'experience'
        ]);
    }

    public function messages()
    {
        return [
            'category.required' => 'Please enter a category.' ,
            'category.int' => 'Please enter a category as a number.' ,
            'category.max' => 'The maximum number of categories is 10.' ,
            'language.required' => 'Please enter a language.' ,
            'language.string' => 'Please enter the language as a string.' ,
            'experience.required' => 'Please enter years of experience.' ,
            'experience.numeric' => 'Please enter years of experience to the first decimal place.' ,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => "records create failure",
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($response);
    }
}
