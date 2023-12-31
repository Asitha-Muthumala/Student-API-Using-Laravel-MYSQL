<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function createStudent(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'course' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ], 400);
        } else {
            $student = StudentModel::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'student added successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'error' => 'something went wrong'
                ], 500);
            }
        }
    }

    function studentDetails(string $id)
    {

        $student = StudentModel::where('id', $id)->get();

        if (count($student) >= 1) {
            return response()->json([
                'status' => 200,
                'data' => $student,
            ], 200);
        } else {
            return response()->json([
                'status' => 200,
                'data' => 'Not Found Student',
            ], 200);
        }
    }

    function updateStudent(Request $request, string $id)
    {
        $student = StudentModel::where('id', $id)->get();

        if (count($student) >= 1) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:200',
                'course' => 'required|string|max:200',
                'email' => 'required|email|max:200',
                'phone' => 'required|digits:10',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ], 400);
            } else {
                
                $result = StudentModel::where('id', $id)->update([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                
                if ($result) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'student updated successfully',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 500,
                        'error' => 'something went wrong'
                    ], 500);
                }
            }
        } else {
            return response()->json([
                'status' => 200,
                'data' => 'Not Found Student According to Id',
            ], 200);
        }
    }

    function deleteStudent(string $id)
    {

        $student = StudentModel::where('id', $id)->get();

        if (count($student) == 0) {
            return response()->json([
                'status' => 200,
                'data' => 'Not Found Student According to Id',
            ], 200);
        }
        else {

            $result = StudentModel::destroy($id);

            if ($result) {
                return response()->json([
                    'status' => 200,
                    'message' => 'student deleted successfully',
                ], 200);
            }
            else {
                return response()->json([
                    'status' => 500,
                    'error' => 'something went wrong',
                ], 500);
            }

        }

    }
}
