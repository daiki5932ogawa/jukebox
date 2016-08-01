<?php

namespace JukeboxBundle\Controller;

// src/JukeboxBundle/Controller/UserController.php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JukeboxBundle\Entity\Video;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class UserController extends Controller
{
    /**
     * @Route("/", name="Video")
     */
    public function indexAction()
    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $video = $entityManager->getRepository('JukeboxBundle:Video')->findLatest();

        $user = $this->getDoctrine()
            ->getRepository('JukeboxBundle:User')
            ->findBy([],['id' => 'ASC']);

        return $this->render(
            'User/index.html.twig', array(
                'user_array' => $user
             )
        );
    }
}

