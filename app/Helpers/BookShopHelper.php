<?php

use App\Models\Cart as CartModel;
use App\Models\Socialite;
use Illuminate\Support\Facades\Storage;

if (!function_exists('include_route_files')) {
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('get_image_book')) {
    function get_image_book($idImage)
    {
        $defaultIamge = 'account.jpg';
        try {
            $url = Storage::disk('google')->url($idImage);
        } catch (Exception $e) {
            $url = Storage::disk('google')->url($defaultIamge);
        }
        return $url;
    }
}

if (!function_exists('get_avatar')) {
    function get_avatar()
    {
        $currentUser = auth()->user();
        if ($currentUser->avatar) {
            return get_image_book($currentUser->avatar);
        } else {
            $userSocica = Socialite::where('user_id', $currentUser->id)
                ->where('user_socialites', 1)
                ->first();
            return $userSocica->avatar ?? get_image_book('account.jpg');
        }
    }
}

if (!function_exists('concat_sql')) {
    function concat_sql($cols)
    {
        $sql = array_reduce(
            $cols,
            function ($sql, $col) {
                $sql .= ", IF(LENGTH($col), $col, NULL)";
                return $sql;
            },
            '',
        );
        return "(CONCAT_WS(' '$sql))";
    }
}

if (!function_exists('format_date')) {
    function format_date($date, $format = 'Y-m-d')
    {
        $newDate = date_create($date);
        return date_format($newDate, $format);
    }
}

if (!function_exists('get_count_cart')) {
    function get_count_cart()
    {
        if (auth()->user()) {
            $userId = auth()->user()->id;
            $cart = CartModel::where('user_id', $userId)
                ->with('CartDetails.book', function ($q) {
                    $q->withTrashed();
                })
                ->first();
            $totalItem = 0;
            foreach ($cart->CartDetails ?? [] as $cartDetail) {
                $totalItem += intval($cartDetail->amount);
            }
            return $totalItem;
        } else {
            return Cart::count();
        }
    }
}
