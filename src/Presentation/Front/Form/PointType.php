<?php

namespace App\Presentation\Front\Form;

use App\Application\Transformer\Point\PointTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PointType extends AbstractType
{
    public function __construct(
        private PointTransformer $pointTransformer,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', TextType::class, [
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'required' => false,
            ])
            ->add('postcode', TextType::class, [
                'required' => false,
            ])
            ->add('name', TextType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class)
        ;

        $builder->addModelTransformer($this->pointTransformer);
    }
}