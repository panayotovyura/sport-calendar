<?php

namespace Test\SportBundle\Services;

use SportBundle\Services\CalendarService;
use SportBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class CalendarServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListData()
    {
        $expected = [
            'today' => [],
            '1_week_ago' => [],
            '2_weeks_ago' => [],
        ];

        $user = $this->getMock(User::class);

        $date = new \DateTimeImmutable('2016-04-17');
        $oneWeekAgo = $date->modify('1 week ago');
        $twoWeeksAgo = $date->modify('2 weeks ago');

        $exerciseRepository = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $exerciseRepository->expects($this->exactly(3))
            ->method('findBy')
            ->withConsecutive(
                [
                    [
                        'user' => $user,
                        'date' => $date
                    ],
                    null,
                    null,
                    null
                ],
                [
                    [
                        'user' => $user,
                        'date' => $oneWeekAgo
                    ],
                    null,
                    null,
                    null
                ],
                [
                    [
                        'user' => $user,
                        'date' => $twoWeeksAgo
                    ],
                    null,
                    null,
                    null
                ]
            )
            ->will($this->returnValue([]));

        $calendar = new CalendarService($exerciseRepository);
        $actual = $calendar->getListData($user, $date);
        $this->assertEquals($expected, $actual);
    }
}
