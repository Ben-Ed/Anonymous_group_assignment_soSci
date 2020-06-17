//simply copy the following into a php block within your soSci survey

//team_id is now assigned the r from the link 
$team_id = readGET('r');

//preparing html to make it visible wether it is a firt time participant or not. 
//this is primary for debugging
$ID_check = '<p><h2><mark>Not the first time a group participant opened this survey<(h2></mark></p>';


//the first participant of a group will receive a link without an r | r => NULL
if ($team_id == NULL) {

    //again, debugging
    $ID_check = '<p><h2><mark>First time a group participant opened this survey</h2></mark></p>';
    $team_id = caseNumber();
    //team_id now equals the unique random_personal_id. This will be the future r.  
}

//printing wether it is a first time participant or not
html($ID_check); 

//The placehoalder %team__id% will be replaced by the true value of team_id
replace('%team_id%', $team_id);

//Debugging. Printin the team_id and the random_personal_id
//If it is a first time group participant, the codes will be equal. 
$new_id_check = '<p><h2>Your team code: %team_id% </p></h2>';
html($new_id_check);
$casenr = '<p><h2>Your CaseNumber:'.caseNumber(). '</p></h2>';
html($casenr);
