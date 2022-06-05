<?php

namespace Quarterloop\MixedContentTile\Commands;

use Illuminate\Console\Command;
use Quarterloop\MixedContentTile\Services\MixedContentAPI;
use Quarterloop\MixedContentTile\MixedContentStore;
use Session;

class FetchMixedContentCommand extends Command
{
    protected $signature = 'dashboard:fetch-mixed-content-data';

    protected $description = 'Fetch mixed content data';

    public function handle(MixedContentAPI $mixed_content_api)
    {

        $this->info('Fetching mixed content data ...');

        $mixedContent = $mixed_content_api::getMixedContent(
            Session::get('website'),
            config('dashboard.tiles.geekflare.key'),
        );

        MixedContentStore::make()->setData($mixedContent);

        $this->info('Stored data ...');

        $this->info('All done!');
    }
}
