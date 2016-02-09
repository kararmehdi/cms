<?php

namespace Custom\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Custom\CMSBundle\Form\EnquiryType;
use Custom\CMSBundle\Entity\Enquiry;
use Symfony\Component\HttpFoundation\Request;



class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CustomCMSBundle:Default:index.html.twig');
    }
     
     public function redirectionAction()
    {
        return $this->render('CustomCMSBundle:Default:contact.html.twig');
    }
    
    public function sendMailAction()
    {
         $Request = $this->getRequest();
            if($Request->getMethod()== "POST"){
                $Subject = $Request->get("subject");
                $email = $Request->get("email");
                $message = $Request->get("message");
                
                $mailer =$this->container->get('mailer');
                $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                        ->setUsername('kararmehdi@gmail.com')
                        ->setPassword('STANDONS43218811');
                $mailer = \Swift_Mailer::newInstance($transport);
                $message = \Swift_Message::newInstance('Test')
                        ->setSubject($Subject)
                        ->setFrom('kararmehdih@gmail.com')
                        ->setTo($email)
                        ->setBody($message);
                $this->get('mailer')->send($message);
            }
            return $this->render('CustomCMSBundle:Default:contact.html.twig');
    }
    
    
      
}
