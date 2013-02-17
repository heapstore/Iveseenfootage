/*==================================*\
||  Автор кода — Сергей Мосцевенко  ||
||  f-ph.ru                         ||
||                                  ||
||  Код распространяется бесплатно  ||
\*==================================*/



var fph_include_flow_box = true;
if(!fph_include_base) { document.write('<script type="text/javascript" src="http://f-ph.ru/js-lib/base.js">'); }
if(!fph_include_animate) { document.write('<script type="text/javascript" src="http://f-ph.ru/js-lib/aminate.js">'); }

var is_shown = new Array();
function flow_box_content(id, action, direction, speed, display)
{
	speed *= 10;
	var elem = document.getElementById(id);
	//is_shown[id] = true;
	var to_ride;
	var act, val_start, val_finish, act_start, act_finish;
	act_start = function() {};
	act_finish = function() {};

	if(getStyle(elem, 'display') == 'none')
	{
		elem.style.display = 'block';
		var qwe = true;
	}
	if(direction == 'top' || direction == 'bottom')
	{
		to_ride = 120;
	}
	else
	{
		to_ride = elem.clientWidth;
	}
	if(qwe)
	{
		elem.style.display = 'none';
	}
	
	if(direction == 'top')
	{
		act = function(pos) {
			elem.style.top = pos + 'px';
		}
	}
	if(direction == 'right')
	{
		act = function(pos) {
			elem.style.right = pos + 'px';
		}
	}
	if(direction == 'bottom')
	{
		act = function(pos) {
			elem.style.bottom = pos + 'px';
		}
	}
	if(direction == 'left')
	{
		act = function(pos) {
			elem.style.left = pos + 'px';
		}
	}
	
	if((action == 'auto' && !(is_shown[id])) || action == 'show')
	{
		is_shown[id] = true;
		val_start = 0;
		val_finish = - to_ride;
		if(display) { act_start = function() { elem.style.display = 'block'; } }
	}
	else if((action == 'auto' && is_shown[id]) || action == 'hide')
	{
		is_shown[id] = false;
		val_start = - to_ride;
		val_finish = 0;
		if(display) { act_finish = function() { elem.style.display = 'none'; } }
	}
	
	act_start();
	animate('flow_box' + id, val_start, val_finish, speed, speed, speed, act, act_finish, 40);
}