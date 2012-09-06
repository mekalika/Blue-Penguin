/*var timer = [];
var timeLeft = [];

tick();
function createTimer(timerID, time) {
    timer.push(timerID);
    timeLeft.push(time);
    
    updateTimer();
    //window.setTimeout("tick()", 1000);
    document.getElementById('info').innerHTML = timer.length;
}

function tick() {
    for(i=0; i < timeLeft.length; i++)
    {
      timeLeft[i] -= 1;
    }
    updateTimer();
    window.setTimeout("tick()", 1000);
}

function updateTimer() {
    for(i=0; i < timeLeft.length; i++)
    {
      timerObject = document.getElementById(timer[i]);
      timerObject.innerHTML = timeLeft[i];
    }
}*/

// Define replenishment interval to be 3 minutes (180 seconds)
RT = 30;
downtimePassed = 0;
motivationTimePassed = 0;
prideTimePassed = 0;
battleTimePassed = 0;

function updateTimers()
{
  updateCountdownTimers();
  updateMotivationTimer();
  updatePrideTimer();
  updateBattleTimer();
  
  // debug stuff
  document.getElementById('motivationTime').innerHTML = document.getElementById('motivationTimer').title;
  document.getElementById('prideTime').innerHTML = document.getElementById('prideTimer').title;
  document.getElementById('battleTime').innerHTML = document.getElementById('battleTimer').title;
}

function updateCountdownTimers()
{
  timers = document.getElementsByName('countdownTimer');
  for(i=0;i<timers.length;i++)
  {
    timeLeft = Number(timers.item(i).title) - Number(downtimePassed);
    timers.item(i).innerHTML = formatCountdownTime(timeLeft);
  }
}

function startMotivationTimer()
{
  /* Title field contains leftover time after calculating the last increment
     i.e. If 41 seconds passed when motivation refills 1 point every 30 seconds,
     then title should contain 11
  */
  
  motivationTimePassed = Number(document.getElementById('motivationTimer').title);
  if (motivationTimePassed >= 0)
  {
    document.getElementById('motivationTimer').title = 0;
  }
}

function startPrideTimer()
{
  prideTimePassed = Number(document.getElementById('prideTimer').title);
  if (prideTimePassed >= 0)
  {
    document.getElementById('prideTimer').title = 0;
  }
}

function startBattleTimer()
{
  battleTimePassed = Number(document.getElementById('battleTimer').title);
  if (battleTimePassed >= 0)
  {
    document.getElementById('battleTimer').title = 0;
  }
}

function updateMotivationTimer()
{
  // Get current and max motivation
  currMotivation        = Number(document.getElementById('currMotivation').innerHTML);
  maxMotivation         = Number(document.getElementById('maxMotivation').innerHTML);
  
  if (currMotivation < maxMotivation)
  {
    idleTime = motivationTimePassed;
    timeLeft = RT - idleTime % RT;
    timers.innerHTML = formatCountupTime(timeLeft);
    
    if (timeLeft == RT)
    {
      // Add 1 motivation for every 3 minutes rested, up to the max motivation
      currMotivation = Math.min(currMotivation + Math.floor(idleTime / RT), maxMotivation);
      // Update current motivation
      document.getElementById('currMotivation').innerHTML = currMotivation;

      motivationTimePassed = 0;
    }
  }
  else
  {
    timers.innerHTML = "full";
  }
}

function updatePrideTimer()
{
  // Get current and max pride
  currPride     = Number(document.getElementById('currPride').innerHTML);
  maxPride      = Number(document.getElementById('maxPride').innerHTML);
  
  if (currPride < maxPride)
  {
    idleTime = prideTimePassed;
    timeLeft = RT - idleTime % RT;
    timers.innerHTML = formatCountupTime(timeLeft);
    
    if (timeLeft==RT)
    {
      // Add 1 pride for every 3 minutes rested, up to the max pride
      currPride = Math.min(currPride + Math.floor(idleTime / RT), maxPride);
      // Update current pride
      document.getElementById('currPride').innerHTML = currPride;
      
      prideTimePassed = 0;
    }
  }
  else
  {
    timers.innerHTML = "full";
  }
}

