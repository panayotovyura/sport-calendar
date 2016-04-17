<?php

namespace SportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CalendarController extends Controller
{

    /**
     * @Route("/exercises", name="exercises")
     * @Template
     */
    public function exercisesAction()
    {
        return [
            'exercises' => $this->get('calendar_service')->getListData(
                $this->getUser()
            )
        ];
    }
}
