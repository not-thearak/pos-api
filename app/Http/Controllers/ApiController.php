<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    // updateQty Controller
    public function confirmSale(Request $request)
    {
        $name = $request->input("name");
        $price = $request->input("price");
        $currency = $request->input("currency");
        $order_qt = $request->input("order_qt");

        $data = DB::select('call spMobileSale(?,?,?,?)', [$name, $price, $currency, $order_qt]);

        return response()->json([
            'message' => 'Get hold products successful',
            'data' => $data
        ]);
    }
 // updateQty Controller
    public function updateQty(Request $request)
    {
        $hold_id = $request->input("hold_id");
        $status = $request->input("status");

        $data = DB::select('call spMobileUpdateQty(?,?)', [$hold_id, $status]);

        return response()->json([
            'message' => 'Get hold products successful',
            'data' => $data
        ]);
    }

    // GetHoldProducts Controller
    public function getHoldProducts(Request $request)
    {
        $data = DB::select('call spMobileGetHoldProduct()');

        return response()->json([
            'message' => 'Get hold products successful',
            'data' => $data
        ]);
    }

    // HoldInsert Controller
    public function holdInsert(Request $request)
    {
        $name = $request->input("name");
        $price = $request->input("price");
        $currency = $request->input("currency");

        $data = DB::select('call spMobileHoldInsert(?,?,?)', [$name, $price, $currency]);

        return response()->json([
            'message' => 'Hold insert successful',
            'data' => $data
        ]);
    }
    public function getCategory(Request $request)
    {
        $data = DB::select('call spMobileGetCategory()');

        return response()->json([
            'message' => 'Get Category successful',
            'data' => $data
        ]);
    }
    // Product
    public function getAllProducts(Request $request)
    {
        $category_id = $request->input("category_id");
        $data = DB::select('call spMobileGetProduct(?)', [$category_id]);

        return response()->json([
            'message' => 'Get products successful',
            'data' => $data
        ]);
    }

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
