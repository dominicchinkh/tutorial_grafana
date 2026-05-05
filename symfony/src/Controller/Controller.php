<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Monolog\Level;
use Psr\Log\LoggerInterface;

class Controller extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    #[Route('/', name: 'home')]
    public function home(
        Request $request
    ): Response
    {
        $input = $request->request->all();
        $input['log_level'] = $input['log_level'] ?? 'info';

        $this->logger->log(Level::fromName($input['log_level']), $input['message'] ?? '');

        return $this->render('home.html.twig');
    }
}