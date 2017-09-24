function startTime()
{
var today=new Date()
var year=today.getFullYear();
var month=today.getMonth()+1;
var day=today.getDate();
var week=["日","一","二","三","四","五","六"];
var w = week[today.getDay()];
var h=today.getHours()
var m=today.getMinutes()
var s=today.getSeconds()
// add a zero in front of numbers<10
m=checkTime(m)
s=checkTime(s)
document.getElementById('txt').innerHTML=year+"年"+month+"月"+day+"日 星期"+w+" "+h+":"+m+":"+s;
t=setTimeout('startTime()',500)
}

function checkTime(i)
{
if (i<10)
  {i="0" + i}
  return i
}