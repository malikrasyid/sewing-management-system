<?php

namespace App\Http\Controllers;

use App\Services\LineService;
use Illuminate\Http\Request;

class LineController extends Controller
{
    protected $lineService;

    public function __construct(LineService $lineService)
    {
        $this->lineService = $lineService;
    }

    public function index()
    {
        $lines = $this->lineService->getAllLines();
        return view('lines.index', compact('lines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:lines,name',
        ]);

        $this->lineService->createLine($validated);

        return response()->json(['message' => 'Line berhasil ditambahkan!']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:lines,name,'.$id,
        ]);

        $this->lineService->updateLine($id, $validated);
        return response()->json(['message' => 'Line updated successfully!']);
    }

    public function destroy($id)
    {
        $this->lineService->deleteLine($id);
        return response()->json(['message' => 'Line berhasil dihapus!']);
    }
}