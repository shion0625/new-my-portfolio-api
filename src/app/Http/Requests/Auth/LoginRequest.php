<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

final class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ];
    }

        public function messages()
    {
        return [
            'email.required' => 'emailを入力してください。',
            'email.email' => 'emailアドレスが正しい形式で入力されていません。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは6文字以上にしてください。',
        ];
    }

        protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => "login is failure",
            'errors' => $validator->errors(),
        ],422);
        throw new HttpResponseException($response);
    }
}
