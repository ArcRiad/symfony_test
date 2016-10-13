<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{

  /**
  *
  *@Route("/add")
  *
  *@return \Symfony\Component\HttpFoundation\Response
  */
  public function add_contact(Request $request)
  {
    $contact = new Contact();

    $form = $this->createForm(ContactType::class, $contact);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
      $em = $this->getDoctrine()->getManager();

      $em->persist($contact);
      $em->flush();

      return new Response('Done');
    }

    $formView = $form->createView();

    return $this->render('Contact.html.twig', array('form'=>$formView));
  }

  /**
  *
  *@Route("/list")
  *
  *@return \Symfony\Component\HttpFoundation\Response
  */

  public function contact_list(){
      $repo = $this->getDoctrine()->getRepository('AppBundle:Contact');

      $contact = $repo->findall();
      return $this->render('list.html.twig', array('contact'=>$contact));
  }

  /**
  *@return Response
  *
  *@Route("/edit/{id}", name="contact_edit")
  *
  */

  public function edit(Request $request, contact $contact){
    $form = $this->createForm(ContactType::class, $contact);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
      $em = $this->getDoctrine()->getManager();

      $em->flush();

      return new Response('Modiffication Done');
    }

    $formView = $form->createView();

    return $this->render('Contact.html.twig', array('form'=>$formView));
  }

  /**
  *@return Response
  *
  *@Route("/delete/{id}", name="contact_delete")
  *
  */

  public function delete(contact $contact){

    $em = $this->getDoctrine()->getManager();

    $em->remove($contact);

    $em->flush();

    return new Response ('Contact deleted');
  }
}
