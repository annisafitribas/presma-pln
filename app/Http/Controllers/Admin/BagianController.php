<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BagianController extends Controller
{
    public function index()
    {
        $bagians = Bagian::orderByDesc('updated_at')
            ->paginate(10);
        return view('admin.bagian', compact('bagians'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:bagians,nama',
            'kepala' => 'required|string|max:255|unique:bagians,kepala',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.bagian.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'modal-create-bagian');
        }

        Bagian::create([
            'nama' => $request->nama,
            'kepala' => $request->kepala,
        ]);

        return redirect()
            ->route('admin.bagian.index')
            ->with('success', 'Data bagian baru berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:bagians,nama,' . $id,
            'kepala' => 'required|string|max:255|unique:bagians,kepala,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.bagian.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'modal-edit-bagian-' . $id);
        }

        $bagian = Bagian::findOrFail($id);

        $bagian->update([
            'nama' => $request->nama,
            'kepala' => $request->kepala,
        ]);

        return redirect()
            ->route('admin.bagian.index')
            ->with('success', 'Data bagian "' . $bagian->nama . '" berhasil diperbarui');
    }

    public function destroy($id)
    {
        $bagian = Bagian::findOrFail($id);

        if ($bagian->isUsed()) {
            return redirect()
                ->route('admin.bagian.index')
                ->with('error', 'Bagian tidak dapat dihapus karena sudah digunakan');
        }
        $nama = $bagian->nama;
        $bagian->delete();

        return redirect()
            ->route('admin.bagian.index')
            ->with('success', 'Data bagian "' . $nama . '" berhasil dihapus');
    }
}
