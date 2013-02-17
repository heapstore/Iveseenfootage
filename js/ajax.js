var p;

function getPhotos()
{
	$.ajax({  
            url: "ajax.php", 
            data: { 
                getphotos: "get"
                },
            cache: false,  
            success: function(data){  
                //alert(JSON.parse ( data ));
                p = JSON.parse ( data );
                showPhotos(p);
                //alert(p[0].id);
                //alert(data);
        	}   
	});

}

function showPhotos(p)
{
    var i=0,
        j=0, 
        urlstring,
        pid,
        pid_prev,
        imgtag;

    for(i=0; i<p.length; i++)
    {
        urlstring = "http://iveseenfootage.com/storage/"+p[i].page_number +"/"+p[i].photo_filename ;
        pid = "p_"+i;
        imgtag = "<img id="+pid+" src="+urlstring+" style='display:none; width:100%%'></img>";
        
        $("#photo_container").append(imgtag);
    }
    i=1;
    j=i-1;
    pid = "p_"+i;
    pid_prev = "p_"+j;

    setInterval(function() {
        if(count!=0) return;
        if(i == p.length-1) return;
        //remove counter
        else $(".count").remove();
        //$("#"+pid_prev).css("display", "none");
        $("#"+pid_prev).remove();
        $("#"+pid).css("display", "block");

        i++;
        j=i-1;
        pid = "p_"+i;
        pid_prev = "p_"+j;

        $("#backwards").html(p.length-i);
    }, 200);

    /*setInterval(function() {
      var urlstring = "http://iveseenfootage.com/storage/"+p[i].page_number +"/"+p[i].photo_filename ;
        $("#photo_container").css("background-image", "url("+urlstring+")");
        i++;
    }, 500);*/
        //alert(p[i].id);
        //var urlstring = "http://iveseenfootage.com/storage/"+ph[0].page_number+"/"+ph[0].photo_filename";
}

function deletePhoto(pid)
{
    $.ajax({  
            url: "ajax.php", 
            data: { 
                deletephoto: parseInt(pid)
                },
            cache: false,  
            success: function(data){  
                $("#"+parseInt(pid)).css("display","none");
                //alert( $(".center").length );
            }   
    });

}



