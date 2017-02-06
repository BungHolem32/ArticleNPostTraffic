<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/02/17
 * Time: 00:23
 */

namespace App\Http\Controllers;

use App\Http\Entities\Article;
use App\Repository\ArticlesRepository as Repository;
use Illuminate\Http\Request;


/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{

    /**
     * @var Repository
     */
    private $repo;


    /**
     * ArticlesController constructor.
     * @param Repository $repo
     */
    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $setting = $request->all();
        $articles = $this->repo->getAllArticles($setting);
        return view('pages.articles')->with(["data" => $articles]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $article = $request->all();
        /*validation*/

        if ($request->method() == 'POST') {
            $this->validate($request, [
                "title" => 'required|max:255',
                "body" => "required",
                "review" => "",
                "rate" => "numeric"
            ]);
            $article = $this->repo->prepareData($article);
            if ((is_a($article, Article::class))) {
                $this->repo->create($article);
                $request->session()->flash('feedback', 'new article added');
                return redirect()->route('articles.index')->with(["data" => $this->repo->getAllArticles()]);
            }
        }
        return view('pages.articles-create');
    }

    public function createFromAuthor()
    {
        /**todo  add new article from specific author
         */
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id=null)
    {

        if ($request->get('_method') == 'PUT') {

            $data = $request->request->all();

            $this->validate($request, [
                "title" => 'required|max:255',
                "body" => "required",
                "review" => "",
                "rate" => "numeric"
            ]);
            $article = $this->repo->articleWithId($data['id']);
            $status = $this->repo->update($article, $data);

            if ($status == 'updated') {
                $request->session()->flash('feedback', 'article ' . $article->getTitle() . ' updated');
                return redirect()->back();
            } else {
                return redirect()->back()->withErrors(['err' => $status]);
            }
        }

        return view('pages.articles-edit')->with(['article' => $this->repo->articleWithId($id)]);


    }


    /**
     * @param $articleId
     * @param Request $request
     * @return ArticlesController|\Illuminate\Http\RedirectResponse
     */
    public function deleteArticle($articleId, Request $request)
    {
        $id = $articleId;
        $data = $this->repo->articleWithId($id);

        if (!is_null($data)) {
            $this->repo->delete($data);
            $request->session()->flash('feedback', 'operation Success');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['err' => 'operationFailed']);
        }
    }

}