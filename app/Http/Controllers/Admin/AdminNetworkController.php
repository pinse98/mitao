<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PhoneNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminNetworkController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $networks = PhoneNetwork::paginate(10);
		return view('admin.sku.network.show')->withNetworks($networks);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.sku.network.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$name = Input::get('name');
        if ($name) {
            $network = new PhoneNetwork();
            $network->name = $name;
            if ($network->save()) {
                return redirect('admin/sku/network/show');
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
            return view('admin/sku/network/modify')->withNetwork(PhoneNetwork::find($id));
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
        $name = Input::get('name');
        if ($id and $name) {
            $network = PhoneNetwork::find($id);
            if ($network) {
                $network->name = $name;
                if ($network->save()) {
                    return redirect('admin/sku/network/show');
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
            $network = PhoneNetwork::find($id);
            $network->delete();
        }
        return redirect()->back();
	}

}
