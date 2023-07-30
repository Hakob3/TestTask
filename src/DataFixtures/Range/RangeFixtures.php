<?php

namespace App\DataFixtures\Range;

use App\Entity\Range;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class RangeFixtures extends Fixture
{
    private const TEST_DATA_FILE_NAME = "test_data.csv";

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws Exception
     * @throws UnavailableStream
     */
    public function load(ObjectManager $manager): void
    {
        $csv = Reader::createFromPath(__DIR__ . '/' . self::TEST_DATA_FILE_NAME, 'r')
            ->setHeaderOffset(0);
        foreach ($csv as $record) {
            $range = new Range();
            $range->setMin($record['min']);
            $range->setMax($record['max']);

            $manager->persist($range);
        }
        $manager->flush();
    }
}