<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLandRequest extends FormRequest
{
  public function authorize(): bool
  {
    return auth()->check();
  }

  public function rules(): array
  {
    $landId = $this->route('land');

    return [
      'owner_name' => 'required|string|max:255',
      'kode_bidang' => ['nullable', 'string', 'max:100', Rule::unique('lands', 'kode_bidang')->ignore($landId)],
      'alamat' => 'nullable|string',
      'desa_kelurahan' => 'nullable|string|max:100',
      'kecamatan' => 'nullable|string|max:100',
      'kabupaten' => 'nullable|string|max:100',
      'provinsi' => 'nullable|string|max:100',
      'latitude' => 'nullable|numeric|between:-90,90',
      'longitude' => 'nullable|numeric|between:-180,180',
      'luas_m2' => 'nullable|integer|min:0',
      'status' => 'required|in:Milik,Sewa,Belum Sertifikat,Dalam Proses',
      'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
      'dokumen_expiry' => 'nullable|date|after_or_equal:today',
      'photo' => 'nullable|image|max:5120',
    ];
  }
}
