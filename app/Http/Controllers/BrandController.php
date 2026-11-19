<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $brands = Brand::all()->toArray();
        return $this->dynamicResponse([
            'status' => 'success',
            'data' => $brands
        ], 200);
    }

    public function show($brandId)
    {
        $brand = Brand::find($brandId);
        if (!$brand) {
            return $this->dynamicResponse([
                'status' => 'error',
                'message' => 'Data brand tidak ditemukan'
            ], 404);
        }

        return $this->dynamicResponse([
            'status' => 'success',
            'data' => $brand->toArray()
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_code' => 'required|unique:brands',
            'brand_name' => 'required',
            'origin_country' => 'required',
            'founder_name' => 'required',
            'established_year' => 'required|integer',
            'contact_email' => 'required|email',
            'phone_number' => 'required',
            'headquarters_address' => 'required',
            'website_url' => 'nullable'
        ]);

        $brand = Brand::create($request->all());

        return $this->dynamicResponse([
            'status' => 'success',
            'message' => 'Brand berhasil ditambahkan',
            'data' => $brand->toArray()
        ], 201);
    }

    public function update(Request $request, $brandId)
    {
        $brand = Brand::find($brandId);
        if (!$brand) {
            return $this->dynamicResponse([
                'status' => 'error',
                'message' => 'Data brand tidak ditemukan'
            ], 404);
        }

        $brand->update($request->all());

        return $this->dynamicResponse([
            'status' => 'success',
            'message' => 'Brand berhasil diupdate',
            'data' => $brand->toArray()
        ], 200);
    }

    public function destroy($brandId)
    {
        $brand = Brand::find($brandId);
        if (!$brand) {
            return $this->dynamicResponse([
                'status' => 'error',
                'message' => 'Data brand tidak ditemukan'
            ], 404);
        }

        $brand->delete();

        return $this->dynamicResponse([
            'status' => 'success',
            'message' => 'Brand berhasil dihapus'
        ], 200);
    }
}