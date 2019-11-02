<?php
namespace App\Controller;

use App\Entity\Player;
use App\Entity\RoundPick;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AssetValueController extends AbstractController
{

    /**
     * @Route("/player-value-by-mfl-id/{thirdPartyIdMFL}")
     * @param Player $player
     * @return JsonResponse
     */
    public function playerValueByMFLId(Player $player)
    {
        return $this->json([
            'status' => 'success',
            'data' => [
                'value1QB' => $player->getValueQB1(),
                'value2QB' => $player->getValueQB2(),
            ],
        ]);
    }

    /**
     * @Route("/player-values-by-mfl-ids")
     * @param PlayerRepository $playerRepository
     * @return JsonResponse
     */
    public function playerValuesByMFLIds(PlayerRepository $playerRepository)
    {
        /** @var Collection $players */
        $players = $playerRepository->findAll();
        $players = array_map(function(Player $player) {
            return [
                'mflId' => $player->getThirdPartyIdMFL(),
                'valueQB1' => $player->getValueQB1(),
                'valueQB2' => $player->getValueQB2(),
            ];
        }, array_filter($players, function(Player $player) {
            return $player->getThirdPartyIdMFL() !== null;
        }));

        return $this->json([
            'status' => 'success',
            'data' => $players,
        ]);
    }

    /**
     * @Route("/pick-value-by-round/{year}")
     * @param string $year
     * @return JsonResponse
     */
    public function pickValueByRound(string $year)
    {
        $picks = array_map(function(RoundPick $pick) {
            return [
                'round' => $pick->getRound(),
                'valueQB1' => $pick->getValueQB1(),
                'valueQB2' => $pick->getValueQB2(),
            ];
        }, $this->getDoctrine()->getRepository(RoundPick::class)->findBy([
            'year' => $year,
        ]));

        return $this->json([
            'status' => 'success',
            'data' => $picks,
        ]);
    }
}
