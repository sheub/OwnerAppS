<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:20
 */

namespace App\Form;


use App\Entity\Station;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StationType
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class StationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $new = $options['new'];
        $builder
            ->add('code')
            ->add('name')
            ->add('address')
            ->add('description')
            ->add('latitude')
            ->add('longitude')
            ->add('bikesCapacity')
            ->add('bikesAvailable')
            ->add('active')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Station::class,
            'translation_domain' => 'forms',
            'new' => null
        ]);
    }
}