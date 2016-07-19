<?php

namespace JukeboxBundle\Controller;

// src/JukeboxBundle/Controller/VideoController.php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
}

