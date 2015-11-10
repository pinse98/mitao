<?php namespace App\Http\Controllers;

use App\Models\AdminAdvert;
use App\Models\PhoneShow;
use App\Models\PhoneUser;
use App\Services\Alipay\AlipayCore;
use App\Services\Alipay\AlipayRsa;
use App\Services\VerifyCode;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

    public $dataAll = [];

    public $item = [];

    public $generator;

	public function __construct(UrlGenerator $generator)
	{
		$this->middleware('guest');
        $this->generator = $generator;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $renders = [];
        $renders['adverts'] = AdminAdvert::orderBy('level', 'ASC')->get();
        $dataAll = PhoneShow::orderBy('level', 'ASC')->get();
        $total = count($dataAll);
        $i = 0;
        foreach($dataAll as $data) {
            $i++;
            if ($i == $total) {
                array_push($this->item, $data);
                array_push($this->dataAll, $this->item);
            } else {
                if (count($this->item)) {
                    array_push($this->item, $data);
                    array_push($this->dataAll, $this->item);
                    $this->item = [];
                } else {
                    array_push($this->item, $data);
                }
            }
        }
        $renders['products'] = $this->dataAll;
		return view('home.index.show')->withDatas($renders);
	}

    public function test()
    {
        $a = $_POST;
        var_dump($a);
        $b = $_GET;
        var_dump($b);
    }

}
