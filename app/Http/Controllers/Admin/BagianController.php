<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{
    public function index()
    {
        $bidangs = Bidang::orderByDesc('updated_at')
            ->paginate(10);
        return view('admin.bidang', compact('bidangs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:bidangs,nama',
            'kepala' => 'required|string|max:255|unique:bidangs,kepala',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.bidang.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'modal-create-bidang');
        }

        Bidang::create([
            'nama' => $request->nama,
            'kepala' => $request->kepala,
        ]);

        return redirect()
            ->route('admin.bidang.index')
            ->with('success', 'Data Bidang baru berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:bidangs,nama,' . $id,
            'kepala' => 'required|string|max:255|unique:bidangs,kepala,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.bidang.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'modal-edit-bidang-' . $id);
        }

        $bidang = Bidang::findOrFail($id);

        $bidang->update([
            'nama' => $request->nama,
            'kepala' => $request->kepala,
        ]);

        return redirect()
            ->route('admin.bidang.index')
            ->with('success', 'Data Bidang "' . $bidang->nama . '" berhasil diperbarui');
    }

    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);

        if ($bidang->isUsed()) {
            return redirect()
                ->route('admin.bidang.index')
                ->with('error', 'Bidang tidak dapat dihapus karena sudah digunakan');
        }
        $nama = $bidang->nama;
        $bidang->delete();

        return redirect()
            ->route('admin.bidang.index')
            ->with('success', 'Data Bidang "' . $nama . '" berhasil dihapus');
    }
}
