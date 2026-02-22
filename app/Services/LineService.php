<?php

namespace App\Services;

use App\Models\Line;

class LineService
{
    public function getAllLines()
    {
        return Line::orderBy('name', 'asc')->get();
    }

    public function createLine(array $data)
    {
        return Line::create($data);
    }

    public function deleteLine($id)
    {
        return Line::destroy($id);
    }
}