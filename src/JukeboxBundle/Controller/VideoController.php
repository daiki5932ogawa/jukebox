<?php

namespace JukeboxBundle\Controller;

// src/JukeboxBundle/Controller/VideoController.php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JukeboxBundle\Entity\Video;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends Controller
{
    /**
     * @Route("/", name="Video")
     */
    public function indexAction()
    {
        return $this->render(
            'Video/index.html.twig'
        );
    }

    public function newAction(Request $request)
    {
        //フォームの作成
        $video = new Video();

        $form = $this->createFormBuilder($video)
            ->add('url', 'text')
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                // ユーザーのIDを取得してownerにset
                $video->setId(2);
                //最後のVideoのIdを取得してidにset
                $video->setOwner('1');
                //Videoをデータベースに保存
                $form->handleRequest($video);
                //video画面にリダイレクト
                return $this->redirect($this->generateUrl('video'));
            }
        }

        return $this->render('Video/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    //videoの新規登録
    public function registerMovie()
    {
        $video = new Video();
        $video->setId(2);
        $video->setUrl('http://sjfnasjfna');
        $video->setOwner('1');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($video);
        $em->flush();

        return new Response('Created product id '.$video->getId());

    }

    //video取得
    public function showVideo(){
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository('JukeboxBundle:Video')->find($id);
    }
}

