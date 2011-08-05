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

timePassed = 0;
tick();
function updateTimers()
{
  timers = document.getElementsByName('timer')
  document.getElementById('info').innerHTML = timers.length;
  for(i=0;i<timers.length;i++)
  {
    timeLeft = timers.item(i).title - timePassed;
    timers.item(i).innerHTML = formatTime(timeLeft);
  }
  timePassed++;
}

function tick()
{
  updateTimers()
  window.setTimeout("tick()", 1000);
}

function formatTime(seconds)
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

function resetTimer()
{
  timePassed = 0;
}
  
  