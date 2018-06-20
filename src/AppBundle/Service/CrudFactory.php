<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CrudFactory
{
    /** @var EntityManager  */
    private $em;
    /** @var  FormFactory */
    private $formFactory;
    /** @var  Request */
    private $request;
    /**
     * CrudFactory constructor.
     * @param $em EntityManager
     * @param $form FormFactory
     * @param $requestStack RequestStack
     */
    public function __construct($em, $form, $requestStack)
    {
        $this->em=$em;
        $this->formFactory=$form;
        $this->request=$requestStack->getCurrentRequest();
        // Request::createFromGlobals()
    }

    /**
     * @return AdvertCrudService
     */
    public function getAdvertService(){
        return new AdvertCrudService($this->em, $this->formFactory, $this->request);
    }

    /**
     * @return ApplicationCrudService
     */
    public function getApplicationService(){
        return new ApplicationCrudService($this->em, $this->formFactory, $this->request);
    }

    /**
     * @return CategoryCrudService
     */
    public function getCategoryService(){
        return new CategoryCrudService($this->em, $this->formFactory, $this->request);
    }
}
