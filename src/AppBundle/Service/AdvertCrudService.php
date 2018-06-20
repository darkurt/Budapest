<?php


namespace AppBundle\Service;


use AppBundle\Entity\Category;
use AppBundle\Entity\Advert;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class AdvertCrudService extends CrudService implements IAdvertCrudService
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
        return $this->em->getRepository(Advert::class);
    }

    public function getAllAdvert()
    {
        return $this->getRepo()->findAll();
    }

    /**
     * @inheritDoc
     */
    public function getCategoriesByAdvert($id)
    {
        return $this->getRepo()->findBy(["adverts_categories"=>$id]);
    }

    public function saveAdvert(Advert $advert)
    {
        $this->em->persist($advert);
        $this->em->flush();
    }

    public function getCategories()
    {
       return $this->em->getRepository(Category::class)->findAll();
    }



    public function getById($id)
    {
        $advert = $this->getRepo()->find($id);
        if (!$advert){
            throw new NotFoundHttpException("Advert NOT FOUND");
            // controller: throw $this->createNotFoundException()
        }
        return $advert;
    }

    public function delete($id)
    {
        $advert = $this->getById($id);
        $this->em->remove($advert);
        $this->em->flush();
    }


}
