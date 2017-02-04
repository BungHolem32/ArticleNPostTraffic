<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/02/17
 * Time: 13:18
 */

namespace App\Repository;

use App\Http\Entities\Author;
use Doctrine\ORM\EntityManager as Em;


class AuthorRepository
{
    const APP_HTTP_ENTITY_ARTICLE = 'App\Http\Entities\Author';
    private $em;

    /**
     * AuthorRepository constructor.
     * @param Em $em
     */
    public function __construct(Em $em)
    {
        $this->em = $em;
    }

    /**
     * @param Author $author
     * @internal param Author $author
     */
    public function create(Author $author)
    {
        $this->em->persist($author);
        $this->em->flush();
    }

    /**
     * @param Author $author
     * @param $data
     * @return string
     */
    public function update(Author $author, $data)
    {
        $author->setName($data['name']);
        $author->setArticle($data['article']);
        try {
            $this->em->persist($author);
            $this->em->flush();
            return 'updated';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Author $author
     */
    public function delete(Author $author)
    {
        $this->em->remove($author);
        $this->em->flush();
    }

    /**
     * @param $id
     * @return null|Author|object
     */
    public function AuthorWithId($id)
    {
        return $this->em->getRepository(self::APP_HTTP_ENTITY_Author)->findOneBy([
            'id' => $id
        ]);
    }

    public function getAllAuthors()
    {
        $query = $this->em
            ->getRepository(self::APP_HTTP_ENTITY_Author)
            ->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->getQuery();

        return $this->paginate($query, 3, 'Author');
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
     * @return Author
     */
    public function prepareData($data)
    {
        $author = new Author();

        return $author;
    }


    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }


}