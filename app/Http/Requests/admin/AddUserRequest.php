<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'username' =>'required|unique:users,username',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email',
            'name' => 'required'
        ];
    }

    public function messages()
    {
      return [
        'required' => ':attribute không được bỏ trống',
        'min' => ':attribute tối thiểu :min kí tự',
        'email' => 'Vui lòng nhập đúng định dạng email',
        'unique' => ':attribute đã được sử dụng'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
            'email' => 'Email',
            'name' => "Tên người dùng"
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
