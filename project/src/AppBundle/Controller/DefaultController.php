<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

  /**
  *
  *@Route("/add")
  *
  *@return \Symfony\Component\HttpFoundation\Response
  */
  public function add_contact()
  {
    $contact = new contact();

    $form = $this->creatForm(contactType::class, $contact);

    $formView = $form->creatView();

    return $this->render('Contact.html.twig', array('form'=>$formView));
  }
}
