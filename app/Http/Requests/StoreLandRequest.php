<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya user terautentikasi boleh membuat
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'owner_name'     => 'required|string|max:255',
            'kode_bidang'    => 'nullable|string|max:100|unique:lands,kode_bidang',
            'alamat'         => 'nullable|string',
            'desa_kelurahan' => 'nullable|string|max:100',
            'kecamatan'      => 'nullable|string|max:100',
            'kabupaten'      => 'nullable|string|max:100',
            'provinsi'       => 'nullable|string|max:100',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
            'luas_m2'        => 'nullable|integer|min:0',
            'status'         => 'required|in:Milik,Sewa,Belum Sertifikat,Dalam Proses',
            'dokumen'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'dokumen_expiry' => 'nullable|date|after_or_equal:today',
            'photo'          => 'nullable|image|max:5120',
        ];
    }
}
