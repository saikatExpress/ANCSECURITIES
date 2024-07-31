<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function create()
    {
        $data['pageTitle'] = 'Create Porduct';
        $data['employees'] = Staff::all();

        return view('admin.account.product.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'product_type'  => 'required',
                'product_model' => 'required',
                'quantity'      => 'required|integer',
            ]);

            $product = new Product();

            $product->name             = $request->input('name');
            $product->product_head     = $request->input('product_head');
            $product->product_type     = $request->input('product_type');
            $product->product_model    = $request->input('product_model');
            $product->product_quantity = $request->input('quantity');
            $product->added_by         = Auth::id();
            $res                       = $product->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Product added successfully.');
            }
        } catch (\Throwable $e) {
            DB::rollback();
            info($e);
        }
    }
}
