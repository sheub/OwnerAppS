<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:20
 */

namespace App\Form;


use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CityType
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $new = $options['new'];
        $builder
            ->add('code')
            ->add('name')
            ->add('latitude')
            ->add('longitude')
            ->add('inhabitants')
            ->add('density')
            ->add('active')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class,
            'translation_domain' => 'forms',
            'new' => null
        ]);
    }
}