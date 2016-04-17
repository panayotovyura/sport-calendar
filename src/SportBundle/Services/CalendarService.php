<?php

namespace SportBundle\Services;

use Doctrine\ORM\EntityRepository;
use SportBundle\Entity\User;

class CalendarService
{
    /**
     * @var EntityRepository
     */
    protected $exerciseRepository;

    /**
     * CalendarService constructor
     *
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository)
    {
        $this->exerciseRepository = $entityRepository;
    }

    /**
     * Get exercises results
     *
     * @param User $user
     * @param \DateTimeImmutable $date
     * @return array
     */
    public function getListData(User $user, \DateTimeImmutable $date = null)
    {
        if (null === $date) {
            $date = new \DateTimeImmutable('today');
        }

        $oneWeekAgo = $date->modify('1 week ago');
        $twoWeeksAgo = $date->modify('2 weeks ago');

        $calendarResults = [
            'today' => $this->exerciseRepository->findBy([
                'user' => $user,
                'date' => $date,
            ]),
            '1_week_ago' => $this->exerciseRepository->findBy([
                'user' => $user,
                'date' => $oneWeekAgo,
            ]),
            '2_weeks_ago' =>$this->exerciseRepository->findBy([
                'user' => $user,
                'date' => $twoWeeksAgo,
            ]),
        ];

        return $calendarResults;
    }
}
