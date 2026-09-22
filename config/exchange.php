<?php
return ['spread_bps'=>(int)env('EXCHANGE_SPREAD_BPS',100),'fee_bps'=>(int)env('EXCHANGE_FEE_BPS',50),'quote_ttl'=>(int)env('EXCHANGE_QUOTE_TTL',300),'support_email'=>env('SUPPORT_EMAIL','support@example.com')];
