<!DOCTYPE html>
<html>
  <head>

  </head>
  <body>
    <div id="map"></div>
    <button onclick="GetMap('2122 E 3735 S, Salt Lake City, UT 84109')">Search</button>

    <script>
    var map, searchManager;

    function GetMap() {
        document.getElementById("map").style ="position:relative;width:600px;height:400px;"
        map = new Microsoft.Maps.Map('#map', {
            credentials: 'Atn3TLqF4jxVBfIIpaun5EM05I1_ZCUQLy2eQCL3pqgcAgVg7Ge-kYzis8ReSfuJ'
        });

        //Make a request
        geocodeQuery("2122 E 3735 S, Salt Lake City, UT 84109");
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
                    alert("No results found.");
                }
            };

            //Make the geocode request.
            searchManager.geocode(searchRequest);
        }
    }
    </script>
    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol' async defer></script>
  </body>
</html>
