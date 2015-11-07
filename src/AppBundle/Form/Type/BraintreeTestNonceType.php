<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BraintreeTestNonceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $nonces = new \ReflectionClass('Braintree\\Test\\Nonces');
        $constants = $nonces->getStaticProperties();

        $resolver->setDefaults(array(
            'choices' => array_flip($constants),
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'braintree_test_nonce';
    }
}