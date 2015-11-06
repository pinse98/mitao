<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PhoneImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminImageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.sku.image.show')->withImages(PhoneImage::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sku.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $name = Input::get('name');
        $img = Input::get('image');
        if ($name and $img) {
            $image = new PhoneImage();
            $image->name = $name;
            $image->image = $img;
            if ($image->save()) {
                return redirect('admin/sku/image/show');
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
            return view('admin/sku/image/modify')->withImage(PhoneImage::find($id));
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
        $img = Input::get('image');
        if ($id and $name and $img) {
            $image = PhoneImage::find($id);
            if ($image) {
                $image->name = $name;
                $image->image = $img;
                if ($image->save()) {
                    return redirect('admin/sku/image/show');
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
            $image = PhoneImage::find($id);
            $image->delete();
        }
        return redirect()->back();
    }

}
