<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Loan;
use App\Repository\BookRepository;
use App\Repository\LoanRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(
        BookRepository $bookRepository,
        UserRepository $userRepository,
        LoanRepository $loanRepository,
        EntityManagerInterface $em
    ): Response {
        $totalLibros = count($bookRepository->findAll());
        $totalUsuarios = count($userRepository->findAll());
        $prestamosActivos = $loanRepository->count(['estado' => 'activo']);
        $prestamosRetrasados = count($loanRepository->findRetrasados());
        $topLibros = $loanRepository->findTopBooks(5);

        return $this->render('admin/index.html.twig', [
            'totalLibros' => $totalLibros,
            'totalUsuarios' => $totalUsuarios,
            'prestamosActivos' => $prestamosActivos,
            'prestamosRetrasados' => $prestamosRetrasados,
            'topLibros' => $topLibros,
        ]);
    }

#[Route('/admin/loans', name: 'app_admin_loans')]
public function loans(LoanRepository $loanRepository, Request $request): Response
{
    $estado = $request->query->get('estado', '');

    if ($estado) {
        $loans = $loanRepository->findBy(['estado' => $estado]);
    } else {
        $loans = $loanRepository->findAll();
    }

    return $this->render('admin/loans.html.twig', [
        'loans' => $loans,
        'estado' => $estado,
    ]);
}
}
