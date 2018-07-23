<?php

class ReturnPaypal
{
    public function refundTransaction($apiCredentials){
        foreach($apiCredentials as $key => $value) echo "$key = $value";
        $refundType = 'Full';
        $api_request = 'USER=' . urlencode( $apiCredentials['Username'] )
            .  '&PWD=' . urlencode( $apiCredentials['Password'] )
            .  '&SIGNATURE=' . urlencode( $apiCredentials['signature'])
            .  '&VERSION=119'
            .  '&METHOD=RefundTransaction'
            .  '&TRANSACTIONID=' . urlencode($apiCredentials['txn_id'] )
            .  '&REFUNDTYPE=' . urlencode( $refundType )
            .  '&CURRENCYCODE=' . urlencode( 'USD' )
            .  '&AMT=' . urlencode( 15 );


        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'

        curl_setopt( $ch, CURLOPT_VERBOSE, 1 );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        // Set the API parameters for this transaction
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );

        // Request response from PayPal
        $response = curl_exec( $ch );

        // If no response was received from PayPal there is no point parsing the response
        if( ! $response ){
            return false;
        }

        curl_close( $ch );

        // An associative array is more usable than a parameter string
        parse_str( $response, $parsed_response );

        return $parsed_response;
    }
}