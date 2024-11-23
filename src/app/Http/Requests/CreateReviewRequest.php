<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'comment' => 'nullable|max:400',
            'photo' => 'nullable|image|mimes:jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'photo.image' => 'アップロード可能なファイル形式は画像のみです！',
            'photo.mimes' => 'jpegまたはpng形式のみアップロード可能です！',
            'photo.max' => '画像サイズは2MB以下にしてください！',
        ];
    }
}
