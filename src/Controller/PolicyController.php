<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class PolicyController extends PageController
{
    /**
     * @Route("/policies/privacy", name="policy_privacy")
     */
    public function privacy()
    {
        $context['settings'] = $this->settings;
        return $this->render('policy/privacy.html.twig', [
            'context' => $context,
        ]);
    }

    /**
     * @Route("/policies/terms", name="policy_terms")
     */
    public function terms()
    {
        $context['settings'] = $this->settings;
        return $this->render('policy/terms.html.twig', [
            'context' => $context,
        ]);
    }
}
