<?php declare(strict_types=1);

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUpdateImageRequest extends FormRequest
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
            'path'=>['required','image'],
            'work_id'=>['required','numeric','min:1'],
        ];
    }

    public function messages()
    {
        return [
            'path.required' => 'Please enter a file.' ,
            'path.image' => 'Incorrect image identifier. (jpg, png, bmp, gif, svg)',
            'work_id.required' => 'Please enter the work number.' ,
            'work_id.numeric' => 'Please enter the work number as a numeric value.' ,
            'work_id.min' => 'Please enter the work number as a value greater than or equal to 1.' ,
        ];
    }

    public function skillAttributes()
    {
        return $this->only([
            'path',
            'work_id',
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => "image records create,update failure",
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($response);
    }
}
