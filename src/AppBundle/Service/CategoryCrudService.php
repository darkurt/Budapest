<?php


namespace AppBundle\Service;


use AppBundle\Entity\Category;
use AppBundle\Entity\Advert;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CategoryCrudService extends CrudService implements ICategoryCrudService
{
    /**
     * CarCrudService constructor.
     * @param $em EntityManager
     * @param $form FormFactory
     * @param $request Request
     */
    public function __construct($em, $form, $request)
    {
        parent::__construct($em, $form, $request);
    }
    public function getRepo()
    {
        return $this->em->getRepository(Category::class);
    }

    public function getAllCategory()
    {
        return $this->getRepo()->findAll();
    }

    /**
     * @inheritDoc
     */
    public function getAdvertsByCategory($id)
    {
        return $this->getRepo()->findBy(["adverts"=>$id]);
    }

    public function saveCategory(Category $category)
    {
        $this->em->persist($category);
        $this->em->flush();
    }

    public function getCategories()
    {
       return $this->em->getRepository(Category::class)->findAll();
    }



    public function getById($id)
    {
        $category = $this->getRepo()->find($id);
        if (!$category){
            throw new NotFoundHttpException("Category NOT FOUND");
            // controller: throw $this->createNotFoundException()
        }
        return $category;
    }

    public function delete($id)
    {
        $category = $this->getById($id);
        $this->em->remove($category);
        $this->em->flush();
    }


}
