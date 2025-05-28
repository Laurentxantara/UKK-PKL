<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rekrutpkl;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FormulirController extends Controller
{
    public function index()
    {
        $rekrutpkl = Rekrutpkl::with('siswa')->get()->map(function($rekrutpkl) {
                $tanggal_mulai = Carbon::parse($rekrutpkl->tanggal_mulai);
                $tanggal_selesai = Carbon::parse($rekrutpkl->tanggal_selesai);
                
                $durasi = $tanggal_mulai->diffInDays($tanggal_selesai);
                return [
                    'id' => $rekrutpkl->id,
                    'siswa' => [
                        'id' => $rekrutpkl->siswa->id,
                        'nama' => $rekrutpkl->siswa->nama
                    ],                
                    'guru' => [
                        'id' => $rekrutpkl->guru->id,
                        'nama' => $rekrutpkl->guru->nama
                    ],               
                    'industri' => [
                        'id' => $rekrutpkl->industri->id,
                        'nama' => $rekrutpkl->industri->nama
                    ],
                    'tanggal_mulai' => $rekrutpkl->tanggal_mulai->format('d-m-Y'),
                    'tanggal_selesai' => $rekrutpkl->tanggal_selesai->format('d-m-Y'),
                    'durasi' => $durasi . ' hari',
                ];
        });
        return response()->json($rekrutpkl);
    }

    public function store(Request $request)
    {
        try {
            $messages = [
                'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama dengan atau setelah tanggal mulai',
                'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
                'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
                'id_siswa.required' => 'Siswa harus dipilih',
                'id_siswa.unique' => 'Anda sudah mendaftar PKL sebelumnya',
                'id_guru.required' => 'Guru harus dipilih',
                'id_industri.required' => 'Industri harus dipilih',
            ];

            $validated = $request->validate([
                'id_siswa' => [
                    'required',
                    'exists:siswa,id',
                    Rule::unique('rekrutpkl', 'id_siswa')

                ],
                'id_guru' => 'required|exists:guru,id',
                'id_industri' => 'required|exists:industri,id',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => [
                    'required',
                    'date',
                    'after_or_equal:tanggal_mulai',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->has('tanggal_mulai') && $value) {
                            $mulai = Carbon::parse($request->tanggal_mulai);
                            $selesai = Carbon::parse($value);
                            if ($mulai->diffInDays($selesai) < 90) {
                                $fail('Durasi PKL minimal harus 90 hari.');
                            }
                        }
                    }
                ],
            ], $messages);

            $rekrutpkl = Rekrutpkl::create($validated);

            return response()->json([
                'message' => 'Formulir berhasil disimpan.',
                'data' => $rekrutpkl
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);
        }
    }
}
