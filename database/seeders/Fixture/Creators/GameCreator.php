<?php

namespace Database\Seeders\Fixture\Creators;

use App\Factories\Slug\DefaultSlugFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class GameCreator extends Creator
{
    public function create(array $datum): int
    {
        $now = Carbon::now();
        /** @var DefaultSlugFactory $slugCreator */
        $slugCreator = app(DefaultSlugFactory::class);
        return DB::table('games')->insertGetId([
            'name' => $datum['name'],
            'slug' => $slugCreator->create([
                $this->getNextIdTable('games'),
                $datum['name'],
            ]),
            'description' => $datum['description'] ?? null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
