<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Log;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class UserBehaviourListener
{

    public function __construct($doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
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
            $tmpFiles = [];
            foreach ($fileBag->keys() as $key){
                $tmpFiles[$key] = (array)$fileBag->get($key);
            }
            if(!empty($tmpFiles)) {
                $log->setSentFiles(json_encode($tmpFiles));
            }
        }

        $log->setCreatedAt(new \DateTime());

        $em->persist($log);
        $em->flush();

    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}