<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AddNewsRequest extends FormRequest
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
            'title' =>'required|max:200',
            'sumary' => 'required',
            'content' => 'required',
            'image' => 'required|image',

        ];
    }

    public function messages()
    {
      return [
        'required' => ':attribute không được bỏ trống',
        'image' => ':attribute không hợp lệ',
        'max' => ':attribute tối đa :max kí tự'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề tin tức',
            'sumary' => 'Tóm tắt tin tức',
            'content' => 'Nội dung tin tức',
            'image' => "Hình ảnh"
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($validator->errors()->count()>0)
                $validator->errors()->add('msg', 'Đã có lỗi xảy ra vui lòng kiểm tra lại!');
        });

    }


    protected function prepareForValidation()
{
    $this->merge([
        'create_at' => date('D-m-Y H:i:s')
    ]);
}

}
