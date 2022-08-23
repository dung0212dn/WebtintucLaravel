<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoriesRequest extends FormRequest
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
            'name' => 'required|unique:categories,name'
        ];
    }

    public function messages()
    {
      return [
        'required' => ':attribute không được bỏ trống',
        'unique' => ':attribute đã tồn tại'
        ];
    }

    public function attributes()
    {
        return [
            'name' => "Tên danh mục"
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
