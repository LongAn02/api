<?php

if (!function_exists('shopping_session_by_user')) {

    /**
     * @return mixed
     */
    function shopping_session_by_user()
    {
        return auth()->user()->shoppingSession->id;
    }
}
