<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Models\TugasSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        // daftar semua tugas
        $tugas = Tugas::with(['submissions.user'])->get();
        return view('tugas.index', compact('tugas'));
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);

        // ambil submission berdasarkan user login
        $submission = TugasSubmission::where('user_id', Auth::id())
                                ->where('tugas_id', $tugas->id)
                                ->first();

        return view('tugas.show', compact('tugas', 'submission'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:zip,rar,pdf,docx',
            'jawaban' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('tugas', 'public');
        }

        TugasSubmission::updateOrCreate(
            ['tugas_id' => $id, 'user_id' => Auth::id()],
            ['file_path' => $path, 'jawaban' => $request->jawaban, 'status' => 'submitted']
        );

        return back()->with('status', 'Tugas berhasil dikumpulkan!');
    }

    public function pengumpulan($id)
    {
        $tugas = Tugas::findOrFail($id);
         $submissions = TugasSubmission::with('user')
        ->where('tugas_id', $id)
        ->get();
        return view('tugas.pengumpulan', compact('tugas', 'submissions'));
    }

   public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $submission = TugasSubmission::findOrFail($id);

        $submission->update([
            'nilai' => $request->nilai,
            'feedback' => $request->feedback,
            'status' => 'graded',
        ]);

        return back()->with('status', 'Nilai berhasil diberikan!');
    }


    public function create()
    {
        return view('tugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx'
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('tugas', 'public');
        }

        Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'file' => $path,
        ]);

        return redirect()->route('tugas.index')->with('status', 'Tugas berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        // Cari data tugas berdasarkan ID
        $tugas = Tugas::findOrFail($id);

        // Hapus file kalau ada
        if ($tugas->file && Storage::exists('public/tugas/' . $tugas->file)) {
            Storage::delete('public/tugas/' . $tugas->file);
        }

        // Hapus record tugas
        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function destroyByJudul($judul)
    {
        Tugas::where('judul', $judul)->delete();

        return redirect()->route('tugas.index')
            ->with('success', "Semua tugas dengan judul '$judul' berhasil dihapus.");
    }

}