function updateBattleTimer()
{
  // Get current and max battle
  currBattle    = Number(document.getElementById('currBattle').innerHTML);
  maxBattle     = Number(document.getElementById('maxBattle').innerHTML);
  
  if (currBattle < maxBattle)
  {
    idleTime = battleTimePassed;
    timeLeft = RT - idleTime % RT;
    timers.innerHTML = formatCountupTime(timeLeft);
    
    if (timeLeft==RT)
    {
      // Add 1 battle for every 3 minutes rested, up to the max battle
      currBattle = Math.min(currBattle + Math.floor(idleTime / RT), maxBattle);
      // Update current battle
      document.getElementById('currBattle').innerHTML = currBattle;
      
      battleTimePassed = 0;
    }
  }
  else
  {
    timers.innerHTML = "full";
  }
}

function tick()
{
  downtimePassed++;
  motivationTimePassed++;
  prideTimePassed++;
  battleTimePassed++;
  
  updateTimers();
  window.setTimeout("tick()", 1000);
}

function formatCountdownTime(seconds)
{
  if (seconds > 0)
  {
    days = Math.floor(seconds / 86400);
    seconds -= days * 86400;
    hours = Math.floor(seconds / 3600);
    seconds -= hours * 3600
    minutes = Math.floor(seconds / 60);
    seconds -= minutes * 60;
    
    output = "Next session: ";
    if (days > 0)
      output += days.toString() + "D ";
    if (hours > 0)
      output += hours.toString() + ":";
    if (minutes > 0)
    {
      if (hours > 0)
      {
        minutes += 100;
        output += minutes.toString().substring(1) + ":";
      }
      else
        output += minutes.toString() + ":";
    }
    seconds += 100;
    output += seconds.toString().substring(1);
  }
  else
    output = "Available now";
  
  return output;
}

function formatCountupTime(seconds)
{
  if (seconds > 0)
  {
    days = Math.floor(seconds / 86400);
    seconds -= days * 86400;
    hours = Math.floor(seconds / 3600);
    seconds -= hours * 3600
    minutes = Math.floor(seconds / 60);
    seconds -= minutes * 60;
    
    output = "";
    if (days > 0)
      output += days.toString() + "D ";
    if (hours > 0)
      output += hours.toString() + ":";
    if (minutes > 0)
    {
      if (hours > 0)
      {
        minutes += 100;
        output += minutes.toString().substring(1) + ":";
      }
      else
        output += minutes.toString() + ":";
    }
    seconds += 100;
    output += seconds.toString().substring(1);
  }
  return output;
}

function resetCountdownTimer()
{
  downtimePassed = 0;
}

function resetCountupTimers()
{
  currMotivation        = Number(document.getElementById('currMotivation').innerHTML);
  maxMotivation         = Number(document.getElementById('maxMotivation').innerHTML);
  if (currMotivation == maxMotivation)
  {
    motivationTimePassed = 0;
  }
  
  currPride     = Number(document.getElementById('currPride').innerHTML);
  maxPride      = Number(document.getElementById('maxPride').innerHTML);
  if (currPride == maxPride)
  {
    prideTimePassed = 0;
  }
  
  currBattle    = Number(document.getElementById('currBattle').innerHTML);
  maxBattle     = Number(document.getElementById('maxBattle').innerHTML);
  if (currBattle == maxBattle)
  {
    battleTimePassed = 0;
  }
}

// Initialize timers
startMotivationTimer();
startPrideTimer();
startBattleTimer();
updateMotivationTimer();
updatePrideTimer();
updateBattleTimer();

// Start timers
tick();
  