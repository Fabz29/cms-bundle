<?php

namespace Fabz29\CmsBundle\Form;

use Fabz29\CmsBundle\Entity\Block;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => "Nom",
        ));
        $builder->add('richContent', TextareaType::class, array(
            'label' => "Contenu riche",
            'attr' => array(
                'class' => 'froala-editor',
            )
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Block::class,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fabz29_cms_block';
    }
}