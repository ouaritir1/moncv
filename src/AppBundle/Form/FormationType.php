<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('required' => true));
        $builder->add('place', TextType::class, array('required' => true));
        $builder->add('debut', TextType::class, array('required' => true));
        $builder->add('fin', TextType::class, array('required' => true));
        $builder->add('save', SubmitType::class, array(
            'attr' => array('class' => 'save'),
        ));
    }
    
    public function getName()
    {
        return 'formation';
    }
}
