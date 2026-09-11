<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@biblioteca.com');
        $admin->setNombre('Admin');
        $admin->setApellidos('Principal');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin1234'));
        $admin->setFechaRegistro((new \DateTime())->format('Y-m-d H:i:s'));
        $manager->persist($admin);

        $nombres = [['Ana', 'Garcia'], ['Luis', 'Martinez'], ['Maria', 'Lopez'], ['Carlos', 'Sanchez']];
        foreach ($nombres as $i => $nombre) {
            $user = new User();
            $user->setEmail('user' . ($i+1) . '@biblioteca.com');
            $user->setNombre($nombre[0]);
            $user->setApellidos($nombre[1]);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->hasher->hashPassword($user, 'user1234'));
            $user->setFechaRegistro((new \DateTime())->format('Y-m-d H:i:s'));
            $manager->persist($user);
        }

        $libros = [
            ['El Quijote', 'Miguel de Cervantes', '978-84-376-0494-7', 'Planeta', 1605, 'Novela', 5],
            ['Cien anos de soledad', 'Gabriel Garcia Marquez', '978-84-397-0495-8', 'Sudamericana', 1967, 'Realismo magico', 4],
            ['1984', 'George Orwell', '978-84-499-0496-9', 'Secker Warburg', 1949, 'Distopia', 3],
            ['El extranjero', 'Albert Camus', '978-84-376-0497-0', 'Gallimard', 1942, 'Filosofia', 2],
            ['Crimen y castigo', 'Fiodor Dostoievski', '978-84-376-0498-1', 'Catedra', 1866, 'Novela', 3],
            ['La Odisea', 'Homero', '978-84-376-0499-2', 'Gredos', 800, 'Epica', 4],
            ['Hamlet', 'William Shakespeare', '978-84-376-0500-3', 'Alianza', 1603, 'Teatro', 2],
            ['El principito', 'Antoine de Saint-Exupery', '978-84-376-0501-4', 'Reynal', 1943, 'Fabula', 6],
            ['Orgullo y prejuicio', 'Jane Austen', '978-84-376-0502-5', 'T. Egerton', 1813, 'Romance', 3],
            ['Moby Dick', 'Herman Melville', '978-84-376-0503-6', 'Harper', 1851, 'Aventura', 2],
            ['La metamorfosis', 'Franz Kafka', '978-84-376-0504-7', 'Kurt Wolff', 1915, 'Absurdismo', 4],
            ['Rayuela', 'Julio Cortazar', '978-84-376-0505-8', 'Sudamericana', 1963, 'Novela', 3],
            ['Ficciones', 'Jorge Luis Borges', '978-84-376-0506-9', 'Sur', 1944, 'Cuentos', 5],
            ['La casa de los espiritus', 'Isabel Allende', '978-84-376-0507-0', 'Plaza Janes', 1982, 'Realismo magico', 3],
            ['Los miserables', 'Victor Hugo', '978-84-376-0508-1', 'Lacroix', 1862, 'Novela', 2],
            ['Anna Karenina', 'Leon Tolstoi', '978-84-376-0509-2', 'The Russian Messenger', 1877, 'Novela', 3],
            ['El nombre de la rosa', 'Umberto Eco', '978-84-376-0510-3', 'Bompiani', 1980, 'Misterio', 4],
            ['Beloved', 'Toni Morrison', '978-84-376-0511-4', 'Knopf', 1987, 'Novela', 2],
            ['El alquimista', 'Paulo Coelho', '978-84-376-0512-5', 'HarperCollins', 1988, 'Fabula', 5],
            ['Sapiens', 'Yuval Noah Harari', '978-84-376-0513-6', 'Kinneret', 2011, 'Historia', 4],
        ];

        foreach ($libros as $libro) {
            $book = new Book();
            $book->setTitulo($libro[0]);
            $book->setAutor($libro[1]);
            $book->setIsbn($libro[2]);
            $book->setEditorial($libro[3]);
            $book->setAnioPublicacion($libro[4]);
            $book->setGenero($libro[5]);
            $book->setEjemplaresTotales($libro[6]);
            $book->setEjemplaresDisponibles($libro[6]);
            $book->setFechaCreacion(new \DateTime());
            $manager->persist($book);
        }

        $manager->flush();
    }
}
