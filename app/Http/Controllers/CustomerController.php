<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->input('start') / $request->input('length') + 1;
            $perPage = $request->input('length', 100);

            $modelQuery = Customer::query();

            // Aplicar filtros
            if ($request->has('search') && !empty($request->input('search.value'))) {
                $searchValue = $request->input('search.value');
                $modelQuery->where(function ($query) use ($searchValue) {
                    $query->where('name', 'like', "%$searchValue%")
                        ->orWhere('document_type', 'like', "%$searchValue%")
                        ->orWhere('document', 'like', "%$searchValue%")
                        ->orWhere('address', 'like', "%$searchValue%")
                        ->orWhere('phone', 'like', "%$searchValue%");
                });
            }

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
                    'document_type' => $model->document_type,
                    'document' => $model->document,
                    'name' => $model->name,
                    'address' => $model->address,
                    'phone' => $model->phone,
                    'referencia_1' => $model->referencia_1,
                    'referencia_2' => $model->referencia_2,
                    'codeudor' => $model->codeudor,
                    'r_codeudor1' => $model->r_codeudor1,
                    'r_codeudor2' => $model->r_codeudor2,
                    'articulo' => $model->articulo,
                    'metodo_pago' => $model->metodo_pago,
                    'btns' => view('helpers.buttons', ['obj' => 'app', 'id' => $model->id, 'show' => 1, 'edit' => 1, 'delete' => 1])->render(),
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
        return view('admin.customers.index');
    }


    public function show(Customer $customer)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => $customer,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar obtener el cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'type_document' => 'required',
            'document' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'referencia_1' => 'required',
            'referencia_2' => 'required',
            'codeudor' => 'required',
            'r_codeudor1' => 'required',
            'r_codeudor2' => 'required',
            'articulo' => 'required',
            'metodo_pago' => 'required',
        ]);

        // Crear un nuevo cliente en la base de datos
        $customer = new Customer();
        $customer->document_type = $request->type_document;
        $customer->document = $request->document;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->referencia_1 = $request->referencia_1;
        $customer->referencia_2 = $request->referencia_2;
        $customer->codeudor = $request->codeudor;
        $customer->r_codeudor1 = $request->r_codeudor1;
        $customer->r_codeudor2 = $request->r_codeudor2;
        $customer->articulo = $request->articulo;
        $customer->metodo_pago = $request->metodo_pago;

        $customer->save();

        // Devolver una respuesta
        return response()->json([
            'status' => true,
            'message' => 'Cliente no correctamente',
            'data' => $customer
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'document_type' => 'required',
            'document' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'referencia_1' => 'required',
            'referencia_2' => 'required',
            'codeudor' => 'required',
            'r_codeudor1' => 'required',
            'r_codeudor2' => 'required',
            'articulo' => 'required',
            'metodo_pago' => 'required',

        ]);

        try {
            // Buscar el proveedor por su ID
            $customer = Customer::find($id);

            // Verificar si el proveedor existe
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'que esta pasando ps '
                ], 404);
            }

            // Actualizar los campos del proveedor
            $customer->update([
                'document_type' => $request->document_type,
                'document' => $request->document,
                'name' => $request->name,
                'address' => $request->address,
                'referencia_1' => $request->referencia_1,
                'referencia_2' => $request->referencia_2,
                'codeudor' => $request->codeudor,
                'r_codeudor1' => $request->r_codeudor1,
                'r_codeudor2' => $request->r_codeudor2,
                'articulo' => $request->articulo,
                'metodo_pago' => $request->metodo_pago,


            ]);

            return response()->json([
                'status' => true,
                'message' => 'Proveedor actualizado correctamente',
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar actualizar el proveedor',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete();
            return response()->json([
                'status' => true,
                'message' => 'Cliente eliminado correctamente.'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No se encontró el cliente.'
            ], 404);

        }

    }


} 
