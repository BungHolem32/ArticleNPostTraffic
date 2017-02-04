<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/02/17
 * Time: 00:12
 */

namespace App\Repository;

use App\Http\Entities\Article;
use App\Http\Entities\Author;
use App\Repository\AuthorRepository as AR;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\EntityManager as EntityManager;
use LaravelDoctrine\ORM\Pagination\Paginatable;


/**
 * Class ArticlesRepository
 * @package App\Repository
 */
class ArticlesRepository
{
    use Paginatable;


    const APP_HTTP_ENTITY_ARTICLE = 'App\Http\Entities\Article';
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * ArticlesRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;

    }


    /**
     * @param Article $article
     */
    public function create(Article $article)
    {
        $this->em->persist($article);
        $this->em->flush();
    }


    /**
     * @param Article $article
     * @param $data
     * @return string
     */
    public function update(Article $article, $data)
    {
        $article->setTitle($data['title']);
        $article->setBody($data['body']);
        $article->setRate($data['rate']);
        $article->setReview($data['review']);
        try {
            $this->em->persist($article);
            $this->em->flush();
            return 'updated';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Article $article
     */
    public function delete(Article $article)
    {
        $this->em->remove($article);
        $this->em->flush();
    }

    /**
     * @param $id
     * @return null|Article|object
     */
    public function articleWithId($id)
    {
        return $this->em->getRepository(self::APP_HTTP_ENTITY_ARTICLE)->findOneBy([
            'id' => $id
        ]);
    }

    public function getAllArticles()
    {
        $query = $this->em
            ->getRepository(self::APP_HTTP_ENTITY_ARTICLE)
            ->createQueryBuilder('articles')
            ->orderBy('articles.id', 'ASC')
            ->getQuery();

        return $this->paginate($query, 3, 'Articles');
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

    /**
     * @param $data
     * @return Article
     * @internal param AuthorRepository $authorRepository
     */
    public function prepareData($data)
    {
        $article = new Article();
        $article->setTitle($data['title']);
        $article->setBody($data['body']);
        $article->setReview($data['review']);
        $author = new Author();
        $author->setName($data['name']);
        $article->setAuthor($author);
        return $article;
    }
}