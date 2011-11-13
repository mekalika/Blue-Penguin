/* 
 * Code from tutorial at Practical E Commerce:
 * http://developer.practicalecommerce.com/articles/
 * 2048-Sliding-and-Gliding-Page-Content-with-JavaScript
 */

document.onclick = contentGlide; //establishes event listner

function contentGlide(e)
{
	if(!e) var e = window.event;
	var target = e.target || e.srcElement;
	if(target.parentNode.className=='control-list')
	{	
		findGliding();
		var glideMultiple = parseInt(target.id);
		var tPos = (-760 * (glideMultiple - 1));
		motionGlide(tPos);
	}
}

function findGliding()
{
	var glidingDiv = document.getElementsByTagName('div');
	for(var i =0; i < glidingDiv.length; i++)
	{
		if(glidingDiv[i].className=='gliding' ||
                  glidingDiv[i].className=='glidingreport')
		{
			gliding = glidingDiv[i];
		}
	}
}

function motionGlide(t)
{
	if(!gliding.style.left)
	{
		gliding.style.left = 0 + 'px';
	}
	var startPos = parseInt(gliding.style.left);
	if(startPos - 760 > t)  // More than one glide section away.
	{
		gliding.style.left = (startPos - 80) + 'px';
		glideTimer = setTimeout(function(){motionGlide(t)}, 1);
	}
	else if(startPos > t)
	{
		gliding.style.left = (startPos - 40) + 'px';
		glideTimer = setTimeout(function(){motionGlide(t)}, 1);
	}
	else if(startPos + 760 < t)  // More than one glide section away.
	{
		gliding.style.left = (startPos + 80) + 'px';
		glideTimer = setTimeout(function(){motionGlide(t)}, 1);
	}
	else if(startPos < t)
	{
		gliding.style.left = (startPos + 40) + 'px';
		glideTimer = setTimeout(function(){motionGlide(t)}, 1);
	}
	else{clearTimeout(glideTimer);
	}
	
}


