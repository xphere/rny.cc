<?php

namespace Berny\Bundle\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UrlShortenerType extends AbstractType
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url', 'url');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rnycc_urlshortener';
    }
}
