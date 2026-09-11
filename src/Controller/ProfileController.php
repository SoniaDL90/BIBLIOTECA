<?php

namespace App\Controller;

use App\Repository\LoanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(LoanRepository $loanRepository): Response
    {
        $user = $this->getUser();
        $activeLoans = $loanRepository->findBy(['user' => $user, 'estado' => 'activo']);
        $historyLoans = $loanRepository->findBy(['user' => $user, 'estado' => 'devuelto']);
        $retrasados = array_filter($activeLoans, fn($l) => $l->getFechaDevolucionPrevista() < new \DateTime());

        return $this->render('profile/index.html.twig', [
            'activeLoans' => $activeLoans,
            'historyLoans' => $historyLoans,
            'totalRetrasados' => count($retrasados),
        ]);
    }
}
