<!DOCTYPE html>
<html>
  <head>

  </head>
  <body>
    <h1>Map Look-up</h1>
    <h4>Enter an address below to find it on the map:</h4>
    <input type="text" id="place" name="place">
    <button onclick="findPlace()">Search</button>
    <br><br>
    <div id="map"></div>
    <p> <a href="https://github.com/showmaker0/cp2">Github repoistory</a> </p>

    <script>
    var map, searchManager;

    function findPlace() {
      var place = document.getElementById("place").value;
      geocodeQuery(place);
    }

    function GetMap(place) {
        document.getElementById("map").style ="position:relative;width:600px;height:400px;"
        map = new Microsoft.Maps.Map('#map', {
            credentials: 'Atn3TLqF4jxVBfIIpaun5EM05I1_ZCUQLy2eQCL3pqgcAgVg7Ge-kYzis8ReSfuJ'
        });

        //Make a request
    }

    function geocodeQuery(query) {
        //If search manager is not defined, load the search module.
        if (!searchManager) {
            //Create an instance of the search manager and call the geocodeQuery function again.
            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
                searchManager = new Microsoft.Maps.Search.SearchManager(map);
                geocodeQuery(query);
            });
        } else {
            var searchRequest = {
                where: query,
                callback: function (r) {
                    //Add the first result to the map and zoom into it.
                    if (r && r.results && r.results.length > 0) {
                        var pin = new Microsoft.Maps.Pushpin(r.results[0].location);
                        map.entities.push(pin);

                        map.setView({ bounds: r.results[0].bestView });
                    }
                },
                errorCallback: function (e) {
                    //If there is an error, alert the user about it.
                    //alert("No results found.");
                }
            };

            //Make the geocode request.
            searchManager.geocode(searchRequest);
        }
    }
    </script>
    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
  </body>
</html>
