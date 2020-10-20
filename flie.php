<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <title>Store Locator</title>
    <meta name='robots' content='noindex, nofollow'>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet'>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    <style>
      body {
        color:#404040;
        font:400 15px/22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
        margin:0;
        padding:0;
        -webkit-font-smoothing:antialiased;
      }
     

      * {
        -webkit-box-sizing:border-box;
        -moz-box-sizing:border-box;
        box-sizing:border-box;
      }

      .sidebar {
        position:absolute;
        width:33.3333%;
        height:100%;
        top:0;left:0;
        overflow:hidden;
        border-right:1px solid rgba(0,0,0,0.25);
      }
      .pad2 {
        padding:20px;
      }

      .map {
        position:absolute;
        left:33.3333%;
        width:66.6666%;
        top:0;bottom:0;
      }

      h1 {
        font-size:22px;
        margin:0;
        font-weight:400;
        line-height: 20px;
        padding: 20px 2px;
      }

      a {
        color:#404040;
        text-decoration:none;
      }

      a:hover {
        color:#101010;
      }

      .heading {
        background:#fff;
        border-bottom:1px solid #eee;
        min-height:60px;
        line-height:60px;
        padding:0 10px;
        background-color: #00853e;
        color: #fff;
      }

      .listings {
        height:100%;
        overflow:auto;
        padding-bottom:60px;
      }

      .listings .item {
        display:block;
        border-bottom:1px solid #eee;
        padding:10px;
        text-decoration:none;
      }

      .listings .item:last-child { border-bottom:none; }
      .listings .item .title {
        display:block;
        color:#00853e;
        font-weight:700;
      }

      .listings .item .title small { font-weight:400; }
      .listings .item.active .title,
      .listings .item .title:hover { color:#8cc63f; }
      .listings .item.active {
        background-color:#f8f8f8;
      }
      ::-webkit-scrollbar {
        width:3px;
        height:3px;
        border-left:0;
        background:rgba(0,0,0,0.1);
      }
      ::-webkit-scrollbar-track {
        background:none;
      }
      ::-webkit-scrollbar-thumb {
        background:#00853e;
        border-radius:0;
      }

      .marker {
        border: none;
        cursor: pointer;
        height: 56px;
        width: 56px;
        background-image: url(marker.png);
        background-color: rgba(0, 0, 0, 0);
      }

      .clearfix { display:block; }
      .clearfix:after {
        content:'.';
        display:block;
        height:0;
        clear:both;
        visibility:hidden;
      }

      /* Marker tweaks */
      .mapboxgl-popup {
        padding-bottom: 50px;
      }

      .mapboxgl-popup-close-button {
        display:none;
      }
      .mapboxgl-popup-content {
        font:400 15px/22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
        padding:0;
        width:180px;
      }
      .mapboxgl-popup-content-wrapper {
        padding:1%;
      }
      .mapboxgl-popup-content h3 {
        background:#91c949;
        color:#fff;
        margin:0;
        display:block;
        padding:10px;
        border-radius:3px 3px 0 0;
        font-weight:700;
        margin-top:-15px;
      }

      .mapboxgl-popup-content h4 {
        margin:0;
        display:block;
        padding: 10px 10px 10px 10px;
        font-weight:400;
      }

      .mapboxgl-popup-content div {
        padding:10px;
      }

      .mapboxgl-container .leaflet-marker-icon {
        cursor:pointer;
      }

      .mapboxgl-popup-anchor-top > .mapboxgl-popup-content {
        margin-top: 15px;
      }

      .mapboxgl-popup-anchor-top > .mapboxgl-popup-tip {
        border-bottom-color: #91c949;
      }
      .mydivs{
        
      }
       #listingall{
        display: none;
      } 
    </style>
  </head>
  <body>
    <div class='sidebar'>
      <div class='heading'>
        <h1>Our locations</h1>
      </div>
      <div id='listings' class='listings'>
        <input type="text" class="mydivs" id="mydiv_0" rel="0">
        <button id="mybtn">Button</button> 
        <div id="listingall"></div>
      </div>
    </div>
    <div id='map' class='map'></div>
    <script>
      // This will let you use the .remove() function later on
      if (!('remove' in Element.prototype)) {
        Element.prototype.remove = function() {
          if (this.parentNode) {
              this.parentNode.removeChild(this);
          }
        };
      }

      mapboxgl.accessToken = 'pk.eyJ1Ijoic2h1YmhhbXJhdHVyaSIsImEiOiJja2Yza2twZGQwNDFzMnFueWc1Y3F2d2Q2In0.t_UKTJtng_YZhdXAZ44dHQ';
      /** 
       * Add the map to the page
      */
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: [-77.034084142948, 38.909671288923],
        zoom: 13,
        scrollZoom: false
      });

      var stores = {
        "type": "FeatureCollection",
        "features": [
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.034084142948,
                38.909671288923
              ]
            },
            "properties": {
              "phoneFormatted": "(202) 234-7336",
              "phone": "2022347336",
              "address": "1471 P St NW",
              "city": "Washington DC",
              "country": "United States",
              "crossStreet": "at 15th St NW",
              "postalCode": "20005",
              "state": "D.C."
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.049766,
                38.900772
              ]
            },
            "properties": {
              "phoneFormatted": "(202) 507-8357",
              "phone": "2025078357",
              "address": "2221 I St NW",
              "city": "Washington DC",
              "country": "United States",
              "crossStreet": "at 22nd St NW",
              "postalCode": "20037",
              "state": "D.C."
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.043929,
                38.910525
              ]
            },
            "properties": {
              "phoneFormatted": "(202) 387-9338",
              "phone": "2023879338",
              "address": "1512 Connecticut Ave NW",
              "city": "Washington DC",
              "country": "United States",
              "crossStreet": "at Dupont Circle",
              "postalCode": "20036",
              "state": "D.C."
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.0672,
                38.90516896
              ]
            },
            "properties": {
              "phoneFormatted": "(202) 337-9338",
              "phone": "2023379338",
              "address": "3333 M St NW",
              "city": "Washington DC",
              "country": "United States",
              "crossStreet": "at 34th St NW",
              "postalCode": "20007",
              "state": "D.C."
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.002583742142,
                38.887041080933
              ]
            },
            "properties": {
              "phoneFormatted": "(202) 547-9338",
              "phone": "2025479338",
              "address": "221 Pennsylvania Ave SE",
              "city": "Washington DC",
              "country": "United States",
              "crossStreet": "btwn 2nd & 3rd Sts. SE",
              "postalCode": "20003",
              "state": "D.C."
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -76.933492720127,
                38.99225245786
              ]
            },
            "properties": {
              "address": "8204 Baltimore Ave",
              "city": "College Park",
              "country": "United States",
              "postalCode": "20740",
              "state": "MD"
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.097083330154,
                38.980979
              ]
            },
            "properties": {
              "phoneFormatted": "(301) 654-7336",
              "phone": "3016547336",
              "address": "4831 Bethesda Ave",
              "cc": "US",
              "city": "Bethesda",
              "country": "United States",
              "postalCode": "20814",
              "state": "MD"
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.359425054188,
                38.958058116661
              ]
            },
            "properties": {
              "phoneFormatted": "(571) 203-0082",
              "phone": "5712030082",
              "address": "11935 Democracy Dr",
              "city": "Reston",
              "country": "United States",
              "crossStreet": "btw Explorer & Library",
              "postalCode": "20190",
              "state": "VA"
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.10853099823,
                38.880100922392
              ]
            },
            "properties": {
              "phoneFormatted": "(703) 522-2016",
              "phone": "7035222016",
              "address": "4075 Wilson Blvd",
              "city": "Arlington",
              "country": "United States",
              "crossStreet": "at N Randolph St.",
              "postalCode": "22203",
              "state": "VA"
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -75.28784,
                40.008008
              ]
            },
            "properties": {
              "phoneFormatted": "(610) 642-9400",
              "phone": "6106429400",
              "address": "68 Coulter Ave",
              "city": "Ardmore",
              "country": "United States",
              "postalCode": "19003",
              "state": "PA"
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -75.20121216774,
                39.954030175164
              ]
            },
            "properties": {
              "phoneFormatted": "(215) 386-1365",
              "phone": "2153861365",
              "address": "3925 Walnut St",
              "city": "Philadelphia",
              "country": "United States",
              "postalCode": "19104",
              "state": "PA"
            }
          },
          {
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [
                -77.043959498405,
                38.903883387232
              ]
            },
            "properties": {
              "phoneFormatted": "(202) 331-3355",
              "phone": "2023313355",
              "address": "1901 L St. NW",
              "city": "Washington DC",
              "country": "United States",
              "crossStreet": "at 19th St",
              "postalCode": "20036",
              "state": "D.C."
            }
          }
        ]
      };
      
      /**
       * Assign a unique id to each store. You'll use this `id`
       * later to associate each point on the map with a listing
       * in the sidebar.
      */
      stores.features.forEach(function(store, i){
        store.properties.id = i;
      });

      /**
       * Wait until the map loads to make changes to the map.
      */
      map.on('load', function (e) {
        /** 
         * This is where your '.addLayer()' used to be, instead
         * add only the source without styling a layer
        */
        map.addSource("places", {
          "type": "geojson",
          "data": stores
        });

        /**
         * Add all the things to the page:
         * - The location listings on the side of the page
         * - The markers onto the map
        */
        buildLocationList(stores);
        addMarkers();
      });

      /**
       * Add a marker to the map for every store listing.
      **/
      function addMarkers() {
        /* For each feature in the GeoJSON object above: */
        stores.features.forEach(function(marker) {
          /* Create a div element for the marker. */
          var el = document.createElement('div');
          /* Assign a unique `id` to the marker. */
          el.id = "marker-" + marker.properties.id;
          /* Assign the `marker` class to each marker for styling. */
          el.className = 'marker';
          
          /**
           * Create a marker using the div element
           * defined above and add it to the map.
          **/
          new mapboxgl.Marker(el, { offset: [0, -23] })
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);

          /**
           * Listen to the element and when it is clicked, do three things:
           * 1. Fly to the point
           * 2. Close all other popups and display popup for clicked store
           * 3. Highlight listing in sidebar (and remove highlight for all other listings)
          **/
          el.addEventListener('click', function(e){
            /* Fly to the point */
            flyToStore(marker);
            /* Close all other popups and display popup for clicked store */
            createPopUp(marker);
            /* Highlight listing in sidebar */
            var activeItem = document.getElementsByClassName('active');
            e.stopPropagation();
            if (activeItem[0]) {
              activeItem[0].classList.remove('active');
            }
            var listing = document.getElementById('listing-' + marker.properties.id);
            listing.classList.add('active');
          });
        });
      }

      /**
       * Add a listing for each store to the sidebar.
      **/
      var n = 1;
     $("#mybtn").click(function(){
     $("#listings").append("<input type='text' class='mydivs' id='mydiv_"+n+"' rel='"+n+"'>");
      n++;
      $(".mydivs").keyup(function(){
          $("#listingall").show();
         
        var rel = $(this).attr("rel");
     
          var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("mydiv_"+rel);
    filter = input.value.toUpperCase();
    ul = document.getElementById("listing-11");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
        })
     })
      function buildLocationList(data) {
      
      
          var listings = document.getElementById('listingall');
          var listing = listings.appendChild(document.createElement('div'));
        data.features.forEach(function(store, i){
          /**
           * Create a shortcut for `store.properties`,
           * which will be used several times below.
          **/

          var prop = store.properties;
       
          /* Add a new listing section to the sidebar. */
          //var listings = document.getElementById('listings');
          //var listing = listings.appendChild(document.createElement('div'));
          /* Assign a unique `id` to the listing. */
          listing.id = "listing-" + prop.id;
          /* Assign the `item` class to each listing for styling. */
          listing.className = 'item';
         

          /* Add the link to the individual listing created above. */
          
          var link = listing.appendChild(document.createElement('li'));
          var link = link.appendChild(document.createElement('a'));
          link.href = '#';
          link.className = 'title';
          link.id = "link-" + prop.id;
          link.innerHTML = prop.address;

          /* Add details to the individual listing. */
          var details = link.appendChild(document.createElement('div'));
          details.innerHTML = prop.city;
          if (prop.phone) {
            details.innerHTML += ' · ' + prop.phoneFormatted;
          }

          /**
           * Listen to the element and when it is clicked, do four things:
           * 1. Update the `currentFeature` to the store associated with the clicked link
           * 2. Fly to the point
           * 3. Close all other popups and display popup for clicked store
           * 4. Highlight listing in sidebar (and remove highlight for all other listings)
          **/
          link.addEventListener('click', function(e){
           
            for (var i=0; i < data.features.length; i++) {
              if (this.id === "link-" + data.features[i].properties.id) {
                var clickedListing = data.features[i];
                flyToStore(clickedListing);
                createPopUp(clickedListing);
              }
            }
            var activeItem = document.getElementsByClassName('active');
            if (activeItem[0]) {
              activeItem[0].classList.remove('active');
            }
            this.parentNode.classList.add('active');
             $("#listingall").hide(); 
          });
        });
       
      }
      
    

      /**
       * Use Mapbox GL JS's `flyTo` to move the camera smoothly
       * a given center point.
      **/
      function flyToStore(currentFeature) {
        map.flyTo({
          center: currentFeature.geometry.coordinates,
          zoom: 15
        });
      }

      /**
       * Create a Mapbox GL JS `Popup`.
      **/
      function createPopUp(currentFeature) {
        var popUps = document.getElementsByClassName('mapboxgl-popup');
        if (popUps[0]) popUps[0].remove();
        var popup = new mapboxgl.Popup({closeOnClick: false})
          .setLngLat(currentFeature.geometry.coordinates)
          .setHTML('<h3>Sweetgreen</h3>' +
            '<h4>' + currentFeature.properties.address + '</h4>')
          .addTo(map);
      }
    </script>
  </body>
</html>