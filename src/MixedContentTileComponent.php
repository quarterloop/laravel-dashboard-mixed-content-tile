<?php

namespace Quarterloop\MixedContentTile;

use Livewire\Component;
use Illuminate\Support\DB;

class MixedContentTileComponent extends Component
{

    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }


    public function render()
    {

      $mixedContentStore = MixedContentStore::make();

      $searchArray = $mixedContentStore->getData()['data'];

      if(array_key_exists('secure', $searchArray)) {
        $countSecure    = count($mixedContentStore->getData()['data']['secure']);
        $countInsecure  = count($mixedContentStore->getData()['data']['insecure']);
      } else {
        $countSecure    = count($mixedContentStore->getData()['data']);
        $countInsecure  = 0;
      }

        return view('dashboard-mixed-content-tile::tile', [
            'website'         => config('dashboard.tiles.hosting.url'),
            'links'           => $mixedContentStore->getData(),
            'secureCount'     => $countSecure,
            'insecureCount'   => $countInsecure,
            'lastUpdateTime'  => date('H:i:s', strtotime($mixedContentStore->getLastUpdateTime())),
            'lastUpdateDate'  => date('d.m.Y', strtotime($mixedContentStore->getLastUpdateDate())),
        ]);
    }
}
