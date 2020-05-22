<?php
// src/Controller/LoginController.php
namespace App\Controller;

use App\Form\Type\LoginFormType;
use App\Service\LoginCheck;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{

    /**
     * @Route("/", name="app_login")
     */
    public function form(Request $request, LoginCheck $loginCheck)
    {
        $form = $this->createForm(LoginFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formInput = [
                'username' => $form->get('username')->getData(),
                'password' => $form->get('password')->getData(),
            ];
            $checkCredentials = $loginCheck->checkCredentials($formInput);

            if($checkCredentials) {
                // Successful login.
                $this->addFlash(
                    'success',
                    'Login successfull.'
                );
            } else {
                // Failed login.
                $this->addFlash(
                    'danger',
                    'Please check your credentials.'
                );
            }
        }

        return $this->render('login/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
