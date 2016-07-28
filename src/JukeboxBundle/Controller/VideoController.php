<?php

namespace JukeboxBundle\Controller;

// src/JukeboxBundle/Controller/VideoController.php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JukeboxBundle\Entity\Video;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
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

            $user_id = $this->getUser()->getId();

            if ($form->isValid()) {
                // ユーザーのIDを取得してownerにset
                $video->setOwner($user_id);
                //最後のVideoのIdを取得してidにset
                $video->setId(count($allVideo) + 1);
                //登録時の日時をlast_time_playedに登録
                $video->setLastDatePlayed(new \DateTime('now'));
                //Videoをデータベースに保存
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

    /**
     * @param Request $request
     * @param $video_id
     * @return Response
     */
    public function detailAction(Request $request, $video_id){

        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository('JukeboxBundle:Video')->find($video_id);

        return $this->render('Video/detail.html.twig'
            , array(
                //'video_id' => $video_id,
                'video' => $video
            )
        );
    }

    //video取得
    public function getVideo($id){
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository('JukeboxBundle:Video')->find($id);
        return $this->render('JukeboxBundle:Video:index.html.twig', $video);
    }


    /**
     * @param $video_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($video_id){
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository('JukeboxBundle:Video')->find($video_id);
        $entityManager->remove($video);
        $entityManager->flush();
        return $this->redirect($this->generateUrl('video'));
    }

    public function playAction()
    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $video = $entityManager->getRepository('JukeboxBundle:Video')->findLatest();

        $video = $this->getDoctrine()
            ->getRepository('JukeboxBundle:Video')
            ->findOneBy([],array('lastDatePlayed' => 'ASC'));

        $video->setLastDatePlayed(new \DateTime('now'));
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($video);
        $em->flush();

        return $this->render(
            'Video/play.html.twig', array(
                'single_video' => $video
            )
        );
    }

    public function findAllByDatetime()
    {
        return $this->getDoctrine()->getRepository('JukeboxBundle:Video')->findBy([], ['last_date_played' => 'ASC']);
    }
}

