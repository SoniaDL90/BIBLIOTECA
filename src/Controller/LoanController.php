<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Repository\LoanRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoanController extends AbstractController
{
    #[Route('/loan/request/{id}', name: 'app_loan_request')]
    public function request(int $id, BookRepository $bookRepository, EntityManagerInterface $em): Response
    {
        $book = $bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Libro no encontrado');
        }

        $user = $this->getUser();

        // Máximo 3 préstamos activos
        $activeLoans = $em->getRepository(Loan::class)->count([
            'user' => $user,
            'estado' => 'activo'
        ]);

        if ($activeLoans >= 3) {
            $this->addFlash('error', 'No puedes tener más de 3 préstamos activos.');
            return $this->redirectToRoute('app_books');
        }

        // Comprobar disponibilidad
        if ($book->getEjemplaresDisponibles() <= 0) {
            $this->addFlash('error', 'No hay ejemplares disponibles.');
            return $this->redirectToRoute('app_books');
        }

        // Crear préstamo
        $loan = new Loan();
        $loan->setUser($user);
        $loan->setBook($book);
        $loan->setFechaPrestamo(new \DateTime());
        $loan->setFechaDevolucionPrevista(new \DateTime('+14 days'));
        $loan->setEstado('activo');

        // Reducir ejemplares disponibles
        $book->setEjemplaresDisponibles($book->getEjemplaresDisponibles() - 1);

        $em->persist($loan);
        $em->flush();

        $this->addFlash('success', 'Préstamo realizado con éxito. Tienes 14 días para devolverlo.');
        return $this->redirectToRoute('app_my_loans');
    }

    #[Route('/loans/my', name: 'app_my_loans')]
    public function myLoans(LoanRepository $loanRepository): Response
    {
        $user = $this->getUser();
        $activeLoans = $loanRepository->findBy(['user' => $user, 'estado' => 'activo']);
        $historyLoans = $loanRepository->findBy(['user' => $user, 'estado' => 'devuelto']);

        return $this->render('loan/my_loans.html.twig', [
            'activeLoans' => $activeLoans,
            'historyLoans' => $historyLoans,
        ]);
    }

    #[Route('/loan/return/{id}', name: 'app_loan_return')]
    public function return(int $id, LoanRepository $loanRepository, EntityManagerInterface $em): Response
    {
        $loan = $loanRepository->find($id);

        if (!$loan || $loan->getUser() !== $this->getUser()) {
            throw $this->createNotFoundException('Préstamo no encontrado');
        }

        $loan->setEstado('devuelto');
        $loan->setFechaDevolucionReal(new \DateTime());
        $loan->getBook()->setEjemplaresDisponibles(
            $loan->getBook()->getEjemplaresDisponibles() + 1
        );

        $em->flush();

        $this->addFlash('success', 'Libro devuelto con éxito.');
        return $this->redirectToRoute('app_my_loans');
    }
}
