<?php

namespace App\Form;

use App\Entity\Article;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm(
            $builder
                ->add('title')
                ->add('coverImage', ElFinderType::class, array(
                    'label' => 'Featured Image',
                    'instance' => 'single_file',
                    'enable' => true,
                ))
            ->add('content', CKEditorType::class, array(
                'attr' => array('id' => 'editor', 'rows' => 20)
            ))
            ,
            $options
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}