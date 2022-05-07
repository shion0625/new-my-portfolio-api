<?php

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateWorkRequest extends FormRequest
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
            'genre'=>['numeric','min:0','max:15'],
            'title'=>['string','max:25'],
            'summary'=>['string'],
            'period'=>['numeric','min:0'],
            'number'=>['numeric','min:0'],
            'language'=>['string','max:100'],
            'comment'=>['string'],
            'url'=>['url']
        ];
    }

    public function messages()
    {
        return [
            'genre.numeric' => 'ジャンルを数値で入力してください。',
            'genre.min' => 'ジャンルの数値の最小の値は0です。',
            'genre.max' => 'ジャンルの数値の最大の値は15です。',
            'title.string' => 'タイトルは文字列で入力してください。',
            'title.max' => 'タイトルは25文字以内で入力してください。',
            'summary.string' => '概要をを文字列で入力してください。',
            'period.numeric' => '期間を数値で入力してください。',
            'period.max' => '期間は0以上の値で入力してください。',
            'number.numeric' => '人数は数値で入力してください。',
            'number.min' => '人数の最小の値は0です。',
            'language.string' => '言語を文字列で入力してください。',
            'language.max' => '言語の最大文字数は100文字です。',
            'comment.string' => 'コメントを文字列で入力してください。',
            'url.url' => 'urlを正しい形式で入力してください。',
        ];
    }

    public function skillAttributes()
    {
        return $this->only([
            'genre',
            'title',
            'summary',
            'period',
            'number',
            'language',
            'comment',
            'url'
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => "works records update failure",
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($response);
    }
}
