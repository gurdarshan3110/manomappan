<?php

namespace App\Traits;

use App\Models\Career;
use App\Models\CareerCluster;
use Illuminate\Support\Collection;

trait HasNavigationMenu
{
    protected ?Collection $navigationMenu = null;

    public function getNavigationMenu(): Collection
    {
        if (!$this->navigationMenu) {
            $clusters = CareerCluster::query()
                ->select(['id', 'name', 'slug'])
                ->where('status', CareerCluster::STATUS_PUBLISHED)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();

            $careers = Career::query()
                ->select(['id', 'title', 'slug', 'cluster_id'])
                ->where('status', Career::STATUS_PUBLISHED)
                ->orderBy('sort_order')
                ->orderBy('title')
                ->get()
                ->groupBy('cluster_id');

            $this->navigationMenu = $clusters->map(function ($cluster) use ($careers) {
                return [
                    'id' => $cluster->id,
                    'name' => mb_substr($cluster->name, 0, 25),
                    'slug' => $cluster->slug,
                    'url' => route('pages.cluster', $cluster->slug),
                    'careers' => $careers->get($cluster->id, collect())->map(function ($career) {
                        return [
                            'id' => $career->id,
                            'title' => mb_substr($career->title, 0, 25),
                            'slug' => $career->slug,
                            'url' => route('pages.career', ['cluster' => $career->cluster->slug, 'career' => $career->slug]),
                        ];
                    })->toArray(),
                ];
            });
        }

        return $this->navigationMenu;
    }
}
