<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThongTinRequest extends FormRequest
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
            'ho_va_ten' => 'required|min:4|max:50',
            'email'     => 'required|email|unique:tai_khoans,email,' .$this->id,
            'so_dien_thoai' => 'required|digits:10|unique:tai_khoans,so_dien_thoai,' .$this->id,
            'id'    => 'required|exists:tai_khoans,id',
        ];
    }
}
