<?php

namespace AppBundle\Controller;

use Braintree\Plan;
use Braintree\Transaction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/plan")
 */
class PlanController extends Controller
{
    /**
     * @Route("/", name="plan")
     */
    public function indexAction(Request $request)
    {
        $plans = Plan::all();

        return $this->render('plan/default.html.twig', array(
            'plans' => $plans,
        ));
    }
}
