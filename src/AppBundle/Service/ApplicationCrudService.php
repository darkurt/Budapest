<?php


namespace AppBundle\Service;


use AppBundle\Entity\Advert;
use AppBundle\Entity\Application;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

class ApplicationCrudService extends CrudService implements IApplicationCrudService
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
        return $this->em->getRepository(Application::class);
    }

    public function getAllApplication()
    {
        return $this->getRepo()->findAll();
    }


    

    public function saveApplication(Application $application)
    {
        $this->em->persist($application);
        $this->em->flush();
    }

    public function getAdverts()
    {
       return $this->em->getRepository(Advert::class)->findAll();
    }

    public function getUsers()
    {
        return $this->em->getRepository(User::class)->findAll();
    }


    public function getById($id)
    {
        $application = $this->getRepo()->find($id);
        if (!$application){
            throw new NotFoundHttpException("Application NOT FOUND");
            // controller: throw $this->createNotFoundException()
        }
        return $application;
    }

    public function delete($id)
    {
        $application = $this->getById($id);
        $this->em->remove($application);
        $this->em->flush();
    }


}
