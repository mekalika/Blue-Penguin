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
startMotivationTimer();
startPrideTimer();
startBattleTimer();
replenishMotivation(updateMotivationTimer());
replenishPride(updatePrideTimer());
replenishBattle(updateBattleTimer());
tick();

function updateTimers()
{
  downtimePassed++;
  motivationTimePassed++;
  prideTimePassed++;
  battleTimePassed++;
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
    alert("test1");
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
  timers = document.getElementById('motivationTimer');
  if (Number(timers.title) >= 0)
  {
    idleTime = Number(timers.title) + motivationTimePassed;
    timeLeft = RT - idleTime % RT;
    timers.innerHTML = formatCountupTime(timeLeft);
    if (document.getElementById('info') != null)
      document.getElementById('info').innerHTML = Number(timers.title)+" "+motivationTimePassed+" "+timeLeft;
    if (timeLeft==RT)
    {
      replenishMotivation(idleTime);
      motivationTimePassed = 0;
    }
    return(idleTime);
  }
  else
  {
    return 0;
  }
}

function updatePrideTimer()
{
  timers = document.getElementById('prideTimer');
  if (Number(timers.title) >= 0)
  {
    idleTime = Number(timers.title) + prideTimePassed;
    timeLeft = RT - idleTime % RT;
    timers.innerHTML = formatCountupTime(timeLeft);
    if (timeLeft==RT)
    {
      replenishPride(idleTime);
      prideTimePassed = 0;
    }
    return(idleTime);
  }
  else
  {
    return 0;
  }
}

function updateBattleTimer()
{
  timers = document.getElementById('battleTimer');
  if (Number(timers.title) >= 0)
  {
    idleTime = Number(timers.title) + battleTimePassed;
    timeLeft = RT - idleTime % RT;
    timers.innerHTML = formatCountupTime(timeLeft);
    if (timeLeft==RT)
    {
      replenishBattle(idleTime);
      battleTimePassed = 0;
    }
    return(idleTime);
  }
  else
  {
    return 0;
  }
}

function replenishMotivation(timeRested)
{
  // Get current and max motivation
  currMotivation        = Number(document.getElementById('currMotivation').innerHTML);
  maxMotivation         = Number(document.getElementById('maxMotivation').innerHTML);
  // Add 1 motivation for every 3 minutes rested, up to the max motivation
  currMotivation = Math.min(currMotivation + Math.floor(timeRested / RT), maxMotivation);
  // Update current motivation
  document.getElementById('currMotivation').innerHTML = currMotivation;
  
  // If motivation is full, set time offset to -1
  timer = document.getElementById('motivationTimer');
  if (currMotivation == maxMotivation)
  {
    timer.title = -1;
    timer.innerHTML = "full";
  }
  else
  {
    timer.title = 0;
  }
}

function replenishPride(timeRested)
{
  // Get current and max pride
  currPride     = Number(document.getElementById('currPride').innerHTML);
  maxPride      = Number(document.getElementById('maxPride').innerHTML);
  // Add 1 pride for every 3 minutes rested, up to the max pride
  currPride = Math.min(currPride + Math.floor(timeRested / RT), maxPride);
  // Update current pride
  document.getElementById('currPride').innerHTML = currPride;
  
  // If pride is full, set time offset to -1
  timer = document.getElementById('prideTimer');
  if (currPride == maxPride)
  {
    timer.title = -1;
    timer.innerHTML = "full";
  }
  else
  {
    timer.title = 0;
    alert("test2");
  }
}

function replenishBattle(timeRested)
{
  // Get current and max battle
  currBattle    = Number(document.getElementById('currBattle').innerHTML);
  maxBattle     = Number(document.getElementById('maxBattle').innerHTML);
  // Add 1 battle for every 3 minutes rested, up to the max battle
  currBattle = Math.min(currBattle + Math.floor(timeRested / RT), maxBattle);
  // Update current battle
  document.getElementById('currBattle').innerHTML = currBattle;
  
  // If battle is full, set time offset to -1
  timer = document.getElementById('battleTimer');
  if (currBattle == maxBattle)
  {
    timer.title = -1;
    timer.innerHTML = "full";
  }
  else
  {
    timer.title = 0;
  }
}

function tick()
{
  updateTimers()
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
  motivationTimePassed = 0;
  prideTimePassed = 0;
  battleTimePassed = 0;
}
  