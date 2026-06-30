<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getUserInfo(Request $request)
    {
        $user_id = $request->input('user_id');

        if (!$user_id) {
            return response()->json([
                'message' => 'user_id is required',
                'data' => []
            ], 400);
        }

        try {
            $data = DB::select('call spMobileGetUserId(?)', [$user_id]);

            return response()->json([
                'message' => 'get user info successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed to get user info',
                'data' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getModule(Request $request)
    {
        $role = $request->input('role');

        if (!$role) {
            return response()->json([
                'message' => 'role is required',
                'data' => []
            ], 400);
        }

        try {
            $modules = DB::select('call spMobileGetModule(?)', [$role]);

            return response()->json([
                'message' => 'get modules successfully',
                'data' => $modules
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed to get modules',
                'data' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function test()
    {
        $test = DB::select('select * from users where id = 1');

        return response()->json([
            'message' => 'test api successfully',
            'data' => $test
        ], 201);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!$email || !$password) {
            return response()->json([
                'data' => [],
                'message' => 'email and password are required'
            ], 400);
        }

        try {
            $data = DB::select('call spMobileLogin(?,?)', [$email, $password]);

            return response()->json([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => 'login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
