<?php

namespace App\Http\Controllers;

use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DataTables;

class WareHouseController extends Controller
{
    public function index()
    {
        Session::put('admin_page', 'WareHouse');
        return view('admin.wareHouse.index');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $rule = [
                'name' => 'required|max:255',
                'detail' => 'required|max:255',
                'phone' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Please Enter Warehouse Name.',
                'detail.required' => 'Please Enter Warehouse Details.',
                'phone.required' => 'Please Enter Warehouse Phone Number.',
            ];
            $this->validate($request, $rule, $customMessage);
            if ($data['id'] == null) {
                $wareHouse = new WareHouse();
                $wareHouse->name = $data['name'];
                $wareHouse->detail = $data['detail'];
                $wareHouse->phone = $data['phone'];
                $response = $wareHouse->save();
                return response()->json($response);
            } else {
                $wareHouse = WareHouse::findorfail($data['id']);
                $wareHouse->name = $data['name'];
                $wareHouse->detail = $data['detail'];
                $wareHouse->phone = $data['phone'];
                $response = $wareHouse->save();
                return response()->json($response);
            }
        }
    }

    public function get(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = WareHouse::findorfail($request->input('id'));
            return response()->json($data);
        } else {
            $data = WareHouse::all()->sortByDesc("id");
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button class="btn btn-primary mr-2" data-toggle="modal" data-target="#wareHouseModal,m" data-id="' . $row['id'] . '" id="edit">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $response = WareHouse::where('id', $data['id'])->delete();
            return response()->json($response);
        }
    }
}
