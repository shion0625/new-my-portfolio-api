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
            'category.required' => 'カテゴリを入力してください。',
            'category.int' => 'カテゴリは数字で入力してください。',
            'category.max' => 'カテゴリの数字は最大で10です。',
            'language.required' => '言語を入力してください。',
            'language.string' => '言語は文字列で入力してください。',
            'experience.required' => '経験年数を入力してください。',
            'experience.numeric' => '経験年数を少数第一位まで入力してください。',
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
