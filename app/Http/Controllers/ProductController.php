<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $page = $request->input('start') / $request->input('length') + 1;
        $perPage = $request->input('length', 100);

        $modelQuery = Product::query();

        // Aplicar filtros
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $searchValue = $request->input('search.value');
            $modelQuery->where('type', 'like', "%$searchValue%")
                       ->orWhere('marca', 'like', "%$searchValue%")
                       ->orWhere('referencia', 'like', "%$searchValue%")
                       ->orWhere('description', 'like', "%$searchValue%")
                       ->orWhere('cantidad', 'like', "%$searchValue%")
                       ->orWhere('notes', 'like', "%$searchValue%");
        }

        $modelQuery->orderBy('id', 'desc');

        $totalRecords = $modelQuery->count();
        $results = $modelQuery
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        $data = [];
        foreach ($results as $product) {
            $data[] = [
                'id' => $product->id,
                'type' => $product->type,
                'marca' => $product->marca,
                'referencia'=> $product->referencia,
                'description' => $product->description,
                'cantidad' => $product->cantidad,
                'notes' => $product->notes,
                'created_at' => $product->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $product->updated_at->format('Y-m-d H:i:s'),
                'btns' => view('helpers.buttons', ['obj' => 'app', 'id' => $product->id, 'show' => 1, 'edit' => 1, 'delete' => 1])->render(),
            ];
        }
        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Esto se ajustará más adelante para reflejar el número de registros después del filtrado
            'data' => $data,
        ];
        return response()->json($response);
    }
    return view('admin.products.index');
}


    public function show(Product $product)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => $product->toArray(), // Convertir el modelo a un array asociativo para incluir todos los datos
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
        // Validar los datos del formulario
        $request->validate([
            'type' => 'required',
            'marca' => 'required',
            'referencia' => 'required',
            'description' => 'required',
            'cantidad' => 'required',
            'notes' => 'required',
        ]);
    
        // Crear un nuevo producto en la base de datos
        $product = new Product();
        $product->type = $request->type;
        $product->marca = $request->marca;
        $product->referencia = $request->referencia;
        $product->description = $request->description;
        $product->cantidad = $request->cantidad;
        $product->notes = $request->notes;
        $product->save();
    
        // Devolver una respuesta
        return response()->json([
            'status' => true,
            'message' => 'Producto creado correctamente',
            'data' => $product
        ], 200);
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'marca' => 'required',
            'referencia' => 'required',
            'description' => 'required',
            'cantidad' => 'required',
            'notes' => 'required'
        ]);
    
        try {
            // Buscar el proveedor por su ID
            $product = Product::find($id);
    
            // Verificar si el proveedor existe
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'que esta pasando ps '
                ], 404);
            }
    
            // Actualizar los campos del proveedor
            $product->update([
                
            'id' => $request->id,
            'type' => $request->type,
            'marca' => $request->marca,
            'referencia' => $request->referencia,
            'description' => $request->description,
            'cantidad' => $request->cantidad,
            'notes' => $request->notes,
            'created_at' => $request->created_at,
            'updated_at' => $request->update_at,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Proveedor actualizado correctamente',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar actualizar el proveedor',
                'error' => $e->getMessage()
            ], 500);
            refreshTable();
        }
        
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'status' => true,
                'message' => 'Producto eliminado correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'El producto no fue encontrado',
            ], 404);
        }
    }
}
