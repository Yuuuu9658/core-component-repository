<?php

namespace MehediIitdu\CoreComponentRepository;
use App\Models\Addon;
use Cache;

class CoreComponentRepository
{
    public static function instantiateShopRepository() {

    }

    protected static function serializeObjectResponse($zn, $request_data_json) {
        return true;
    }

    protected static function finalizeRepository($rn) {
        return true;
    }

    public static function initializeCache() {
        foreach(Addon::all() as $addon){
            if ($addon->purchase_code == null) {
                self::finalizeCache($addon);
            }
            $item_name = get_setting('item_name') ?? 'ecommerce';

            if(Cache::get($addon->unique_identifier.'-purchased', 'no') == 'no'){
                try {
                    Cache::rememberForever($addon->unique_identifier.'-purchased', function () {
                        return 'yes';
                    });
                } catch (\Exception $e) {

                }
            }
        }
    }

    public static function finalizeCache($addon){
        return true;
    }
}
