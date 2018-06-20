<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Advert;
use AppBundle\Entity\Application;
use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use AppBundle\Form\AdvertType;
use AppBundle\Form\ApplicationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdvertController extends Controller
{


  private $advert_service;

  public function setContainer(ContainerInterface $container = null)
  {
    parent::setContainer($container);
    $this->advert_service = $container->get('app.advertService');
    $this->category_service = $container->get('app.categoryService');
  }


  /**
  * @Route("/listadvert", name="advert")
  * @Security("has_role('ROLE_USER')")
  */
  public function listAction(){
    $adverts = $this->advert_service->getAlladvert();

    return $this->render("advert/listadvert.html.twig", array(
      "adverts" => $adverts,
    ));
  }


  /**
  * @Route("/listadvert/{id}", name="oneadvert")
  */
  public function showAction(Request $request, $id) {
    $oneAdvert = $this->advert_service->getById($id);
    //$catassocie = $this->category_service->getAdvertsByCategory($oneAdvert);

    //Debut du formulaire de réponse a une annonce.
    $application = new Application();
    $form = $this->get('form.factory')->create(ApplicationType::class, $application);
    $monuser= $this->getUser();
    if ($request->isMethod('POST') ){
      $form->handleRequest($request);
      if ($form->isValid()){
        $application->setApplicationAdvert($oneAdvert);
        $application->setApplicationUser($monuser);
        $em = $this->getDoctrine()->getManager();
        $em->persist($application);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Reponse bien enregistrée.');
        // On redirige vers la page d'accueil (le homepage a verifier? / ?)
        return $this->redirectToRoute('advert');
      }
    }
    return $this->render('advert/oneadvert.html.twig', array(
      "advert"=>$oneAdvert,
      'form'=>$form->createView(),
      //"catasso"=>$catassocie,

    ));
  }



  /**
  * @Route("/listadvert/del/{id}", name="deleteAdvert")
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function deleteAction($id = 0){

    $this->advert_service->delete($id);
    $this->addFlash("notice", "Advert Deleted");

    return $this->redirectToRoute("advert");
  }



  /**
  * @Route("/addform", name="addform")
  */
  public function addAction(Request $request)
  {
    //Creation d'un objet Advert
    $advert = new Advert();

    // creation du formulaire a l'aide du AdvertType
    $form = $this->get('form.factory')->create(AdvertType::class, $advert);

    //Si la requete est en post (donc si le formulaire a été valider)
    if ($request->isMethod('POST') ){

      // on fait le lien entre la requete et le formulaire, $advert contient les données rentrés par le gars
      $form->handleRequest($request);

      // si le formulaire est valide
      if ($form->isValid()){
        // lier le user qui utilise cette annonce.
        $userencours = $this->getUser();
        $advert->setAdvertUser($userencours);
        //on enregistre dans la BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // On redirige vers la page d'accueil (le homepage a verifier? / ?)
        return $this->redirectToRoute('advert');
      }
    }
    // sinon, on affiche le formulaire. (en gros c'est la parti controlleur de base)
    return $this->render('advert/advert.html.twig',array(
      'form'=>$form->createView(),
    ));
  }
  //  }


}
