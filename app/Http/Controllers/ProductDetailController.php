<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
   

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->input('start') / $request->input('length') + 1;
            $perPage = $request->input('length', 100);

            $modelQuery = ProductDetail::query();
            $modelQuery->orderBy('id', 'desc');

            $totalRecords = $modelQuery->count();
            $results = $modelQuery
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();
            $data = [];
            foreach ($results as $model) {
                $data[] = [
                    'id' => $model->id,
                    'product_id' => $model->id,
                    'product_name' => $model->name,
                    'sku' => $model->sku,
                    'barcode' => $model->barcode,
                    'size' => $model->size,
                    'color' => $model->color,
                    'material' => $model->material,
                    'location' => $model->location,
                    'price' => '$' . number_format($model->price, 2),
                    'stock' => $model->stock,
                    'date_manufactured' => $model->date_manufactured,
                    'notes' => $model->notes,
                    'btns' => view('helpers.buttons', ['obj' => 'product_details', 'id' => $model->id, 'show' => 1, 'edit' => 1, 'delete' => 1])->render(),
                ];
            }
            $response = [
                'draw' => $request->input('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $data,
            ];
            return response()->json($response);
        }
        return view('admin.product_details.index');
    }

    public function show(ProductDetail $productDetail)
    
    {
        try {
            return response()->json([
                'status' => true,
                'data' => $productDetail,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar obtener el proveedor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'sku' => 'required',
            'barcode' => 'required',
            'size' => 'required',
            'color' => 'required',
            'material' => 'required',
            'location' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'date_manufactured' => 'required',
            'notes' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $productDetail = $this->model()->create([
                'product_id' => $request->product_id,
                'sku' => $request->sku,
                'barcode' => $request->barcode,
                'size' => $request->size,
                'color' => $request->color,
                'material' => $request->material,
                'location' => $request->location,
                'price' => $request->price,
                'stock' => $request->stock,
                'date_manufactured' => $request->date_manufactured,
                'notes' => $request->notes
            ]);
            $data  = $productDetail->load('product');
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Detalles del producto guardados correctamente',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar guardar los detalles del producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $productDetail = ProductDetail::findOrFail($id);
        $request->validate([
            'product_id' => 'required',
            'sku' => 'required',
            'barcode' => 'required',
            'size' => 'required',
            'color' => 'required',
            'material' => 'required',
            'location' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'date_manufactured' => 'required',
            'notes' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $productDetail->update([
                'product_id' => $request->product_id,
                'sku' => $request->sku,
                'barcode' => $request->barcode,
                'size' => $request->size,
                'color' => $request->color,
                'material' => $request->material,
                'location' => $request->location,
                'price' => $request->price,
                'stock' => $request->stock,
                'date_manufactured' => $request->date_manufactured,
                'notes' => $request->notes
            ]);
            $data = $productDetail->load('product');
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Detalles del producto actualizados correctamente',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar actualizar los detalles del producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $productDetail = ProductDetail::findOrFail($id);
        $productDetail->delete();
        return response()->json([
            'status' => true,
            'message' => 'Detalles del producto eliminados correctamente'
        ], 200);
    }
}
