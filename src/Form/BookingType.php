<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Cabin;
use Doctrine\DBAL\Types\TextType;
use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cabin', null, [
	            'class'         => 'App\Entity\Cabin',
	            'label'         => 'Cabin',
	            'expanded'      => true,
	            'multiple'      => false
            ])
            ->add('month')
	        ->add('guestQuantity')
	        ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
