<?php

namespace App\Controllers\API;

use App\Abstracts\Controller;
use App\Models\PlayerModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetPlayerController extends Controller
{
    private PlayerModel $playerModel;

    public function __construct(PlayerModel $playerModel)
    {
        $this->playerModel = $playerModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = [
            'success' => false,
            'message' => 'Something went wrong',
            'data' => []
        ];
        $statusCode = 200;

        try {
            $data['data'] = $this->playerModel->getPlayerById(1);
            $data['success'] = true;
            $data['message'] = 'User info received';
        } catch (\PDOException $exception) {
            $data['message'] = $exception->getMessage();
        }

        return $this->respondWithJSON($response, $data, $statusCode);
    }
}