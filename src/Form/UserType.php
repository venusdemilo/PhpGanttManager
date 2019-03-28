<?php

namespace App\Form;
use Symfony\Component\Form\CallbackTransformer;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
        ;

        $builder->get('roles')
         ->addModelTransformer(new CallbackTransformer(
             function ($json) {
                 // transform the json to a string

                 $str = json_encode($json);
                 $str = strtr($str,array(
                  "["=>"",
                  "]"=>"",
                  "\""=>"", //on enlève les guillemets
                ));
                 return $str;

             },
             function ($str) {
                 // transform the string back to an array
                 return explode(',', $str);

             }
         ))
     ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
