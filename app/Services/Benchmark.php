<?php

namespace App\Services;

use App\Repositories\UserModelRepository;
use App\Repositories\UserQueryBuilderRepository;

class Benchmark
{
    public static function measure(): array
    {
        return [
            self::measureModel(),
            self::measureQueryBuilder(),
        ];
    }

    private static function measureModel(): array
    {
        /** @var UserModelRepository $repository */
        $repository = app(UserModelRepository::class);

        return \Illuminate\Support\Benchmark::measure([
            'Count with model' => fn () => $repository->getUsers(), // ms
        ], 100);
    }

    private static function measureQueryBuilder(): array
    {
        /** @var UserQueryBuilderRepository $repository */
        $repository = app(UserQueryBuilderRepository::class);

        return \Illuminate\Support\Benchmark::measure([
            'Count with QueryBuild' => fn () => $repository->getUsers(), // ms
        ], 100);
    }
}
