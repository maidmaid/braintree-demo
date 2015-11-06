<?php

namespace AppBundle\Controller;

use Braintree\ClientToken;
use Braintree\Transaction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $token = ClientToken::generate();

        return $this->render('default/index.html.twig', array(
            'token' => $token,
        ));
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkoutAction(Request $request)
    {
        $nonce = $request->get('payment_method_nonce');

        $result = Transaction::sale(array(
            'amount' => '10.00',
            'paymentMethodNonce' => $nonce,
        ));

        return $this->render('default/checkout.html.twig', array(
            'result' => $result,
        ));
    }
}
