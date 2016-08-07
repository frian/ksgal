<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array( 'placeholder' => 'Your name' )
            ))
            ->add('email', EmailType::class, array(
                'attr' => array('placeholder' => 'Your email address'),
            ))
            ->add('message', TextareaType::class, array(
                'attr' => array('placeholder' => 'Your message'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $collectionConstraint = new Collection(array(
            'name' => array(
                new NotBlank(array('message' => 'Name should not be blank.')),
                new Length(array('min' => 3, 'minMessage' => 'Minimum {{ limit }} characters.'))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Email should not be blank.')),
                new Email(array( 'strict' => true, 'checkMX' => true, 'message' => 'Invalid email address.'))
            ),
            'message' => array(
                new NotBlank(array('message' => 'Message should not be blank.')),
                new Length(array('min' => 15, 'minMessage' => 'Minimum {{ limit }} characters.'))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getBlockPrefix() {
        return 'contact_form';
    }
}
