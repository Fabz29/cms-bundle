<?php

namespace Fabz29\CmsBundle\Form;

use Fabz29\CmsBundle\Entity\Block;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;

class BlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => "Nom",
            'attr' => array(
                'class' => 'form-control'
            )
        ));
        $builder->add('richContent', FroalaEditorType::class, array(
            'label' => "Contenu riche",
            'attr' => array(
                'class' => 'form-control froala-editor',
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