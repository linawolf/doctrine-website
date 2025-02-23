<?php

declare(strict_types=1);

namespace Doctrine\Website\Controllers;

use Doctrine\StaticWebsiteGenerator\Controller\Response;
use Doctrine\Website\Model\CommittersStats;
use Doctrine\Website\Model\TeamMember;
use Doctrine\Website\Repositories\TeamMemberRepository;

class ConsultingController
{
    /** @var TeamMemberRepository */
    private $teamMemberRepository;

    public function __construct(TeamMemberRepository $teamMemberRepository)
    {
        $this->teamMemberRepository = $teamMemberRepository;
    }

    public function index(): Response
    {
        $consultants = $this->teamMemberRepository->findConsultants();

        $consultantsStats = $this->createCommittersStats($consultants);

        return new Response(
            [
                'consultants' => $consultants,
                'consultantsStats' => $consultantsStats,
            ],
        );
    }

    /** @param TeamMember[] $teamMembers */
    private function createCommittersStats(array $teamMembers): CommittersStats
    {
        return new CommittersStats($teamMembers);
    }
}
