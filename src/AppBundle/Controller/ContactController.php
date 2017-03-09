<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request)
    {
        if ($request->getMethod() === 'POST') {

            $body = '<html><body>'.nl2br($request->request->get('cmessage'))."</body></html>";

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact from pygervais.com')
                ->setFrom($request->request->get('cemail'))
                ->setTo('charliebreval@gmail.com')
                ->setBody($body,'text/html')
            ;
            $mailStatus = $this->get('mailer')->send($message);

            if($mailStatus) {
                $this->addFlash(
                    'success',
                    'Your message has been sent, thank you !'
                );
            } else {
                $this->addFlash(
                    'error',
                    'Error : Your message has not been sent...'
                );
            }
        }

        return $this->render('AppBundle:Contact:contact.html.twig');
    }
}
