<?php

namespace App\Form;

use App\Entity\Config\SiteSettings;
use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siteName')
            ->add('isSiteOffline', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ]
            ])
            ->add('accessLevel', ChoiceType::class, [
                'choices' => SiteSettings::ACCESS_LEVELS,
            ])
            ->add('listLimit', ChoiceType::class, [
                'choices' => SiteSettings::LIMITS
            ])
            ->add('contentType')
            ->add('description',  TextType::class)
            ->add('keywords')
            ->add('robots', ChoiceType::class, [
                'choices' => SiteSettings::ROBOTS
            ])
            ->add('contentRights')
            ->add('tempFolder')
            ->add('serverTimeZone')
            ->add('language')
            ->add('facebookAppId')
            ->add('facebookType')
            ->add('facebookTtl')
            ->add('facebookAdmins')
            ->add('facebookProfileId')
            ->add('facebookPage')
            ->add('twitterUsername')
            ->add('googleId')
            ->add('layout')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SiteSettings::class,
        ]);
    }
}
