<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\Player;
use App\Repository\AssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AssetDataController extends AbstractController
{
    /**
     * @Route("/assets", name="assets")
     * @param AssetRepository $assetRepository
     * @return JsonResponse
     */
    public function all(AssetRepository $assetRepository)
    {
        $players = $assetRepository->findBy([
            'active' => true,
        ]);

        return $this->json([
            'status' => 'success',
            'data' => $players,
        ]);
    }

    /**
     * @Route("/asset/{id}", name="asset")
     * @param Asset $asset
     * @return JsonResponse
     */
    public function asset(Asset $asset)
    {
        $data = [
            'id' => $asset->getId(),
            'name' => $asset->getMergeName(),
            'values' => $asset->getValues(),
        ];

        if ($asset instanceof Player) {
            $data['position'] = $asset->getPosition();
            $data['team'] = $asset->getTeam();
        }

        return $this->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
