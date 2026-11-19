<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ClothesController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $query = Clothes::query();

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->query('brand_id'));
        }

        $clothes = $query->get()->toArray();

        return $this->dynamicResponse([
            'status' => 'success',
            'data' => $clothes
        ], 200);
    }

    public function show($clothesId)
    {
        $clothes = Clothes::find($clothesId);
        if (!$clothes) {
            return $this->dynamicResponse([
                'status' => 'error',
                'message' => 'Data baju tidak ditemukan'
            ], 404);
        }

        return $this->dynamicResponse([
            'status' => 'success',
            'data' => $clothes->toArray()
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'required|unique:clothes',
            'item_name' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
            'material' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        $clothes = Clothes::create($request->all());

        return $this->dynamicResponse([
            'status' => 'success',
            'message' => 'Data baju berhasil ditambahkan',
            'data' => $clothes->toArray()
        ], 201);
    }

    public function update(Request $request, $clothesId)
    {
        $clothes = Clothes::find($clothesId);
        if (!$clothes) {
            return $this->dynamicResponse([
                'status' => 'error',
                'message' => 'Data baju tidak ditemukan'
            ], 404);
        }

        $clothes->update($request->all());

        return $this->dynamicResponse([
            'status' => 'success',
            'message' => 'Data baju berhasil diupdate',
            'data' => $clothes->toArray()
        ], 200);
    }

    public function destroy($clothesId)
    {
        $clothes = Clothes::find($clothesId);
        if (!$clothes) {
            return $this->dynamicResponse([
                'status' => 'error',
                'message' => 'Data baju tidak ditemukan'
            ], 404);
        }

        $clothes->delete();

        return $this->dynamicResponse([
            'status' => 'success',
            'message' => 'Data baju berhasil dihapus'
        ], 200);
    }
}