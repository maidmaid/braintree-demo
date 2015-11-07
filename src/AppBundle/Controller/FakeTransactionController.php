<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\BraintreeTestNonceType;
use Braintree\Transaction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/fake-transaction")
 */
class FakeTransactionController extends Controller
{
    /**
     * @Route("/", name="fake_transaction")
     */
    public function fakeTransactionAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('payment_method_nonce', new BraintreeTestNonceType())
            ->setAction($this->generateUrl('fake_transaction_checkout'))
            ->getForm()
        ;

        return $this->render('fake-transaction/default.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/checkout", name="fake_transaction_checkout")
     */
    public function checkoutAction(Request $request)
    {
        $nonce = $request->request->get('form')['payment_method_nonce'];

        $result = Transaction::sale(array(
            'amount' => '10.00',
            'paymentMethodNonce' => $nonce,
        ));

        return $this->render('default/checkout.html.twig', array(
            'result' => $result,
        ));
    }
}
