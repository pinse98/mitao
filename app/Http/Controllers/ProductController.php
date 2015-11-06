<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PhoneProduct;
use App\Models\PhoneSku;
use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
     * 商品详情
     *
     * @param $id
     * @return \Illuminate\View\View
     */
	public function show($id)
	{
        if ($id) {
            $product = PhoneProduct::find($id);
            if ($product) {
                return view('home.product.show')->withProduct($product);
            }
        }
        return redirect()->back();
	}

    /**
     * 商品选择
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function lists($id)
    {
        if ($id) {
            $products = PhoneSku::where(['product_id' => $id])->get();
            if (count($products)) {
                return view('home.product.images')->withProducts($products);
            }
        }
        return redirect()->back();
    }

    public function images($id)
    {
        if ($id) {
            $product = PhoneProduct::find($id);
            if ($product) {
                return view('home.product.image')->withProduct($product);
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
        //
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
