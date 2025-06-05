<?php

namespace App\Http\Requests\Lapangan;

use Illuminate\Foundation\Http\FormRequest;

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
  public function rules()
  {
    return [
      'no_lapangan' => 'required',
      'harga_per_jam' => 'required|numeric',
      'deskripsi' => 'required',
      'status' => 'required',
    ];
  }
}
