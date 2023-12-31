<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoaDonRequest extends FormRequest
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
            'ho_va_ten'     => 'required',
            'so_dien_thoai' => 'required|digits:10',
            'dia_chi'       => 'required',
            'thuc_tra'      => 'required',
            'giam_gia'      => 'required',
            'tong_tien'     => 'required'
        ];
    }
}
