<?php

namespace App\Form;

use App\Entity\GanttData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GanttDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ganttArr')
            ->add('ganttJson',TextareaType::class,[])
            ->add('ganttObj')
        ;

        $builder->get('ganttJson')
                ->addModelTransformer (new CallbackTransformer(
                  function($json){
                    $str = json_encode($json,true);
                    return $str;
                  },
                  function($str){
                    $json = json_decode($str);
                    return $json;
                  }
                ));
    }





    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GanttData::class,
        ]);
    }
}
