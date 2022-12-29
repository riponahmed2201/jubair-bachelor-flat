<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function getAllAdminList()
    {
        try {
            $data = User::where('role', '=', 'admin')->orderBy('id', 'desc')->get();
            return $this->successResponseHandler(200, 'Admin list fetch successfully!', $data);
        } catch (\Throwable $th) {
            return $this->errorResponseHandler(400, $th);
        }
    }

    public function getAllAdminInfo($id)
    {
        try {
            $data = User::where('id', '=', $id)->first();
            return $this->successResponseHandler(200, 'Admin info fetch successfully!', $data);
        } catch (\Throwable $th) {
            return $this->errorResponseHandler(400, $th);
        }
    }

    public function deleteAdminInfo($id)
    {
        try {
            $data = User::where('id', '=', $id)->delete();

            return $this->successResponseHandler(200, 'Admin information deleted successfully!', null);
        } catch (\Throwable $th) {
            return $this->errorResponseHandler(400, $th);
        }
    }

    public function adminRegister(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return $this->errorResponseHandler(400, $validator->errors());
            }

            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->house_rent = $request->house_rent;
            $data->advance_rent_amount = $request->advance_rent_amount;
            $data->nid_passport_driving_license = $request->nid_passport_driving_license;
            $data->full_address = $request->full_address;
            $data->house_no = $request->house_no;
            $data->flat_no = $request->flat_no;
            $data->road_no = $request->road_no;
            $data->city = $request->city;
            $data->house_rent_form = $request->house_rent_form;
            $data->hosue_renting_date = $request->hosue_renting_date;
            $data->rent_amount = $request->rent_amount;
            $data->role = 'admin';
            $data->password = Hash::make($request->password);

            if ($data->save()) {
                return $this->successResponseHandler(201, 'Admin register successfully!', $data);
            } else {
                return $this->errorResponseHandler(400, "Admin register failed");
            }
        } catch (\Throwable $th) {
            return $this->errorResponseHandler(400, $th);
        }
    }

    public function updateAdminInfo(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return $this->errorResponseHandler(400, $validator->errors());
            }

            $data = User::findOrFail($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->house_rent = $request->house_rent;
            $data->advance_rent_amount = $request->advance_rent_amount;
            $data->nid_passport_driving_license = $request->nid_passport_driving_license;
            $data->full_address = $request->full_address;
            $data->house_no = $request->house_no;
            $data->flat_no = $request->flat_no;
            $data->road_no = $request->road_no;
            $data->city = $request->city;
            $data->house_rent_form = $request->house_rent_form;
            $data->hosue_renting_date = $request->hosue_renting_date;
            $data->rent_amount = $request->rent_amount;
            $data->role = 'admin';
            $data->password = Hash::make($request->password);

            if ($data->save()) {
                return $this->successResponseHandler(201, 'Admin information updated successfully!', $data);
            } else {
                return $this->errorResponseHandler(400, "Admin register failed");
            }
        } catch (\Throwable $th) {
            return $this->errorResponseHandler(400, $th);
        }
    }

    public function successResponseHandler($statusCode, $message, $data)
    {
        return response()->json([
            'success' => true,
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function errorResponseHandler($statusCode, $errors)
    {
        return response()->json([
            'success' => false,
            'statusCode' => $statusCode,
            'message' => 'Something error found! please try again.',
            'errors' => $errors
        ]);
    }
}
