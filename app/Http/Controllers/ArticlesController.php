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
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{

    private $repo;

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $articles = $this->repo->getAllArticles();
        return view('pages.articles')->with(["data" => $articles]);
    }


    public function create(Request $request)
    {
        $article = $request->all();
        /*validation*/

        if ($request->method() == 'POST') {
            $article = $this->repo->prepareData($article);
            if ((is_a($article, Article::class))) {
                $this->repo->create($article);
            }
        }

        return view('pages.articles-create')->with(["data" => ($this->repo->getAllArticles())]);
    }

    public function createFromAuthor(Request $request)
    {

    }


    public function editView($id = null)
    {
        return view('pages.articles-edit')->with(['article' => $this->repo->articleWithId($id)]);
    }


    public function editArticle(Request $request)
    {
        $articles = $request->request->all();
        $this->validate($request, [
            "title" => 'required|max:255',
            "body" => "required",
            "review" => "",
            "rate" => "numeric"
        ]);
        $article = $this->repo->articleWithId($articles['id']);
        $status = $this->repo->update($article, $articles);

        if ($status == 'updated') {
            $request->session()->flash('feedback', 'article ' . $article->getTitle() . ' updated');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['err' => $status]);
        }
    }

    public function retrieve()
    {
        return view('admin.index')->with(['data' => $this->repo->retrieve()]);
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