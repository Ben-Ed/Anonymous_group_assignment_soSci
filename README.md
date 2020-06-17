![Alt-Text](https://github.com/Ben-Ed/Anonymous_team_assignment_soSci/blob/master/anonymous_assignment.gif)

# Anonymous team assignment for soSci
SoSci Survey is an online survey tool to conduct scientific researches. Its customization via inbuild function or manual html and php code allows the user to create complex surveys. While the existing features are sufficient for most basic projects, a certain aspect is missing when it comes to anonymity: Group assignment of the participants without failing to grant anonymity.
<br></br>

#### Thereof, our goals are the following: 

- Mantaining anomynous group assignment
- Using snowball technique to minimize effort
<br></br>

In the following, I will explain how this is possible with a little bit of PHP code and soSci email function. Feel free to simply copy [the code](https://github.com/Ben-Ed/Anonymous_team_assignment_soSci/blob/master/php_code/assignment) and paste it in your own soSci research project. Furthermore, put [this](https://github.com/Ben-Ed/Anonymous_team_assignment_soSci/blob/master/php_code/email) in the email text. 
<br></br>

## The problem

Anonymity of participants is neccesary so that they can answer question honestly, without the fear of being traced back. Imagine if you conduct a survey which wants to analyze the satisfaction of workers with their project teams. The workers will hesitate to express displeasure if their individual answers can be traced back. However, you only have the contact information of one worker and want him to spread the survey within his project team and further, within his company. This snowball survey technique allows you to reach several responses while only contacting one worker and then concluding the results regarding each project team.
<br></br>
The existing soSci features either violate the principle of anonymity or only contacting one person. To maintain both, we need a little bit of php code. Also, this allows us to apply this snowball technique not only via personal contact information, but also by just posting the link to the survey on different platforms.
<br></br>

## How it works

Remember the goals: 

> - Mantaining anomynous group assignment
> - Using snowball technique to minimize effort

Keep the following in mind: Every participant has a individual ID, which we call **random_personal_ID**, and you can mark survey links with a variable, which we call **r**. This **r** will serve as the **team_id** .Also, soSci has an inbuild feature which let the participants enter email adresses of their collegues, thus sending a email containing the survey link to them. **These email adresses are not saved!**

![Alt-Text](https://github.com/Ben-Ed/Anonymous_team_assignment_soSci/blob/master/snowball_assignment.gif)

At the beginning, we check the link the participant used. 
```php
$team_id = readGET('r');
```
In those cases where the participant is the first member of the group/project team/company (or on whatever base you want to aggrate), there will be no **r** in the link. The link will look like this

> ht<span>tps://<span>ww<span>w.<span>soscisurvey.de/your_project<span>

Which means, that there is no **team_id** yet for the group of this participant. Therefore, we have to manually assign a **team_id**. The individual **random_personal_id** will be used as the **team_id** for this group. 

```php
if ($team_id == NULL) {
    $team_id = caseNumber();
}
```

<br>
This is the link each participant invites the following participants with
> ht<span>tps://ww<span>w.s<span>oscisu<span>rvey.de/y<span>our_project/r=%team_id%<span>
<br></br>

## How to use

Simply copy the following code into a php block within your soSci survey. There is also a commented version with explanations and further debugging options, if needed.

```php
$team_id = readGET('r');

if ($team_id == NULL) {
    $team_id = caseNumber();
}

replace('%team_id%', $team_id);
```

Additionally, put the following in the prepared email text of the email question type:
```
https://www.soscisurvey.de/your_project/r=%team_id%
```

