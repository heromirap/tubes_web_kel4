<?php

namespace App\Http\Requests\Penyewaan;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
      'id_lapangan' => 'required',
      'tanggal_sewa' => 'required|date_format:Y-m-d',
      'jam_sewa' => 'required',
      'lama_sewa' => 'required|numeric',
      'uang_bayar' => 'required|numeric',
    ];
  }
}
