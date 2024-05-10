<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function model()
    {
        return app()->make(Employee::class);
    }

    public function userModel()
    {
        return app()->make(User::class);
    }

    public function contactModel()
    {
        return app()->make(Contact::class);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->input('start') / $request->input('length') + 1;
            $perPage = $request->input('length', 100);

            $modelQuery = $this->model()->query();

            // Aplicar filtros
            if ($request->has('search') && !empty($request->input('search.value'))) {
                $searchValue = $request->input('search.value');
                $modelQuery->where(function ($query) use ($searchValue) {
                    $query->whereHas('user', function ($query) use ($searchValue) {
                        $query->where('name', 'like', "%$searchValue%")
                            ->orWhere('email', 'like', "%$searchValue%");
                    })->orWhere('document_type', 'like', "%$searchValue%")
                        ->orWhere('document', 'like', "%$searchValue%")
                        ->orWhere('phone', 'like', "%$searchValue%")
                        ->orWhere('eps', 'like', "%$searchValue%")
                        ->orWhere('position', 'like', "%$searchValue%")
                        ->orWhere('salary', 'like', "%$searchValue%");
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
                $user = $model->user;
                $data[] = [
                    'id' => $model->id,
                    'name' => '<div><label class="text-capitalize">' . $user->name . '</label><br><label class="small">' . $user->email . '</label></div>',
                    'document' => $model->document_type . ', ' . $model->document,
                    'phone' => $model->phone,
                    'eps' => $model->eps,
                    'position' => $model->position,
                    'salary' => '$' . number_format($model->salary, 0, ',', '.'),
                    'status' => ((int)$model->status === 1) ? '<span class="badge text-bg-success" role="alert">Activo</span>' : '<span class="badge text-bg-danger" role="alert">Inactivo</span>',
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
        return view('admin.employee.index');
    }


    public function show(Employee $employee)
    {
        try {
            if ($employee !== null && $employee->user !== null) {
                $employee['name'] = $employee->user->name;
                $employee['email'] = $employee->user->email;
                $employee['user_id'] = $employee->user->id;
                $employee['contacts'] = $employee->contacts;
                $employee['status'] = $employee->status;
                $employee['start_date'] = $employee->start_date;
                unset($employee['user']);
                return response()->json([
                    'status' => true,
                    'data' => $employee,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No se pudo encontrar el empleado o el empleado no tiene un usuario asociado.',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar obtener el empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        // Validar los datos del formulario
        $request->validate([
            'document_type' => 'required',
            'document' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'eps' => 'required',
            'rh' => 'required',
            'position' => 'required',
            'salary' => 'required',
            'status' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        try {
            $user = $this->userModel()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->document),
            ]);
            $employee = $user->employee()->create([
                'document_type' => $request->document_type,
                'document' => $request->document,
                'phone' => $request->phone,
                'address' => $request->address,
                'eps' => $request->eps,
                'rh' => $request->rh,
                'gender' => $request->gender,
                'position' => $request->position,
                'salary' => $request->salary,
                'status' => $request->status,
                'start_date' => $request->start_date
            ]);
            // Crear un nuevo empleado en la base de datos
            /* $employee = new Employee();
             $employee->document_type = $request->document_type;
             $employee->document = $request->document;
             $employee->phone = $request->phone;
             $employee->address = $request->address;
             $employee->eps = $request->eps;
             $employee->rh = $request->rh;
             $employee->position = $request->position;
             $employee->salary = $request->salary;
             $employee->status = $request->status;
             $employee->gender = $request->gender;
             $employee->user_id = $user->id;
             $employee->save();*/

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Empleado creado correctamente',
                'data' => $employee
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar crear el empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'document_type' => 'required',
            'document' => 'required',
            'name' => 'required',
            'address' => 'required',

            'phone' => 'required',
            'eps' => 'required',
            'rh' => 'required',
            'position' => 'required',
            'salary' => 'required',
            'status' => 'required',
            'gender' => 'required',
        ]);
        DB::beginTransaction();
        try {
            // Buscar el empleado por su ID
            $employee = Employee::find($id);

            // Verificar si el empleado existe
            if (!$employee) {
                return response()->json([
                    'status' => false,
                    'message' => 'Empleado no encontrado',
                ], 404);
            }

            // Actualizar los campos del empleado
            $this->userModel()->where('id', $employee->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $employee->update([
                'document_type' => $request->document_type,
                'document' => $request->document,
                'address' => $request->address,
                'start_date' => $request->start_date,
                'phone' => $request->phone,
                'eps' => $request->eps,
                'rh' => $request->rh,
                'position' => $request->position,
                'salary' => $request->salary,
                'status' => $request->status,
                'gender' => $request->gender,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Empleado actualizado correctamente',
                'data' => $employee,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Hubo un error al intentar actualizar el empleado',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy($id)
    {
        $employee = employee::find($id);
        if ($employee) {
            $employee->delete();
            return response()->json([
                'status' => true,
                'message' => 'empleado eliminado correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'El empleado no fue encontrado',
            ], 404);
        }
    }
}
