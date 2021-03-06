<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm(
            $builder
                ->add('title')
                ->add('coverImage', ElFinderType::class, [
                    'label' => 'Featured Image',
                    'instance' => 'single_file',
                    'enable' => true,
                    'required' => false,
                ])
            ->add('content', CKEditorType::class, array(
                'attr' => array('id' => 'editor', 'rows' => 20)
            ))
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('isPublished', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
            ->add('publishedStartAt', DateTimeType::class, array(
                'date_label' => 'Start Publishing',
            ))
            ->add('publishedEndAt', DateTimeType::class, array(
                'date_label' => 'Stop Publishing',
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