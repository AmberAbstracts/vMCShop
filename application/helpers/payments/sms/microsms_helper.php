<?php

 /**
 * Created with ♥ by Verlikylos on 05.04.2017 16:30.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
 */

function check($userid, $serviceid, $service_number, $code) {
    if (preg_match("/^[A-Za-z0-9]{8}$/", $code)) {
        $api = @file_get_contents("http://microsms.pl/api/v2/multi.php?userid=" . $userid . "&code=" . $code . '&serviceid=' . $serviceid);

        if (!isset($api)) {
            return array('value' => false, 'message' => 'Nie można nawiazać połączenia z serwerem płatności! Spróbuj ponownie później.');
        }

        $api = json_decode($api);

        if (!is_object($api)) {
            return array('value' => false, 'message' => 'Wystapił błąd podczas pobierania informacji z serwera płatności! Spróbuj ponownie później!');
        }
        if (isset($api->error) && $api->error) {
            return array('value' => false, 'message' => 'Wystapił błąd podczas pobierania informacji z serwera płatności! Spróbuj ponownie później! Kod błędu: ' . $api->error->errorCode . ' - ' . $api->error->message);
        }
        if ($api->connect == false) {
            return array('value' => false, 'message' => 'Wystapił błąd podczas pobierania informacji z serwera płatności! Spróbuj ponownie później! Kod błędu: ' . $api->data->errorCode . ' - ' . $api->data->message);
        }
        if ($api->data->number!=$service_number) {
            return array('value' => false, 'message' => 'Podany kod jest nieprawidłowy!');
        }

        if (isset($api->connect) && $api->connect == true) {
            if ($api->data->status == 1) {
                return array('value' => true, 'message' => 'Usługa została pomyślnie zrealizowana!');
            } else {
                return array('value' => false, 'message' => 'Podany kod jest nieprawidłowy!');
            }
        }
    } else {
        return array('value' => false, 'message' => 'Podany kod jest nieprawidłowy!');
    }
}