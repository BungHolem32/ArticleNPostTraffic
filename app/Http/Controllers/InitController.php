<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/02/17
 * Time: 19:46
 */

namespace App\Http\Controllers;

use App\Http\Models\InitModel;
use App\Http\Service\Curl;


/**
 * @property InitModel model
 */
class InitController extends Controller
{
    /**
     * @var Curl
     */
    private $curl;

    /**
     * InitController constructor.
     * @param Curl $curl
     * @param InitModel $model
     */
    public function __construct(Curl $curl, InitModel $model)
    {
        $this->curl = $curl;
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        /*check if there already data in the database */
        $data = $this->model->getAllDataPaginated();

        if (count($data) <= 0) {
            $this->model->storeIntoDataBase($this->PullDataFromApi());
            $data = $this->model->getAllDataPaginated();
        }

        return redirect()->action('ArticlesController@index',[
            'articles'=>$data
        ]);
    }


    /**
     * @param null $url
     * @return mixed
     */
    public function PullDataFromApi($url = null)
    {
        if (is_null($url)) {
            $url = env('APP_JSON_PLACEHOLDER_URL');
        }

        return $this->curl->PullDataFromApi($url);
    }
}