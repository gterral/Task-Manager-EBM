<?php

namespace Core\UserBundle\Controller;

use Core\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class ProfileController extends Controller
{
    public function addUserAction(Request $request)
    {
        $user = new User();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user);

        $formBuilder

            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('email', TextType::class)
            ->add('promotion', IntegerType::class)
            ->add('desc', TextareaType::class)
            ->add('save', SubmitType::class)
        ;

        $form = $formBuilder->getForm();

        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);

            if ($form->isValid())
            {
                /* On rajoute les attributs manquants */

                $user->setUsername(strtolower(substr($user->getName(), 0, 1) . $user->getSurname())); // "Julien Atlan" donnera "jatlan"
                $user->setPassword("user_ebm");
                $user->setFullname($user->getName() . ' ' . $user->getSurname());
                $user->addRole("ROLE_USER");

                /* [À ÉVITER] On persiste l'objet
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                */

                /* [ON UTILISERA CETTE MÉTHODE QUAND J'ARRIVERAI À FAIRE MARCHER DJANGO] */
                /* On utilise l'API Django */


                return $this->redirectToRoute('core_user_homepage');
            }
        }

        return $this->render('CoreUserBundle:Profile:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showUserProfileAction()
    {
        return $this->render('CoreUserBundle:Profile:viewProfile.html.twig');
    }

    public function showOtherProfileAction($username)
    {

    }
}