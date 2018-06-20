<?php

namespace AppBundle\Service;

use AppBundle\Entity\Advert;
use Symfony\Component\Form\FormInterface;
interface IAdvertCrudService
{
    /**
     * @return Advert[]
     */
    public function getAllAdvert();

    /**
     * @param $brandId integer
     * @return Category[]
     */
    public function getCategoriesByAdvert($id);

    /**
     * @param Advert $Advert
     */
    public function saveAdvert(Advert $advert);

    /**
     * @param $id integer
     * @return Advert
     */
    public function getById($id);

    /**
     * @param $id integer
     * @return mixed
     */
    public function delete($id);

    public function getCategories();

}
