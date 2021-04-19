<?php
$mensaje = ''; //for error messages
$id_event = ''; //id event created 
$link_event;
if (isset($_POST['agendar'])) {


    date_default_timezone_set('America/Guayaquil');
    include_once './vendor/autoload.php';

    //configurar variable de entorno / set enviroment variable
    putenv('GOOGLE_APPLICATION_CREDENTIALS=credenciales.json');

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->setScopes(['https://www.googleapis.com/auth/calendar']);

    //define id calendario
    $id_calendar = '7h2a45g4lg88n7tvupaq9iq1ik@group.calendar.google.com';



    $datetime_start = new DateTime($_POST['date_start']);
    $datetime_end = new DateTime($_POST['date_start']);

    //aumentamos una hora a la hora inicial/ add 1 hour to start date
    $time_end = $datetime_end->add(new DateInterval('PT1H'));

    //datetime must be format RFC3339
    $time_start = $datetime_start->format(\DateTime::RFC3339);
    $time_end = $time_end->format(\DateTime::RFC3339);


    $nombre = (isset($_POST['username'])) ? $_POST['username'] : ' xyz ';
    try {

        //instanciamos el servicio
        $calendarService = new Google_Service_Calendar($client);



        //parámetros para buscar eventos en el rango de las fechas del nuevo evento
        //params to search events in the given dates
        $optParams = array(
            'orderBy' => 'startTime',
            'maxResults' => 20,
            'singleEvents' => TRUE,
            'timeMin' => $time_start,
            'timeMax' => $time_end,
        );

        //obtener eventos 
        $events = $calendarService->events->listEvents($id_calendar, $optParams);

        //obtener número de eventos / get how many events exists in the given dates
        $cont_events = count($events->getItems());

        //crear evento si no hay eventos / create event only if there is no event in the given dates
        if ($cont_events == 0) {

            $event = new Google_Service_Calendar_Event();
            $event->setSummary('Cita con el paciente ' . $nombre);
            $event->setDescription('Revisión , Tratamiento');

            //fecha inicio
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($time_start);
            $event->setStart($start);

            //fecha fin
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($time_end);
            $event->setEnd($end);


            $createdEvent = $calendarService->events->insert($id_calendar, $event);
            $id_event = $createdEvent->getId();
            $link_event = $createdEvent->gethtmlLink();
        } else {
            $mensaje = "Hay " . $cont_events . " eventos en ese rango de fechas";
        }
    } catch (Google_Service_Exception $gs) {

        $mensaje = json_decode($gs->getMessage());

        $mensaje = $mensaje->error->message;
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}

?>