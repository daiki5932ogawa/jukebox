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
//        $entityManager = $this->getDoctrine()->getManager();
//        $video = $entityManager->getRepository('JukeboxBundle:Video')->findLatest();

        $video = $this->getDoctrine()
            ->getRepository('JukeboxBundle:Video')
            ->findAll();

        return $this->render(
            'Video/index.html.twig', array(
                'video_array' => $video
             )
        );
    }

    public function newAction(Request $request)
    {
        //フォームの作成
        $video = new Video();

        $allVideo = $this->getDoctrine()
            ->getRepository('JukeboxBundle:Video')
            ->findAll();
        $videoCounter = count($allVideo);

        $form = $this->createFormBuilder($video)
            ->add('url', 'text')
            ->getForm();

        //動画を登録する処理
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                // ユーザーのIDを取得してownerにset
                $video->setOwner('1');
                //最後のVideoのIdを取得してidにset
                $video->setId(count($allVideo) + 1);
                //Videoをデータベースに保存
                //$form->handleRequest($video);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($video);
                $em->flush();

                //video画面にリダイレクト
                return $this->redirect($this->generateUrl('video'));
            }
        }

        return $this->render('Video/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function detailAction($video_id){

        $url = $this->generateUrl(
            'Video/detail',
            array('video_id' => 'video_id')
        );
    }

    //video取得
    public function getVideo($id){
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository('JukeboxBundle:Video')->find($id);
        return $this->render('JukeboxBundle:Video:index.html.twig', $video);
    }

}

