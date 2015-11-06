<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminAdvert;
use App\Models\PhoneShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminShowController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('admin.show.index')->withShows(PhoneShow::orderBy('level', 'ASC')->paginate(10));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.show.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$product = Input::get('product', 0);
        $level = Input::get('level', 0);
        $details = Input::get('details', null);
        $detailsClass = Input::get('tabColor', 0);
        $image = Input::get('image', null);
        if ($product and $level) {
            $isShow = PhoneShow::where(['level' => $level])->first();
            if (!$isShow) {
                $show = new PhoneShow();
                $show->product_id = $product;
                $show->details = $details;
                $show->details_class = $detailsClass;
                // if ($details and $detailsClass) {
                //     $show->details = $details;
                //     $show->details_class = $detailsClass;
                // }
                $show->level = $level;
                $show->image = $image;
                if ($show->save()) {
                    return redirect('admin/show/show');
                }
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
	public function edit($id = 0)
	{
		$show = PhoneShow::find($id);
        if ($show) {
            return view('admin.show.modify')->withShow($show);
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
        $show = PhoneShow::find($id);
        if ($show) {
            $product = Input::get('product', 0);
            $level = Input::get('level', 0);
            $details = Input::get('details', null);
            $image = Input::get('image', null);
            $detailsClass = Input::get('tabColor', 0);
            if ($product and $level) {
                $isShow = PhoneShow::whereRaw("level = ? and id <> ?", [$level, $show->id])->first();
                if (!$isShow) {
                    $show->product_id = $product;
                    $show->details = $details;
                    $show->details_class = $detailsClass;
                    // if ($details and $detailsClass) {
                    //     $show->details = $details;
                    //     $show->details_class = $detailsClass;
                    // }
                    $show->level = $level;
                    $show->image = $image;
                    if ($show->save()) {
                        return redirect('admin/show/show');
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
        $show = PhoneShow::find($id);
        if ($show) {
            $show->delete();
        }
        return redirect()->back();
	}

    public function advertShow()
    {
        return view('admin.advert.index')->withAdverts(AdminAdvert::orderBy('level', 'ASC')->paginate(10));
    }

    public function advertCreate()
    {
        return view('admin.advert.create');
    }

    public function advertStore()
    {
        $name = Input::get('name', null);
        $image = Input::get('image', null);
        $url = Input::get('url', null);
        $level = Input::get('level', 0);
        if ($name and $image and $url and $level) {
            $isok = AdminAdvert::where(['level' => $level])->first();
            if ($isok) {
                return redirect()->back();
            }
            $advert = new AdminAdvert();
            $advert->name = $name;
            $advert->image = $image;
            $advert->url = $url;
            $advert->level = $level;
            if ($advert->save()) {
                return redirect('admin/advert/show');
            }
        }
        return redirect()->back();
    }

    public function advertEdit($id)
    {
        if ($id) {
            return view('admin.advert.modify')->withAdvert(AdminAdvert::find($id));
        }
        return redirect()->back();
    }

    public function advertUpdate($id)
    {
        $name = Input::get('name', null);
        $image = Input::get('image', null);
        $url = Input::get('url', null);
        $level = Input::get('level', 0);
        if ($id) {
            $advert = AdminAdvert::find($id);
            if ($name and $image and $url and $level) {
                $isShow = AdminAdvert::whereRaw("level = ? and id <> ?", [$level, $advert->id])->first();
                if (!$isShow) {
                    $advert->name = $name;
                    $advert->image = $image;
                    $advert->url = $url;
                    $advert->level = $level;
                    if ($advert->save()) {
                        return redirect('admin/advert/show');
                    }
                }
            }
        }
        return redirect()->back();
    }

    public function advertDestroy($id)
    {
        if($id) {
            $advert = AdminAdvert::find($id);
            $advert->delete();
        }
        return redirect()->back();
    }

}
