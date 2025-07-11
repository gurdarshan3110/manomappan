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

            $this->navigationMenu = $clusters->map(function ($cluster) {
                return [
                    'id' => $cluster->id,
                    'name' => mb_substr($cluster->name, 0, 25),
                    'slug' => $cluster->slug,
                    'url' => route('pages.cluster', $cluster->slug),
                ];
            });
        }

        return $this->navigationMenu;
    }
}
