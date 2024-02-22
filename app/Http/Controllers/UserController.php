<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee as Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {

        $options = [
            'supervisor' => DB::table('employees')->distinct()->pluck('name')->toArray()
            //'option2' => DB::table('table2')->distinct()->pluck('field2')->toArray()
            //'option3' => DB::table('table3')->distinct()->pluck('filed3')->toArray()
        ];

        $users = Employee::all();

        return view("user.index", compact("options", "users"));
    }

    public function table() {
        $users = Employee::all();

        return view("user.table", compact("users"));
    }

    public function add(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        $employee = new Employee();
        $employee->id = $user->id;
        $employee->user_id = $user->id;
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->supervisor_id = $request->supervisor;
        $employee->save();

        return response()->json(['message' => 'Employee added successfully']);
    }

    public function update(Request $request)
    {
        $user = Employee::find($request->ID);
        $user->name = $request->Name;
        $user->position = $request->Position;
        $user->supervisor_id = Employee::where('name', $request->Supervisor)->first()->id;
        $user->save();

        $user = User::find($user->user_id);
        $user->email = $request->Email;
        $user->username = $request->Username;
        
        $request->Password ?? $user->password = Hash::make($request->Password);

        $user->save();

        return response()->json(['message' => 'Employee updated successfully']);
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        $user = User::find($employee->user->id);

        $employee->delete();
        $user->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}