<?php declare(strict_types=1);

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreWorkRequest extends FormRequest
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
            'genre'=>['required','string','max:40'],
            'title'=>['required','string','max:40'],
            'summary'=>['required','string'],
            'period'=>['required','numeric','min:0'],
            'number'=>['required','numeric','min:0'],
            'language'=>['required','string','max:100'],
            'comment'=>['string'],
            'url'=>['required','url'],
            'source_code_url'=>['required','url']
        ];
    }

    public function messages()
    {
        return [
            'genre.required' => 'Please enter a genre.' ,
            'genre.string' => 'Please enter a string genre.' ,
            'genre.max' => 'Please enter a genre of 40 characters or less.' ,
            'title.required' => 'Please enter a title.' ,
            'title.string' => 'Please enter the title as a string.' ,
            'title.max' => 'Please enter a title of 40 characters or less.' ,
            'summary.required' => 'Please enter a summary.' ,
            'summary.string' => 'Please enter a summary as a string.' ,
            'period.required' => 'Please enter a period of time.' ,
            'period.numeric' => 'Please enter the period as a number.' ,
            'period.min' => 'Please enter the period as a value greater than or equal to zero.' ,
            'number.required' => 'Please enter the number of people.' ,
            'number.numeric' => 'Please enter the number of people as a number.' ,
            'number.min' => 'The minimum number of people is 0' ,
            'language.required' => 'Please enter a language.' ,
            'language.string' => 'Please enter the language as a string.' ,
            'language.max' => 'The maximum number of characters for a language is 100.' ,
            'comment.string' => 'Please enter comment as string' , 'comment.string' => 'Please enter comment as string' ,
            'url.required' => 'Please enter the url.' ,
            'url.url' => 'Please enter the url in the correct format.' ,
            'source_code_url.required' => 'Please enter the source code url.' ,
            'source_code_url.url' => 'Please enter the source code url in the correct format.' ,
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
            'url',
            'source_code_url'
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => "works records create failure",
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($response);
    }
}
