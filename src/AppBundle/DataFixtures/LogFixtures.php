<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\Log;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LogFixtures extends Fixture
{
    public function load(ObjectManager $objectManager){

        //log with GET
        $log = new Log();
        $log->setRequestUri('contact.html');
        $log->setRequestMethod('GET');
        $log->setGetParams(json_encode(['test'=>1,'param2'=>'somestring']));
        $log->setIpAddress('127.0.0.1');
        $log->setHttpReferer('index.html');
        $log->setSessionId(session_id());
        $log->setCreatedAt(new \DateTime());
        $objectManager->persist($log);

        //log with POST
        $log = new Log();
        $log->setHttpReferer('simple-form.php');
        $log->setRequestMethod('POST');
        $log->setPostParams(json_encode(['postparam1'=>1,'parampost2'=>'somestring']));
        $log->setIpAddress('0:0:0:0:0:ffff:7f00:1');
        $log->setHttpReferer('index.html');
        $log->setSessionId(session_id());
        $log->setCreatedAt(new \DateTime());
        $objectManager->persist($log);

        //log with PUT
        $log = new Log();
        $log->setRequestMethod('PUT');
        $log->setIpAddress('999.999.999.999');
        $log->setSessionId(session_id());
        $log->setCreatedAt(new \DateTime());
        $objectManager->persist($log);

        //log with FILES (one of them)
        $log = new Log();
        $log->setRequestMethod('POST');
        $log->setPostParams(json_encode(['postparam1'=>1,'parampost2'=>'somestring']));
        $log->setSessionId(session_id());
        $log->setHttpReferer('upload-form.php');
        $log->setSentFiles(json_encode([
            'myfile' => [
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => '1024',
                'tmp_name' => '/tmp/php7zU3t5',
                'error' => UPLOAD_ERR_OK,
            ]
        ]));
        $log->setIpAddress('0:0:0:0:0:ffff:7f00:1');
        $log->setCreatedAt(new \DateTime());
        $objectManager->persist($log);

        $objectManager->flush();
    }
}