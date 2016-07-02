<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class GalleryItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('dimensions')
            ->add('techniques')
            ->add('image', FileType::class, array(
                'data_class' => null,
            	'required' => false
            ))
            ->add('bgimage', FileType::class, array(
                'data_class' => null,
            	'required' => false
            ))
            ->add('gallery', EntityType::class, array(
            		// query choices from this entity
            		'class' => 'AppBundle:Gallery',
            	))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\GalleryItem'
        ));
    }
}
