<?php
declare(strict_types=1);

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Database\PizzaTable;
use App\Model\Pizza;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PizzaController extends AbstractController
{
    private PizzaTable $pizzaTable;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->pizzaTable = new PizzaTable($connection);
    }

    public function index(): Response
    {
        $contents = PhpTemplateEngine::render('add_pizza_form.html');
        return new Response($contents);
    }

    public function addPizza(Request $request): Response
    {
        $pizza = new Pizza(
            null,
            $request->get('name'),
            $request->get('description'),
            $request->get('cost'),
        );
        $pizzaID = $this->pizzaTable->add($pizza);
        return $this->redirectToRoute(
            'show_pizza',
            ['pizzaID' => $pizzaID],
            Response::HTTP_SEE_OTHER
        );
    }

    public function viewPizza(int $pizzaID): Response
    {
        $pizza = $this->pizzaTable->find($pizzaID);
        if (!$pizza) {
            throw $this->createNotFoundException();
        }
        $contents = PhpTemplateEngine::render('pizza.php', [
            'pizza' => $pizza
        ]);
        return new Response($contents);
    }

    public function deletePizza(int $pizzaId): Response
    {
        $this->pizzaTable->delete($pizzaId);

        return $this->redirectToRoute('index');
    }
}




