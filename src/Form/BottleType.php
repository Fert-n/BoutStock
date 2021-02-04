<?php

namespace App\Form;

use App\Entity\Bottle;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BottleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('quantity', NumberType::class,[
                'html5'=> true,
                'attr'=>[
                    'min' => 0,
                ]
            ])
            ->add('misebout')
            ->add('createat')
            ->add('region')
            ->add('contenance', NumberType::class, [
                'html5'=> true,
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('type', EntityType::class, [
                'class'=> Category::class,
                'choice_label' => 'type',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bottle::class,
            'translation_domain' => 'bottle',
            'label_format' => 'bottle.%name%'
        ]);
    }
}
