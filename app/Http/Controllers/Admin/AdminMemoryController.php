<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PhoneMemory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminMemoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.sku.memory.show')->withMemorys(PhoneMemory::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sku.memory.create');
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
            $memory = new PhoneMemory();
            $memory->name = $name;
            if ($memory->save()) {
                return redirect('admin/sku/memory/show');
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
            return view('admin/sku/memory/modify')->withMemory(PhoneMemory::find($id));
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
            $memory = PhoneMemory::find($id);
            if ($memory) {
                $memory->name = $name;
                if ($memory->save()) {
                    return redirect('admin/sku/memory/show');
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
            $memory = PhoneMemory::find($id);
            $memory->delete();
        }
        return redirect()->back();
    }

}
