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
