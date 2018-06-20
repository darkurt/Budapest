<?php

namespace AppBundle\Service;

use AppBundle\Entity\Category;
use Symfony\Component\Form\FormInterface;
interface ICategoryCrudService
{
    /**
     * @return Category[]
     */
    public function getAllCategory();

    /**
     * @param $brandId integer
     * @return Advert[]
     */
    public function getAdvertsByCategory($id);

    /**
     * @param Category $Category
     */
    public function saveCategory(Category $category);

    /**
     * @param $id integer
     * @return Category
     */
    public function getById($id);

    /**
     * @param $id integer
     * @return mixed
     */
    public function delete($id);

    public function getCategories();

}
