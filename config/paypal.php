<?php

return array(
		/** set your paypal credential **/
		'client_id' =>'AaF5hwsFld2whXvwfLHZCbRFtQB18V4rtoUsP6CFmBEowjyYn8MReIxGcFWi5KNwSVpD_aA2Glt8ffUD',
		'secret' => 'EFbB6RjgVzV-8r0wHXQ2hgBS8lme-ojNQ6kRqz7xQpH2RLdTGo54opmCkRNl7T_v23O16H1788yOjMty',
		/**
		* SDK configuration 
		*/
		'settings' => array(
			/**
			* Available option 'sandbox' or 'live'
			*/
			'mode' => 'sandbox',
			/**
			* Specify the max request time in seconds
			*/
			'http.ConnectionTimeOut' => 30,
			/**
			* Whether want to log to a file
			*/
			'log.LogEnabled' => true,
			/**
			* Specify the file that want to write on
			*/
			'log.FileName' => storage_path() . '/logs/paypal.log',
			/**
			* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
			*
			* Logging is most verbose in the 'FINE' level and decreases as you
			* proceed towards ERROR
			*/
			'log.LogLevel' => 'FINE'
		),
);