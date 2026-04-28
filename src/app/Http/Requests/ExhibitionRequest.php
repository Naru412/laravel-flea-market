<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
           'image' => 'required|mimes:jpeg,png',
            'categories' => 'required',
            'condition' => 'required|not_in:選択してください',

            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:0',

            'brand' => 'nullable|max:255',
        ];
    }

     public function messages()
    {
        return [
            'image.required' => '商品画像をアップロードしてください',
            'image.mimes' => '商品画像はjpegまたはpng形式で選択してください',

            'categories.required' => 'カテゴリーを選択してください',

            'condition.required' => '商品の状態を選択してください',
            'condition.not_in' => '商品の状態を選択してください',

            'name.required' => '商品名を入力してください',

            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以内で入力してください',

            'price.required' => '販売価格を入力してください',
            'price.numeric' => '販売価格は数字で入力してください',
            'price.min' => '販売価格は0円以上で入力してください',
        ];
    }
}
