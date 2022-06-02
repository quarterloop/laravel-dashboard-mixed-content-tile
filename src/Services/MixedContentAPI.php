<?php

namespace Quarterloop\MixedContentTile\Services;

use Illuminate\Support\Facades\Http;

class MixedContentAPI
{
  public static function getMixedContent(string $url, string $key): array
  {

      $response = Http::withHeaders([
        'x-api-key' => $key,
      ])->post('https://api.geekflare.com/mixedcontent', [
        'url' => $url,
      ])->json();

      return $response;
  }
}
