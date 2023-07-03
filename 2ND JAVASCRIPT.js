




let n=100;
 lat= 38.2453034;
 lng= 21.7368943;

const corsProxy = 'https://cors-anywhere.herokuapp.com/';
    const overpassUrl = corsProxy + 'https://overpass-api.de/api/interpreter';

/*-------------- XARTHS GLOBAL EMFANISI*/
    const map = L.map('map').fitWorld();

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map) ;
    fetchMarkers();
   
/*-- TELOS EMFANISIS GLOBAL XARTH*/


/* FUNCTION GIA TOPOTHESIA XRHSTH*/
    function onLocationFound(e){
        const radius = e.accuracy / 2;
       /* const lat=e.latlng.lat;
        const lng=e.latlng.lng;*/


    
        const locationMarker = L.marker(e.latlng, {draggable: false}).addTo(map)
        console.log(e.latlng);
        locationMarker.bindPopup("<b>Η τοποθεσία σας</b>");
    
        const locationCircle = L.circle(e.latlng, 50).addTo(map);

 

    /* ---- BRISKEI TOPOTHESIA XRHSTH*/
        if ("geolocation" in navigator) {
           /* navigator.geolocation.getCurrentPosition(function(position) {

                lat = position.coords.latitude;
                lon = position.coords.longitude;*/
            let url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let city = data.address.city;
                    let state = data.address.state;
                    let country = data.address.country;
                    document.getElementById("city").innerHTML = `${city}, ${state}, ${country}`;
                    fetchMarkers();
                }) 
                .catch(error => console.log(error));
              }else {
            console.log("Geolocation not supported by this browser.");
        }
      }
        //onLocationFoundYES();
        /*----TELOS BRISKOMATOS TOPOTHESIAS*/
      
      
    function onLocationError(e) {
      alert.message;
    }
  
    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);
  
    map.locate({setView: true, maxZoom: 16, enableHighAccuracy: true});/* LOCATE THN TOPOTHESIA TOU XRHSTH*/

   
    /*PROSTHIKI GIA MARKERS*/
    function fetchMarkers() {
        
        // OSM data query for supermarkets in Patras
       // const query = '[out:json][timeout:25];area(3602182851)->.searchArea;(node["shop"~"supermarket|convenience"](area.searchArea););out;>;out skel qt';
        const query = `[out:json][timeout:25];area(3602182851)->.searchArea;(node["shop"~"supermarket|convenience"](area.searchArea););out;>;out skel qt;
  node(around:${n},${lat},${lng})["emergency"="defibrillator"];out body;`;
        // Send request to Overpass API
        fetch(overpassUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `data=${query}`
        })
        .then(response => response.json())
        .then(data => {
            const storeArr = data.elements;
            // Create markers for each store
                storeArr.forEach(store => {
                    if (store.type === "node" && store.tags.shop === "supermarket") {
                        const marker = L.marker([store.lat, store.lon]);
                        marker.bindPopup(`${store.tags.name}`);
                        markersLayer.addLayer(marker); // add to markersLayer
                        marker.addTo(map); // add to map
                    } else if (store.type === "node" && store.tags.emergency === "defibrillator") {
                        const marker = L.marker([store.lat, store.lon], {icon: defibrillatorIcon});
                        marker.bindPopup("Defibrillator");
                        markersLayer.addLayer(marker); // add to markersLayer
                        marker.addTo(map); // add to map
                    }
                });
        })
        .catch(error => console.log(error));
    }
    
/*------ PROSTHIKI GIA MARKERS*/
/*---PINAKAS ANAZHTHSHS*/
let markersLayer = L.layerGroup(); //layer contain searched elements

    markersLayer.addTo(map);
    let controlSearch = new L.Control.Search({
      position: "topright",
      layer: markersLayer,
      propertyName: "title",
      initial: false,
      zoom: 20,
      marker: false
    });
    
    map.addControl(controlSearch);
    
    /*for (i in data) {
      let title = data[i].title;
      let loc = data[i].loc;
      let marker = L.marker(L.latLng(loc), { title: title });
      marker.bindPopup("title: " + title);
      marker.addTo(markersLayer);
    }*/




    /* TA DATA GIA TO SEARCHHHHH!!!!!!!!!!!!!!!!!!!!!!!!!PARADEIGMA*/
    /*let data = [
        { loc: [38.2466877, 21.7352181], title: "Zizu" },
        { loc: [38.2506268, 21.732408], title: "Molos Cafe" },
        { loc: [38.2466265, 21.7376341], title: "coffeebrands" }
      ];
      */