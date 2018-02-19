<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request)
    {
        if ($request->getMethod() === 'POST' && $this->captchaverify($request->get('g-recaptcha-response'))) {
            $body = '<html><body>'.nl2br($request->request->get('cmessage'))."</body></html>";

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact from pygervais.com')
                ->setFrom($request->request->get('cemail'))
                ->setTo('pierreyvesgervais@hotmail.com')
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

    function captchaverify($recaptcha){
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                "secret"=>"6LfpWUcUAAAAACSzbgbPB1RGZc_vsIwPgWPnis6o","response"=>$recaptcha));
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response);

        return $data->success;
    }
}
