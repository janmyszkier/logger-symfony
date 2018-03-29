<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Log;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;

class UserBehaviourListener
{

    public function __construct($doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        //die(__METHOD__);
        // You get the exception object from the received event
        $request = $event->getRequest();

        /* @var \Symfony\Component\HttpFoundation\FileBag $fileBag */
        $fileBag = $request->files;

        $em = $this->em;

        $log = new Log();
        $log->setSessionId(session_id());
        $log->setRequestMethod($request->getMethod());
        $log->setIpAddress($request->getClientIp());

        $log->setRequestUri($request->getRequestUri());

        parse_str($request->getQueryString(),$getParams);
        $log->setGetParams(json_encode($getParams));
        $log->setPostParams(json_encode($request->request->all()));

        if($referer = $request->headers->get('referer')) {
            $log->setHttpReferer($referer);
        }

        if(!empty($fileBag->keys())){
            /* @TODO: this now only supports our known form, needs refactor to support all */
            $tmpFiles = [];
            foreach ($fileBag->keys() as $key){
                $tmpFiles[$key] = (array)$fileBag->get($key);
            }
            if(!empty($tmpFiles)) {
                $log->setSentFiles(json_encode($tmpFiles));
            }
        }

        $em->persist($log);
        $em->flush();

        //$event->setResponse($event->getResponse());
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}