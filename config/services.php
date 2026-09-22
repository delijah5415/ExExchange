<?php
return [
 'supabase'=>['url'=>env('SUPABASE_URL'),'anon_key'=>env('SUPABASE_ANON_KEY'),'service_role_key'=>env('SUPABASE_SERVICE_ROLE_KEY')],
 'rates'=>['url'=>env('RATE_API_URL','https://api.coingecko.com/api/v3/simple/price')],
];
