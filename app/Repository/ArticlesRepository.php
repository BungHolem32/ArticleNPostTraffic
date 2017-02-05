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
use Doctrine\ORM\EntityManager as EntityManager;

//use LaravelDoctrine\ORM\Pagination\Paginatable;


/**
 * Class ArticlesRepository
 * @package App\Repository
 */
class ArticlesRepository
{
//    use Paginatable;


    const APP_HTTP_ENTITY_ARTICLE = 'App\Http\Entities\Article';
    /**
     * @var EntityManager
     */
    private $em;


    /**
     * ArticlesRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Create new article
     *
     * @param Article $article
     */
    public function create(Article $article)
    {
        $this->em->persist($article);
        $this->em->flush();
    }


    /**
     * Update the article values
     *
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
     * Delete article from the database
     *
     * @param Article $article
     */
    public function delete(Article $article)
    {
        $this->em->remove($article);
        $this->em->flush();
    }

    /**
     * Search article with specif id and return it to the edit page
     *
     * @param $id
     * @return null|Article|object
     */
    public function articleWithId($id)
    {
        return $this->em->getRepository(self::APP_HTTP_ENTITY_ARTICLE)->findOneBy([
            'id' => $id
        ]);
    }

    /**
     * Get all Articles from the database (it get all of them from repository to increase performance
     *
     * @param $setting
     * @return array
     */
    public function getAllArticles($setting = [])
    {

        $start = !empty($setting['s']) ? $setting['s'] : 1;

        $query = $this->em
            ->getRepository(self::APP_HTTP_ENTITY_ARTICLE)
            ->createQueryBuilder('articles')
            ->orderBy('articles.id', 'ASC')
            ->setFirstResult($start)
            ->setMaxResults(3)
            ->getQuery();

        return $query->getResult();


        /**todo
         * need to fix the pagination stuff
         * 1.this is the pagination from doctrine (it only limit the results)
         */
//      return $this->paginate($query,'page');
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
     *
     * Prepare the data to persist after create new Article
     *
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

        /*need to use this two lines in the author repository */
        $author = new Author();
        $author->setName($data['name']);
        $article->setAuthor($author);
        return $article;
    }
}