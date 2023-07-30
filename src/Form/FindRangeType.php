<?php

namespace App\Form;

use App\Validator\RangeBySearchNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class FindRangeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchNumber', IntegerType::class,[
                'label' => 'Число для поиска интервала',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Введите номер',
                ],
                'invalid_message' => 'Количество знаков числа не должно превышать 19',
                'constraints' => [
                    new Length(max: 19, maxMessage: "Количество знаков числа не должно превышать {{ limit }}"),
                    new NotNull(message: "Значение не должно быть пустым"),
                    new RangeBySearchNumber()
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Найти',
                'attr' => [
                    'class' => 'form-control btn btn-primary',
                ],
            ]);
    }
}
