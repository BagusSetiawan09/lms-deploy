<?php

namespace App\Http\Controllers;

use App\Models\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumpulanController extends Controller
{
    public function store(Request $request, $tugas_id)
    {
        $request->validate([
            'file_pengumpulan' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        $filePath = $request->file('file_pengumpulan')->store('pengumpulan', 'public');

        Pengumpulan::updateOrCreate(
            [
                'tugas_id' => $tugas_id,
                'user_id' => Auth::id(),
            ],
            [
                'file_pengumpulan' => $filePath,
                'status' => 'terkumpul',
            ]
        );

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan!');
    }
}

