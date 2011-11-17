/* Author:

*/

var vinourl = "/_assets/code/includes/search.php";
var items = new Array();

// Get some JQM stuff out of the way
var listDivsOpen = '<div class="ui-btn-inner ui-li ui-li-has-alt"><div class="ui-btn-text"><a href="index.html" class="ui-link-inherit">'
var listDivsClose = '</a></div></div>'

// Hold button code
var buttonCode = '<a href="" data-rel="dialog" data-transition="slideup" title="Check In" class="ui-li-link-alt ui-btn ui-btn-up-c" data-theme="c"><span class="ui-btn-inner ui-li ui-li-has-alt"><span class="ui-btn-text"></span><span title="" data-theme="d" class="ui-btn ui-btn-up-d ui-btn-icon-notext ui-btn-corner-all ui-shadow"><span class="ui-btn-inner ui-btn-corner-all ui-li ui-li-has-alt"><span class="ui-btn-text"></span><span class="ui-icon ui-icon-check ui-icon-shadow"></span></span></span></span></a>'


// ?akey=rrwb6nqmqmiyhshx0rickn01sn3aoi89f78ym08rhuhbbsz7&ip=66.28.234.115&q=napa+cabernet&xp=30 
//akey: "rrwb6nqmqmiyhshx0rickn01sn3aoi89f78ym08rhuhbbsz7",
//    ip: userip,

function getWineSearch(searchme) {

  var userip = $('#userip').val();
  
  	
				
				
				

  $.getJSON(vinourl,
  {
    q: searchme
  },
  function(data) {
  	 
  	 //$('#wineresults').html(data);
  	
  	
     $.each(data, function(key, val) {
	    if (key == 'wines') {
	    	for (x in val) {
	    		//items.push('<li id="' + key + '"><img src="'+val[x].image+'"  /> <b>' + val[x].name + '</b><br /> <br /> Type: '+val[x].type+'<br /> Tags: '+val[x].tags+' <br /> Code: '+val[x].code+' <br /> Winery: '+val[x].winery+' <br /> Winery_id: '+val[x].winery_id+' <br /> Region: '+val[x].region+' <br /> Varietal: '+val[x].varietal+' <br /> Vintage: '+val[x].vintage+' <br /> Price: '+val[x].price+'<br /> link: '+val[x].link+' </li>');
	    		 items.push('<li class="ui-li-has-thumb ui-btn ui-btn-up-c ui-btn-icon-right ui-li ui-li-has-alt" data-theme="b">' + listDivsOpen + '<img src="'+val[x].image+'" class="ui-li-thumb" /><h3 class="ui-li-heading">' + val[x].name + '</h3><p class="ui-li-desc">Winery: '+val[x].winery+'</p>' + listDivsClose + buttonCode + '</li>');
	    	}
	    }
	  });
	
	  $('<ul/>', {
	    'class': 'ui-listview',
	    'data-split-theme': 'd',
	    'data-split-icon': 'gear',
	    'data-role': 'listview',
	    html: items.join('')
	  }).appendTo('#wineresults').trigger("create");    
    
  });
  
}
  
  
  
$(document).ready(function(){	
	
	$('#gowinesearch').click(function(event){	
		event.preventDefault();	
		searchq = $('#winesearchtext').val();
		getWineSearch(searchq);
	});
	
	$('#winesearchform').submit(function(event) {
		//alert('submit');
		event.preventDefault();
		searchq = $('#winesearchtext').val();
		getWineSearch(searchq);
	});
	
});

  
 

