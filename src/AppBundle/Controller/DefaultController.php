<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\BraintreeTestNonceType;
use Braintree\ClientToken;
use Braintree\Test\Nonces;
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
        if ($nonce = $request->get('payment_method_nonce')) {
            $nonce = $request->request->get('form')['payment_method_nonce'];
        }

        $result = Transaction::sale(array(
            'amount' => '10.00',
            'paymentMethodNonce' => $nonce,
        ));

        return $this->render('default/checkout.html.twig', array(
            'result' => $result,
        ));
    }

    /**
     * @Route("/fake-transaction", name="fake-transaction")
     */
    public function fakeTransactionAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('payment_method_nonce', new BraintreeTestNonceType())
            ->setAction($this->generateUrl('checkout'))
            ->getForm()
        ;

        return $this->render('default/fake-transaction.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
