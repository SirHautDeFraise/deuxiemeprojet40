<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
            ->add ('titre', ChoiceType::class,array(
                'choices'  => array(
                    'Monsieur' => 'M',
                    'Madame' => 'F',                   
                ), 'multiple'=>false,
            'expanded'=>true,
                )) 
            ->add('nom', TextType::class,   
                    array(
                        'label'=>'Nom : ',
                        'required'=>true,
                       // 'data' => $builder->getAttribute("nom", "aaa"),
                    ))
            ->add('mail', EmailType::class ,   
                    array(
                        'label'=>'Mail : ',
                        'required'=>true
                    ))
            ->add('tel', TelType::class,   
                    array(
                        'label'=>'Téléphone : ',
                        'required'=>true
                    ))
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
