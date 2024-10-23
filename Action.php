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
        $age = $_POST['age'];
        $country = $_POST['country'];
        $score1 = $_POST['score1'];
        $score2 = $_POST['score2'];
        $score3 = $_POST['score3'];

        $participantExists = false;
        foreach ($participants as $key => $participant) {
            
            
            if ($participants[$key]['id'] == $id) {
                $participants[$key]['name'] = $name;
                $participants[$key]['gender'] = $gender;
                $participants[$key]['age'] = $age;
                $participants[$key]['country'] = $country;
                $participants[$key]['score1'] = $score1;
                $participants[$key]['score2'] = $score2;
                $participants[$key]['score3'] = $score3;
                $participantExists = true;
                break;
            }
            
            /*
            if ($participant['id'] == $id) {
                $participant['name'] = $name;
                $participant['gender'] = $gender;
                $participant['age'] = $age;
                $participant['country'] = $country;
                $participant['score1'] = $score1;
                $participant['score2'] = $score2;
                $participant['score3'] = $score3;
                $participantExists = true;
                break;
            }
            */
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

    }

}

