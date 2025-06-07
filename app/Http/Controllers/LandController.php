<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLandRequest;
use App\Http\Requests\UpdateLandRequest;
use App\Models\Land;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = Land::query();

    if ($request->filled('search')) {
      $search = $request->input('search');
      $query->where(function ($q) use ($search) {
        $q->where('kode_bidang', 'like', "%{$search}%")
          ->orWhere('desa_kelurahan', 'like', "%{$search}%")
          ->orWhere('owner_name', 'like', "%{$search}%");
      });
    }

    if ($request->filled('kecamatan')) {
      $query->where('kecamatan', $request->input('kecamatan'));
    }

    if ($request->filled('status')) {
      $query->where('status', $request->input('status'));
    }

    $lands = $query->paginate(15);

    return view('lands.index', compact('lands'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('lands.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreLandRequest $request)
  {
    $data = $request->validated();
    $data['created_by'] = auth()->id();

    if ($request->hasFile('dokumen')) {
      // simpan ke Azure
      $data['dokumen_path'] = $request->file('dokumen')
        ->store('dokumen', 'azure');
    }

    if ($request->hasFile('photo')) {
      $data['photo_path'] = $request->file('photo')
        ->store('photos', 'azure');
    }

    Land::create($data);

    return redirect()->route('lands.index')
      ->with('success', 'Data tanah berhasil ditambahkan.');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $land = Land::findOrFail($id);
    return view('lands.show', compact('land'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $land = Land::findOrFail($id);
    return view('lands.edit', compact('land'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateLandRequest $request, $id)
  {
    $land = Land::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('dokumen')) {
      $data['dokumen_path'] = $request->file('dokumen')
        ->store('dokumen', 'azure');
    }

    if ($request->hasFile('photo')) {
      $data['photo_path'] = $request->file('photo')
        ->store('photos', 'azure');
    }

    $land->update($data);

    return redirect()->route('lands.index')
      ->with('success', 'Data tanah berhasil diperbarui.');
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $land = Land::findOrFail($id);
    $land->delete();

    return redirect()->route('lands.index')
      ->with('success', 'Data tanah berhasil dihapus.');
  }

  public function expiring()
  {
    $today = Carbon::today();
    $threshold = $today->copy()->addDays(30);

    $lands = Land::whereNotNull('dokumen_expiry')
      ->whereBetween('dokumen_expiry', [$today, $threshold])
      ->paginate(15);

    return view('lands.expiring', compact('lands'));
  }
}
