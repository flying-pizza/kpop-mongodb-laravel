<?php

namespace App\Http\Controllers;

use App\Http\Resources\KpopResource;
use App\Models\Kpop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class KpopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $idols = Kpop::all();
            return KpopResource::collection($idols)->additional([
                'success' => true,
                'message' => 'Menampilkan semua data K-Pop Idol'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Definisikan validasi dengan nama field yang standar (snake_case)
    $validator = Validator::make($request->all(), [
        'stage_name'    => 'required|string|max:255',
        'full_name'     => 'required|string|max:255',
        'k_name'        => 'required|string|max:255',
        'k_group'       => 'required|string',
        'country'       => 'required|string',
        'height'        => 'required|numeric|min:0',
        'weight'        => 'required|numeric|min:0',
        'birthplace'    => 'required|string',
        'gender'        => 'required|string', 
        'birth'         => 'required|string', 
        'instagram'     => 'required|string'
        
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }


    try {
        // 3. Hanya ambil data yang sudah tervalidasi (Lebih Aman)
        $validatedData = $validator->validated();
        
        $data = Kpop::create($validatedData);

        return (new KpopResource($data))
            ->additional(['message' => 'Data K-Pop Idol berhasil ditambahkan']);
            
    } catch (\Exception $e) {
        return response()->json([
            'error'   => 'Gagal menyimpan data',
            'message' => $e->getMessage() // Sembunyikan pesan ini di production untuk keamanan
        ], 500);
    }
}
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $kpop = Kpop::find($id);

            if (!$kpop) {
                return response()->json(['message' => 'Data not found'], 404);
            }

            return new KpopResource($kpop);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Database connection error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    
    $kpop = Kpop::find($id) ?? Kpop::where('stage_name', $id)->first();

    if (!$kpop) {
    return response()->json(['message' => 'Data tidak ditemukan'], 404);
}

    // 2. Validasi (Gunakan snake_case agar standar)
    $validator = Validator::make($request->all(), [
        'stage_name'    => 'string|max:255',
        'full_name'     => 'string|max:255',
        'k_name'        => 'string|max:255',
        'birth'         => 'date',
        'k_group'       => 'string',
        'country'       => 'string',
        'height'        => 'numeric',
        'weight'        => 'numeric',
        'birthplace'    => 'string',
        'gender'        => 'string',
        'instagram'     => 'string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        // 3. Update hanya field yang dikirim (validated)
        $kpop->update($validator->validated());
        
        return (new KpopResource($kpop, true, 'Data berhasil diperbarui'))
            ->additional(['message' => 'Data berhasil diperbarui']);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Gagal memperbarui data',
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function destroy(string $id)
    {
        $kpop = Kpop::findOrFail($id);
        if(!$kpop){
            return response()->json(['message'=>'Data tidak ditemukan'], 404);
        }

        $kpop->delete ();
        return response()->json(['message'=>'Data berhasil dihapus'], 200);
    }
}