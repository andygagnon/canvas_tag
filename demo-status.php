<!DOCTYPE html>
<head>
 <meta charset="utf-8">

 <style>
 #statusBox {
    position:absolute;
    top:10px;
    left:110px;
    }
 </style>

</head>

<body>


 <div style="float:left;">
    <form style="margin-top:10px;">
      <input type="submit" value="Download" onclick="status_spinning();return(false);" />
    </form>
 </div>

 <canvas id="statusBox" width="40" height="40">Fallback content</canvas>

<script type="application/javascript">


// draw spinning circle(s)
function draw_spinning_circle( position)
{
  var canvas = document.getElementById('statusBox');
  if (canvas.getContext)
  {
    var ctx = canvas.getContext('2d');

    // clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // set stroke
    ctx.strokeStyle = "#388eff";
    ctx.lineWidth = 1;

    // set circle
    var startAngle = (( Math.PI * 2) * position);
    var endAngle = startAngle + Math.PI*1.9;
    var x              = 20;               // x coordinate
    var y              = 20;               // y coordinate
    var radius         = 15;                    // Arc radius

    // draw partial circle
    ctx.beginPath();

    var anticlockwise  = 1 ? false : true; // clockwise or anticlockwise

    ctx.arc(x, y, radius, startAngle, endAngle, anticlockwise);
    ctx.stroke();
  }
}

// draw base circle
function draw_status_circle()
{
  var canvas = document.getElementById('statusBox');
  if (canvas.getContext)
  {
    var ctx = canvas.getContext('2d');

    // clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // set fill, stroke
    ctx.fillStyle = ctx.strokeStyle = "#388eff";
    ctx.lineWidth = 1;

    // draw center square
    ctx.fillRect( 16, 16, 8, 8);

    // draw complete circle
    ctx.beginPath();
    var x              = 20;               // x coordinate
    var y              = 20;               // y coordinate
    var radius         = 15;                    // Arc radius
    var startAngle     = 0;                     // Starting point on circle
    var endAngle       = Math.PI*2; // End point on circle
    var anticlockwise  = 0 ? false : true; // clockwise or anticlockwise
    ctx.arc(x, y, radius, startAngle, endAngle, anticlockwise);
    ctx.stroke();
  }

}


// draw inner circle(s)
function draw_inner_circle(  percent)
{
  var canvas = document.getElementById('statusBox');
  if (canvas.getContext)
  {
    var ctx = canvas.getContext('2d');

    // set stroke
    ctx.strokeStyle = "#388eff";
    ctx.lineWidth = 4;    // fat line

    var range = Math.PI*1.5 + (( Math.PI * 2) * percent);
    var x              = 20;               // x coordinate
    var y              = 20;               // y coordinate
    var radius         = 15;                    // Arc radius

    ctx.beginPath();

    radius -= 2.0;
    var startAngle     = Math.PI*1.5; // Starting point on circle
    var endAngle       = range;       // End point on circle
    var anticlockwise  = 1 ? false : true; // clockwise or anticlockwise

    ctx.arc(x, y, radius, startAngle, endAngle, anticlockwise);
    ctx.stroke();
  }
}

// update the global statusTotal ever interval call

var statusTotal = 0.0;
function update_status_inner()
{
    if ( statusTotal < 1.0)
    {
        // random increment
        statusTotal += ( Math.random() * 0.12);
        // update status
        draw_inner_circle( statusTotal);
    }
    else
    {
        statusTotal = 1.0;
        // stop interval
        clearInterval( innerInterval);
    }
}

// set interval function
var innerInterval;
function status()
{
    innerInterval = setInterval(  function(){ update_status_inner()}, 200);
    draw_status_circle();
}



// update the global statusTotal ever interval call
function update_status_spinning()
{
    if ( statusTotal < 2.6)
    {
        statusTotal += (0.1);
        // update status
        draw_spinning_circle( statusTotal);
    }
    else
    {
        statusTotal = 0.0;
        // stop interval
        clearInterval( spinningInterval);
        status();
    }
}


var spinningInterval;
// set interval function
function status_spinning()
{
    statusTotal = 0.0;
    spinningInterval = setInterval(  function(){ update_status_spinning()}, 100);
}

</script>
</body>
</html>
