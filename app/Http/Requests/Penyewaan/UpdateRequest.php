<?php

namespace App\Http\Requests\Penyewaan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'id_lapangan' => 'required',
            'lama_sewa' => 'required|numeric',
            'uang_bayar' => 'required|numeric',
            'tanggal_sewa' => 'required|date_format:Y-m-d',
            'jam_sewa' => 'required',
        ];
    }
}
