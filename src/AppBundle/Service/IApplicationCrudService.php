<?php

namespace AppBundle\Service;

use AppBundle\Entity\Application;
use Symfony\Component\Form\FormInterface;
interface IApplicationCrudService
{
    /**
     * @return Application[]
     */
    public function getAllApplication();

    /**
     * @param Application $Application
     */
    public function saveApplication(Application $application);

    /**
     * @param $id integer
     * @return Application
     */
    public function getById($id);

    /**
     * @param $id integer
     * @return mixed
     */
    public function delete($id);

    public function getAdverts();

    public function getUsers();
}
