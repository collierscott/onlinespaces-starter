<?php

namespace App\Form;

use App\Entity\Config\SiteSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siteName')
            ->add('isSiteOffline')
            ->add('accessLevel')
            ->add('listLimit')
            ->add('contentType')
            ->add('description')
            ->add('keywords')
            ->add('robots')
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
