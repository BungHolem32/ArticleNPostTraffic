<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/02/17
 * Time: 23:50
 */

namespace App\Http\Models;

use App\Http\Entities\Article;
use App\Http\Entities\Author;
use App\Http\Service\Helpers;
use Doctrine\ORM\EntityManagerInterface as DB;
use LaravelDoctrine\ORM\Pagination\Paginatable;


class InitModel
{
    use Paginatable;

    /**
     * @var DB
     */
    protected $db;
    /**
     * @var Helpers
     */
    protected $helps;

    /**
     * InitModel constructor.
     * @param DB $db
     * @param Helpers $helpers
     * @internal param Paginatable $paginatable
     */
    public function __construct(DB $db, Helpers $helpers)
    {
        $this->db = $db;
        $this->helps = $helpers;
    }

    /**
     * @param $posts
     * @return bool
     */
    public function storeIntoDataBase($posts)
    {
        $key = [];
        $author = null;
        $article = null;

        foreach ($posts as $k => $val) {
            if (count($key) > 0 && end($key) != $val->userId) {
                /** @var Author $author */
                $this->db->persist($author);
                $this->db->flush();
                $this->db->clear();
            }

            if (!in_array($val->userId, $key)) {
                array_push($key, $val->userId);
                $author = new Author();
                $author->setName($this->helps->random_string(6));
            }

            $article = new Article();
            $article->setTitle($val->title);
            $article->setBody($val->body);
            $author->setArticle($article);
        }

        //Persist objects that did not make up an entire batch
        $this->db->persist($author);
        $this->db->flush();
        $this->db->clear();

        return true;
    }


    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllDataPaginated()
    {
        $query = $this->db->createQueryBuilder()
            ->select('f')
            ->from(Article::class, 'f')
            ->getQuery();

        return $this->paginate($query, 10, 'Article');

    }

    /**
     * Creates a new QueryBuilder instance that is prepopulated for this entity name.
     *
     * @param string $alias
     * @param string $indexBy The index for the from.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        // TODO: Implement createQueryBuilder() method.
    }
}