<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PhoneStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminStorageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.sku.storage.show')->withStorages(PhoneStorage::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sku.storage.create');
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
            $storage = new PhoneStorage();
            $storage->name = $name;
            if ($storage->save()) {
                return redirect('admin/sku/storage/show');
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
            return view('admin/sku/storage/modify')->withStorage(PhoneStorage::find($id));
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
            $storage = PhoneStorage::find($id);
            if ($storage) {
                $storage->name = $name;
                if ($storage->save()) {
                    return redirect('admin/sku/storage/show');
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
            $storage = PhoneStorage::find($id);
            $storage->delete();
        }
        return redirect()->back();
    }

}
