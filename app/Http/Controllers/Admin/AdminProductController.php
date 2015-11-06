<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PhoneProduct;
use App\Models\PhoneSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.product.show')->withProducts(PhoneProduct::paginate(10));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.product.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$name = Input::get('name', null);
        $price = Input::get('price', null);
        $image = Input::get('show', null);
        $content = Input::get('content', null);
        if ($name and $price and $image) {
            $product = new PhoneProduct();
            $product->name = $name;
            $product->show_price = $price;
            $product->show_image = $image;
            $product->detail = $content ? trim(str_replace("\n", '||', $content)) : null;
            if ($product->save()) {
                return redirect('admin/product/show');
            }
        }
        return redirect()->back();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if ($id) {
            return view('admin.product.modify')->withProduct(PhoneProduct::find($id));
        }
        return redirect()->back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ($id) {
            $product = PhoneProduct::find($id);
            if ($product) {
                $name = Input::get('name', null);
                $price = Input::get('price', null);
                $image = Input::get('show', null);
                $content = Input::get('content', null);
                if ($name and $price and $image) {
                    $product->name = $name;
                    $product->show_price = $price;
                    $product->show_image = $image;
                    $product->detail = $content ? trim(str_replace("\n", '||', $content)) : null;
                    if ($product->save()) {
                        return redirect('admin/product/show');
                    }
                }
            }
        }
        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($id) {
            $skus = PhoneSku::where('product_id', '=', $id)->get();
            if ($skus) {
                foreach ($skus as $sku) {
                    $sku->delete();
                }
            }
            $product = PhoneProduct::find($id);
            $product->delete();
        }
        return redirect()->back();
	}

}
