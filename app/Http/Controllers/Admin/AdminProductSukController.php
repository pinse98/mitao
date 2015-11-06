<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PhoneSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminProductSukController extends Controller {

    /**
     * 商品SKU视图
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
	public function index($id)
	{
        if ($id) {
            $sku = PhoneSku::where('product_id', '=', $id)->paginate(10);
            $sku->pid = $id;
            return view('admin.product.sku.show')->withSkus($sku);
        }
        return redirect()->back();
	}

    /**
     * 创建商品SKU
     *
     * @param $id
     * @return $this
     */
	public function create($id)
	{
		return view('admin.product.sku.create')->with(['id' => $id]);
	}

    /**
     * 添加商品SKU
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store($id)
	{
		if ($id) {
            $network = Input::get('network');
            $memory = Input::get('memory');
            $color = Input::get('color');
            $storage = Input::get('storage');
            $img = Input::get('image', 0);
            $price = Input::get('price');
            if ($price) {
                $sku = new PhoneSku();
                $sku->network_id = $network;
                $sku->storage_id = $storage;
                $sku->color_id = $color;
                $sku->memory_id = $memory;
                $sku->image_id = $img;
                $sku->price = $price;
                $sku->product_id = $id;
                if ($sku->save()) {
                    return redirect("admin/product/sku/show/$id");
                }
            }
        }
        return redirect()->back();
	}

    /**
     * 编辑商品SKU
     *
     * @param $pid
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
	public function edit($pid, $id)
	{
		if ($pid and $id) {
            return view('admin.product.sku.modify')->withSku(PhoneSku::find($id));
        }
        return redirect()->back();
	}

    /**
     * 更新商品SKU
     *
     * @param $pid
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function update($pid, $id)
	{
		if ($pid and $id) {
            $sku = PhoneSku::find($id);
            if ($sku) {
                $network = Input::get('network', 0);
                $memory = Input::get('memory', 0);
                $color = Input::get('color', 0);
                $storage = Input::get('storage', 0);
                $img = Input::get('image', 0);
                $price = Input::get('price');
                if ($price) {
                    $sku->network_id = $network;
                    $sku->storage_id = $storage;
                    $sku->color_id = $color;
                    $sku->memory_id = $memory;
                    $sku->image_id = $img;
                    $sku->price = $price;
                    if ($sku->save()) {
                        return redirect("admin/product/sku/show/$pid");
                    }
                }
            }
        }
        return redirect()->back();
	}

    /**
     * 删除商品SKU
     *
     * @param $pid
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
	public function destroy($pid, $id)
	{
		if ($pid and $id) {
            $sku = PhoneSku::find($id);
            $sku->delete();
        }
        return redirect()->back();
	}

}
