function Set()
{
var option=localStorage.getItem('is_shown');

if(option!='true')
	localStorage.setItem('is_shown','true');
else 
	localStorage.setItem('is_shown','false');
	
	
}