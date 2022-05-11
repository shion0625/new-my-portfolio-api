<?php declare(strict_types=1);

namespace App\Http\Requests\Skill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSkillRequest extends FormRequest
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
            'category' => 'int|max:10',
            'language' => 'string',
            'experience' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'category.int' => 'Please enter the category as a number.' ,
            'category.max' => 'The maximum number of categories is 10.' ,
            'language.string' => 'The language must be entered as a string.' ,
            'experience.numeric' => 'Please enter years of experience to the first decimal place.' ,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => "records update failure",
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($response);
    }
}
