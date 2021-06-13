<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class FirstController
{
    public function hello(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            $number
        );
    }
}