<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\Player;
use App\Repository\AssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class AssetDataController extends AbstractController
{
    /**
     * @Route("/assets", name="assets")
     * @param AssetRepository $assetRepository
     * @param CacheInterface $cache
     * @return JsonResponse
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function all(AssetRepository $assetRepository, CacheInterface $cache)
    {
        $players = $cache->get('all_assets', function (ItemInterface $item) use ($assetRepository) {
            $item->expiresAfter(3600);
            $players = $assetRepository->findBy([
                'active' => true,
            ]);

            return $players;
        });

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
