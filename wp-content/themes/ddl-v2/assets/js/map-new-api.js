
let map;

async function initMap() {

	if (document.getElementById('mapCanvas')){

		const style = [
				{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
								{
										"color": "#e9e9e9"
								},
								{
										"lightness": 17
								}
						]
				},
				{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
								{
										"color": "#f5f5f5"
								},
								{
										"lightness": 20
								}
						]
				},
				{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
								{
										"color": "#ffffff"
								},
								{
										"lightness": 17
								}
						]
				},
				{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
								{
										"color": "#ffffff"
								},
								{
										"lightness": 29
								},
								{
										"weight": 0.2
								}
						]
				},
				{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
								{
										"color": "#ffffff"
								},
								{
										"lightness": 18
								}
						]
				},
				{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
								{
										"color": "#ffffff"
								},
								{
										"lightness": 16
								}
						]
				},
				{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
								{
										"color": "#f5f5f5"
								},
								{
										"lightness": 21
								}
						]
				},
				{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
								{
										"color": "#dedede"
								},
								{
										"lightness": 21
								}
						]
				},
				{
						"elementType": "labels.text.stroke",
						"stylers": [
								{
										"visibility": "on"
								},
								{
										"color": "#ffffff"
								},
								{
										"lightness": 16
								}
						]
				},
				{
						"elementType": "labels.text.fill",
						"stylers": [
								{
										"saturation": 36
								},
								{
										"color": "#333333"
								},
								{
										"lightness": 40
								}
						]
				},
				{
						"elementType": "labels.icon",
						"stylers": [
								{
										"visibility": "off"
								}
						]
				},
				{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
								{
										"color": "#f2f2f2"
								},
								{
										"lightness": 19
								}
						]
				},
				{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
								{
										"color": "#fefefe"
								},
								{
										"lightness": 20
								}
						]
				},
				{
						"featureType": "administrative",
						"elementType": "geometry.stroke",
						"stylers": [
								{
										"color": "#fefefe"
								},
								{
										"lightness": 17
								},
								{
										"weight": 1.2
								}
						]
				}
		]

		const { Map } = await google.maps.importLibrary("maps");
		const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

		const location = { lat: 51.602075068056095, lng: -0.2694844932528599 };

		const map = new Map(document.getElementById('mapCanvas'), {
			zoom: 16,
			center: location,
			// styles: style,
			zoomControl: false,
			disableDoubleClickZoom: false,
			mapTypeControl: false,
			scaleControl: true,
			scrollwheel: false,
			panControl: true,
			streetViewControl: false,
			draggable : true,
			overviewMapControl: true,
			overviewMapControlOptions: {
				opened: true,
			},
			mapId: "30cf991c31e043"
		});

		const icon = document.createElement("img");

		icon.src = "https://dev.dental-design-clients.co.uk/podiatry-station/wp-content/themes/podiatry-station/assets/img/marker.png";

		const marker = new AdvancedMarkerElement({
			map,
			position: location,
			content: icon,
		});

	}

}

initMap();