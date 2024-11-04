<?php

function filterParticipants($participants, $country, $minAge) {
    $filteredParticipants = [];
    foreach ($participants as $participant) {
        if (strtolower($participant['country']) === strtolower($country) && $participant['age'] >= $minAge) {
            $filteredParticipants[] = $participant;
        }
    }
    return $filteredParticipants;
}

function saveParticipantsToFile($filename, $participants) {
    $json_data = json_encode($participants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $json_data);
}

function loadParticipantsFromFile($filename) {
    if (file_exists($filename)) {
        $json_data = file_get_contents($filename);
        return json_decode($json_data, true);
    }
    return [];
}

$filename = 'participants.json';
$participants = loadParticipantsFromFile($filename);

if (
    array_key_exists('country', $_GET) && !empty($_GET['country']) &&
    array_key_exists('minAge', $_GET) && !empty($_GET['minAge'])
) {
    $country = $_GET['country'];
    $minAge = (int)$_GET['minAge'];
    $participants = filterParticipants($participants, $country, $minAge);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        array_key_exists('id', $_POST) &&
        array_key_exists('name', $_POST) &&
        array_key_exists('gender', $_POST) &&
        array_key_exists('age', $_POST) &&
        array_key_exists('country', $_POST) &&
        array_key_exists('score1', $_POST) &&
        array_key_exists('score2', $_POST) &&
        array_key_exists('score3', $_POST)
    ) {
        $id = intval($_POST['id']);
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $age = (int)$_POST['age'];
        $country = $_POST['country'];
        $score1 = (int)$_POST['score1'];
        $score2 = (int)$_POST['score2'];
        $score3 = (int)$_POST['score3'];

        $participantExists = false;

        foreach ($participants as $key => $participant) {
            if ($participant['id'] == $id) {
                $participants[$key] = [
                    'id' => $id,
                    'name' => $name,
                    'gender' => $gender,
                    'age' => $age,
                    'country' => $country,
                    'score1' => $score1,
                    'score2' => $score2,
                    'score3' => $score3,
                ];
                $participantExists = true;
                break;
            }
        }

        if (!$participantExists) {
            $participants[] = [
                'id' => $id,
                'name' => $name,
                'gender' => $gender,
                'age' => $age,
                'country' => $country,
                'score1' => $score1,
                'score2' => $score2,
                'score3' => $score3,
            ];
        }

        saveParticipantsToFile($filename, $participants);
    }
}

