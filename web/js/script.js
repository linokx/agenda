/* ria.exos.flatland.be - Notes de cours en ligne pour le cours de RIA - Applications Internet Riches
 * JS Document - /html5/test_one/js/script.js
 * coded by LUDOVIC BEKAERT (2384)
 * october 2012
 */

/*jslint regexp: true, vars: true, white: true, browser: true */
/*global jQuery, google */
(function($){	
	var $lieux, gmap;
	var aPosition = [], aMarker = [];
	
	var localiser = function(e){
		e.preventDefault();
		if($('#adresse').val()!=='' || $('#ville').val()!==''){
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
				address: $('#adresse').val()+','+$('#ville').val()+", Belgique"
				//address: 'Rue de l\'hostel des haies, mouscron, Belgique'
			},function(result,status){
				if(status == "OK"){
					$('#lat').val(result[0].geometry.location.Ya);
					$('#lon').val(result[0].geometry.location.Za);
					
					$('form').submit();
				}
				else
				{
					$('form').append('<p>Impossible de calculer votre position.</p>');
				}
			});
		}

	};

	//Generation de la map Google
	var generateMap = function(){
		if($('#minimap').length>0){
			$.ajax({
	            url: 'sortie/position',
	            type:'POST',
	            dataType: 'json',
	            success: function(data){
	            	aPosition['lat'] = parseFloat(data.lat);
	            	aPosition['lon'] = parseFloat(data.lon);
					gmap = new google.maps.Map(document.getElementById('minimap'),{
							zoom: 10,
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							center: new google.maps.LatLng(aPosition['lat'],aPosition['lon'])
					});
						
					$lieux.each(function(){
						var $coords = $(this).attr('data-position').split(',');
						aMarker[$(this).attr('data-title')] = new google.maps.Marker({
							title: $(this).attr('data-title'),
							map:gmap,
							position:new google.maps.LatLng(parseFloat($coords[0]),parseFloat($coords[1]))
						});
					});
	            } // End of success function of ajax form
	        }); // End of ajax call
		}
        if($('#bigmap').length>0){
        	var origine = $('#bigmap').attr('data-position').split(',');
        	coords = $('#bigmap').attr('data-destination').split(',');
        	aPosition['lat'] = parseFloat(coords[0]);
	        aPosition['lon'] = parseFloat(coords[1]);
        	gmap = new google.maps.Map(document.getElementById('bigmap'),{
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				center: new google.maps.LatLng(aPosition['lat'],aPosition['lon'])
			});/*
			new google.maps.Marker({
				map:gmap,
				position:new google.maps.LatLng(aPosition['lat'],aPosition['lon'])
			});*/
			var direction = new google.maps.DirectionsRenderer({
			    map   : gmap
			});
			var request = {
	            origin      : new google.maps.LatLng(parseFloat(origine[0]),parseFloat(origine[1])),
	            destination : new google.maps.LatLng(aPosition['lat'],aPosition['lon']),
	            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Type de transport
	        }
	        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
	        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
	            if(status == google.maps.DirectionsStatus.OK){
	                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
	            }
	        });
        }
	};
	
	//Ajout des marqueurs
	var addMarker = function($lieux){
			var options = {
      			strokeColor: "#f7931e",
      			strokeOpacity: 0.8,
      			strokeWeight: 2,
      			fillColor: "#f7931e",
      			fillOpacity: 0.35,
      			map: gmap,
				center: new google.maps.LatLng(50,5),
      			radius: 10000
    		};
    		//cityCircle = new google.maps.Circle(options);
	}; //addMarker
	
	//Modification lors d'un click
	var centrer = function($info){
		
		
		//Recuperation des coords
		var $point = $info.parent().parent().attr('data-position').split(',');
		aMarker[$info.parent().parent().attr('data-title')].setAnimation(google.maps.Animation.BOUNCE);
		setTimeout(function(){ aMarker[$info.parent().parent().attr('data-title')].setAnimation(null); }, 2000);
		//Mise a jour de la carte
		//gmap.setZoom(16);

		gmap.panTo(new google.maps.LatLng($point[0],$point[1]));
	}; //centrer
	
	var popup = function(e){
		e.preventDefault();
		/*$.ajax({
	        url: $(this).attr('href'),
	        type:'POST',
		    success: function(data){
		    	$('#overlay').show().on('click',function(){
		    		$('#popup').hide().remove();
		    		$(this).fadeOut();
		    	});
		    	var reg = new RegExp('popup">(.*)');
		    	$view = data.match(reg);
		    	console.log(data);
		       	$('body').append(data)
		       	$('#popup').draggable();
			}
		});*/
		$('#overlay').show().on('click',function(){
    		$('#ajouter,#localiser').hide();
    		$(this).fadeOut();
    	});
		if($(this).attr('class').match('ajouter')){
			var date = new Date();
			$('#ajouter').show()
				.find('#lieu').val($(this).parent().attr('data-info'))
				.end()
				.find('#date_deb,#date_fin').val(date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear())
				.end()
				.find('#heure_deb').val(date.getHours()+':'+(Math.floor(date.getMinutes()/5)*5).toString().substr('00',2))
				.end()
				.find('#heure_fin').val((date.getHours()+1)+':'+(Math.floor(date.getMinutes()/5)*5).toString().substr('00',2))
				.end()
				.find('#id_lieu').val($(this).parent().attr('data-id'));
		}
		if($(this).attr('class').match('localiser')){
			$('#localiser').show();
		    $('.localisation input[type="submit"]').on('click',localiser);
		}
	}
	
	
	$(function(){
		
		
		$('.localisation input[type="submit"],.ajout_lieu input[type="submit"]').on('click',localiser);
		$lieux = $('div.sortie');
		$('.localiser,.ajouter').on('click',popup);
		//Ajout de l'ecouteur d'evenement
		$lieux.find('i').on('click',function(){
			centrer($(this),0);
		});
		generateMap();
		addMarker($lieux);
		//On lance le traitement
		//window.onpopstate = historyHasChanged;
		
		//$('.ajouter').first().trigger('click');
		
	});

})(jQuery);