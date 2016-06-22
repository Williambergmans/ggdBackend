@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script>
    /*! jquery-locationpicker - v0.1.13 - 2016-03-11 */
    (function ($) {
        function GMapContext(domElement, options) {
            var _map = new google.maps.Map(domElement, options);
            var _marker = new google.maps.Marker({
                position: new google.maps.LatLng(51.4388648, 5.4732070),
                map: _map,
                title: "Drag Me",
                draggable: options.draggable,
                icon: options.markerIcon !== undefined ? options.markerIcon : undefined
            });
            return {
                map: _map,
                marker: _marker,
                circle: null,
                location: _marker.position,
                radius: options.radius,
                locationName: options.locationName,
                addressComponents: {
                    formatted_address: null,
                    addressLine1: null,
                    addressLine2: null,
                    streetName: null,
                    streetNumber: null,
                    city: null,
                    district: null,
                    state: null,
                    stateOrProvince: null
                },
                settings: options.settings,
                domContainer: domElement,
                geodecoder: new google.maps.Geocoder()
            };
        }
        var GmUtility = {
            drawCircle: function (gmapContext, center, radius, options) {
                if (gmapContext.circle != null) {
                    gmapContext.circle.setMap(null);
                }
                if (radius > 0) {
                    radius *= 1;
                    options = $.extend({
                        strokeColor: "#0000FF",
                        strokeOpacity: .35,
                        strokeWeight: 2,
                        fillColor: "#0000FF",
                        fillOpacity: .2
                    }, options);
                    options.map = gmapContext.map;
                    options.radius = radius;
                    options.center = center;
                    gmapContext.circle = new google.maps.Circle(options);
                    return gmapContext.circle;
                }
                return null;
            },
            setPosition: function (gMapContext, location, callback) {
                gMapContext.location = location;
                gMapContext.marker.setPosition(location);
                gMapContext.map.panTo(location);
                this.drawCircle(gMapContext, location, gMapContext.radius, {});
                if (gMapContext.settings.enableReverseGeocode) {
                    gMapContext.geodecoder.geocode({
                        latLng: gMapContext.location
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK && results.length > 0) {
                            gMapContext.locationName = results[0].formatted_address;
                            gMapContext.addressComponents = GmUtility.address_component_from_google_geocode(results[0].address_components);
                        }
                        if (callback) {
                            callback.call(this, gMapContext);
                        }
                    });
                } else {
                    if (callback) {
                        callback.call(this, gMapContext);
                    }
                }
            },
            locationFromLatLng: function (lnlg) {
                return {
                    latitude: lnlg.lat(),
                    longitude: lnlg.lng()
                };
            },
            address_component_from_google_geocode: function (address_components) {
                var result = {};
                for (var i = address_components.length - 1; i >= 0; i--) {
                    var component = address_components[i];
                    if (component.types.indexOf("postal_code") >= 0) {
                        result.postalCode = component.short_name;
                    } else if (component.types.indexOf("street_number") >= 0) {
                        result.streetNumber = component.short_name;
                    } else if (component.types.indexOf("route") >= 0) {
                        result.streetName = component.short_name;
                    } else if (component.types.indexOf("locality") >= 0) {
                        result.city = component.short_name;
                    } else if (component.types.indexOf("sublocality") >= 0) {
                        result.district = component.short_name;
                    } else if (component.types.indexOf("administrative_area_level_1") >= 0) {
                        result.stateOrProvince = component.short_name;
                    } else if (component.types.indexOf("country") >= 0) {
                        result.country = component.short_name;
                    }
                }
                result.addressLine1 = [result.streetNumber, result.streetName].join(" ").trim();
                result.addressLine2 = "";
                return result;
            }
        };
        function isPluginApplied(domObj) {
            return getContextForElement(domObj) != undefined;
        }
        function getContextForElement(domObj) {
            return $(domObj).data("locationpicker");
        }
        function updateInputValues(inputBinding, gmapContext) {
            if (!inputBinding)
                return;
            var currentLocation = GmUtility.locationFromLatLng(gmapContext.location);
            if (inputBinding.latitudeInput) {
                inputBinding.latitudeInput.val(currentLocation.latitude).change();
            }
            if (inputBinding.longitudeInput) {
                inputBinding.longitudeInput.val(currentLocation.longitude).change();
            }
            if (inputBinding.radiusInput) {
                inputBinding.radiusInput.val(gmapContext.radius).change();
            }
            if (inputBinding.locationNameInput) {
                inputBinding.locationNameInput.val(gmapContext.locationName).change();
            }
        }
        function setupInputListenersInput(inputBinding, gmapContext) {
            if (inputBinding) {
                if (inputBinding.radiusInput) {
                    inputBinding.radiusInput.on("change", function (e) {
                        if (!e.originalEvent) {
                            return;
                        }
                        gmapContext.radius = $(this).val();
                        GmUtility.setPosition(gmapContext, gmapContext.location, function (context) {
                            context.settings.onchanged.apply(gmapContext.domContainer, [GmUtility.locationFromLatLng(context.location), context.radius, false]);
                        });
                    });
                }
                if (inputBinding.locationNameInput && gmapContext.settings.enableAutocomplete) {
                    var blur = false;
                    gmapContext.autocomplete = new google.maps.places.Autocomplete(inputBinding.locationNameInput.get(0));
                    google.maps.event.addListener(gmapContext.autocomplete, "place_changed", function () {
                        blur = false;
                        var place = gmapContext.autocomplete.getPlace();
                        if (!place.geometry) {
                            gmapContext.settings.onlocationnotfound(place.name);
                            return;
                        }
                        GmUtility.setPosition(gmapContext, place.geometry.location, function (context) {
                            updateInputValues(inputBinding, context);
                            context.settings.onchanged.apply(gmapContext.domContainer, [GmUtility.locationFromLatLng(context.location), context.radius, false]);
                        });
                    });
                    if (gmapContext.settings.enableAutocompleteBlur) {
                        inputBinding.locationNameInput.on("change", function (e) {
                            if (!e.originalEvent) {
                                return;
                            }
                            blur = true;
                        });
                        inputBinding.locationNameInput.on("blur", function (e) {
                            if (!e.originalEvent) {
                                return;
                            }
                            setTimeout(function () {
                                var address = $(inputBinding.locationNameInput).val();
                                if (address.length > 5 && blur) {
                                    blur = false;
                                    gmapContext.geodecoder.geocode({
                                        address: address
                                    }, function (results, status) {
                                        if (status == google.maps.GeocoderStatus.OK && results && results.length) {
                                            GmUtility.setPosition(gmapContext, results[0].geometry.location, function (context) {
                                                updateInputValues(inputBinding, context);
                                                context.settings.onchanged.apply(gmapContext.domContainer, [GmUtility.locationFromLatLng(context.location), context.radius, false]);
                                            });
                                        }
                                    });
                                }
                            }, 1e3);
                        });
                    }
                }
                if (inputBinding.latitudeInput) {
                    inputBinding.latitudeInput.on("change", function (e) {
                        if (!e.originalEvent) {
                            return;
                        }
                        GmUtility.setPosition(gmapContext, new google.maps.LatLng($(this).val(), gmapContext.location.lng()), function (context) {
                            context.settings.onchanged.apply(gmapContext.domContainer, [GmUtility.locationFromLatLng(context.location), context.radius, false]);
                        });
                    });
                }
                if (inputBinding.longitudeInput) {
                    inputBinding.longitudeInput.on("change", function (e) {
                        if (!e.originalEvent) {
                            return;
                        }
                        GmUtility.setPosition(gmapContext, new google.maps.LatLng(gmapContext.location.lat(), $(this).val()), function (context) {
                            context.settings.onchanged.apply(gmapContext.domContainer, [GmUtility.locationFromLatLng(context.location), context.radius, false]);
                        });
                    });
                }
            }
        }
        function autosize(gmapContext) {
            google.maps.event.trigger(gmapContext.map, "resize");
            setTimeout(function () {
                gmapContext.map.setCenter(gmapContext.marker.position);
            }, 300);
        }
        function updateMap(gmapContext, $target, options) {
            var settings = $.extend({}, $.fn.locationpicker.defaults, options), latNew = settings.location.latitude, lngNew = settings.location.longitude, radiusNew = settings.radius, latOld = gmapContext.settings.location.latitude, lngOld = gmapContext.settings.location.longitude, radiusOld = gmapContext.settings.radius;
            if (latNew == latOld && lngNew == lngOld && radiusNew == radiusOld)
                return;
            gmapContext.settings.location.latitude = latNew;
            gmapContext.settings.location.longitude = lngNew;
            gmapContext.radius = radiusNew;
            GmUtility.setPosition(gmapContext, new google.maps.LatLng(gmapContext.settings.location.latitude, gmapContext.settings.location.longitude), function (context) {
                setupInputListenersInput(gmapContext.settings.inputBinding, gmapContext);
                context.settings.oninitialized($target);
            });
        }
        $.fn.locationpicker = function (options, params) {
            if (typeof options == "string") {
                var _targetDomElement = this.get(0);
                if (!isPluginApplied(_targetDomElement))
                    return;
                var gmapContext = getContextForElement(_targetDomElement);
                switch (options) {
                    case "location":
                        if (params == undefined) {
                            var location = GmUtility.locationFromLatLng(gmapContext.location);
                            location.radius = gmapContext.radius;
                            location.name = gmapContext.locationName;
                            return location;
                        } else {
                            if (params.radius) {
                                gmapContext.radius = params.radius;
                            }
                            GmUtility.setPosition(gmapContext, new google.maps.LatLng(params.latitude, params.longitude), function (gmapContext) {
                                updateInputValues(gmapContext.settings.inputBinding, gmapContext);
                            });
                        }
                        break;

                    case "subscribe":
                        if (params == undefined) {
                            return null;
                        } else {
                            var event = params.event;
                            var callback = params.callback;
                            if (!event || !callback) {
                                console.error('LocationPicker: Invalid arguments for method "subscribe"');
                                return null;
                            }
                            google.maps.event.addListener(gmapContext.map, event, callback);
                        }
                        break;

                    case "map":
                        if (params == undefined) {
                            var locationObj = GmUtility.locationFromLatLng(gmapContext.location);
                            locationObj.formattedAddress = gmapContext.locationName;
                            locationObj.addressComponents = gmapContext.addressComponents;
                            return {
                                map: gmapContext.map,
                                marker: gmapContext.marker,
                                location: locationObj
                            };
                        } else {
                            return null;
                        }

                    case "autosize":
                        autosize(gmapContext);
                        return this;
                }
                return null;
            }
            return this.each(function () {
                var $target = $(this);
                if (isPluginApplied(this)) {
                    updateMap(getContextForElement(this), $(this), options);
                    return;
                }
                var settings = $.extend({}, $.fn.locationpicker.defaults, options);
                var gmapContext = new GMapContext(this, {
                    zoom: settings.zoom,
                    center: new google.maps.LatLng(settings.location.latitude, settings.location.longitude),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    disableDoubleClickZoom: false,
                    scrollwheel: settings.scrollwheel,
                    streetViewControl: false,
                    radius: settings.radius,
                    locationName: settings.locationName,
                    settings: settings,
                    draggable: settings.draggable,
                    markerIcon: settings.markerIcon
                });
                $target.data("locationpicker", gmapContext);
                google.maps.event.addListener(gmapContext.marker, "dragend", function (event) {
                    GmUtility.setPosition(gmapContext, gmapContext.marker.position, function (context) {
                        var currentLocation = GmUtility.locationFromLatLng(gmapContext.location);
                        context.settings.onchanged.apply(gmapContext.domContainer, [currentLocation, context.radius, true]);
                        updateInputValues(gmapContext.settings.inputBinding, gmapContext);
                    });
                });
                GmUtility.setPosition(gmapContext, new google.maps.LatLng(settings.location.latitude, settings.location.longitude), function (context) {
                    updateInputValues(settings.inputBinding, gmapContext);
                    setupInputListenersInput(settings.inputBinding, gmapContext);
                    context.settings.oninitialized($target);
                });
            });
        };
        $.fn.locationpicker.defaults = {
            location: {
                latitude: 40.7324319,
                longitude: -73.82480777777776
            },
            locationName: "",
            radius: 500,
            zoom: 15,
            scrollwheel: true,
            inputBinding: {
                latitudeInput: null,
                longitudeInput: null,
                radiusInput: null,
                locationNameInput: null
            },
            enableAutocomplete: false,
            enableAutocompleteBlur: false,
            enableReverseGeocode: true,
            draggable: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {},
            onlocationnotfound: function (locationName) {},
            oninitialized: function (component) {},
            markerIcon: undefined
        };
    })(jQuery);

</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Voeg een calamiteit toe</div>
                <div class="panel-body">

                    <form action="" method="post"> 
                        <div class="form-group">
                            <label for="exampleInputName1">Titel van calamiteit</label>
                            <input type="text" class="form-control" name="titleName" placeholder="Titel van calamiteit">
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="exampleInputName2">Omschrijving van calamiteit</label>
                            <textarea name="inhoudName" placeholder="Omschrijving" class="form-control" rows="5" id="comment"></textarea> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName3">Categorie</label>
                            <select class="form-control" name ="categorieName">
                                <option value="Asbest">Asbest</option>
                                <option value="Hittegolf">Hittegolf</option>
                                <option value="InfectieZiekte">InfectieZiekte</option>
                                <option value="Overige">Overige</option> 
                            </select></div>
                        -->
                        <div class="form-group">
                            <label for="exampleInputName4">Locatie naam</label>
                            <input type="text" class="form-control" name="locatieName" placeholder="Locatie">
                        </div>
                        <label for="exampleInputName5">Datum</label>
                        <div class="form-inline">
                            <div class="form-group">
                                <select class="form-control" name ="dagName">
                                    <option value="Maandag">Maandag</option>
                                    <option value="Dinsdag">Dinsdag</option>
                                    <option value="Woendag">Woensdag</option>
                                    <option value="Donderdag">Donderdag</option>
                                    <option value="Vrijdag">Vrijdag</option>
                                    <option value="Zaterdag">Zaterdag</option>
                                    <option value="Zondag">Zondag</option> 
                                </select></div>
                            <div class="form-group">

                                <select class="form-control" name ="dagGetalName">
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option> 
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option> 
                                    <option value="09">9</option> 
                                    <option value="10">10</option> 
                                    <option value="11">11</option> 
                                    <option value="12">12</option> 
                                    <option value="13">13</option> 
                                    <option value="14">14</option> 
                                    <option value="15">15</option> 
                                    <option value="16">16</option> 
                                    <option value="17">17</option> 
                                    <option value="18">18</option> 
                                    <option value="19">19</option> 
                                    <option value="20">20</option>
                                    <option value="21">21</option> 
                                    <option value="22">22</option> 
                                    <option value="23">23</option> 
                                    <option value="24">24</option>
                                    <option value="25">25</option> 
                                    <option value="26">26</option> 
                                    <option value="27">27</option> 
                                    <option value="28">28</option> 
                                    <option value="29">29</option> 
                                    <option value="30">30</option> 
                                    <option value="31">31</option> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputName5">Maand</label>
                                <select class="form-control" name ="maandName">
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maart">Maart</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Augustus">Augustus</option> 
                                    <option value="September">September</option> 
                                    <option value="Oktober">Oktober</option> 
                                    <option value="November">November</option> 
                                    <option value="December">December</option> 
                                </select></div>  
                        </div><br>
                        <!--
                        <div class="form-group">
                            <label for="exampleInputName8">Start tijd</label>
                            <input type="text" class="form-control" name="startName" placeholder="Start">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName9">Eind tijd</label>
                            <input type="text" class="form-control" name="eindName" placeholder="Eind">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName10">Email contactpersoon</label>
                            <input type="text" class="form-control" name="emailName" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName11">Telefoonnummer</label>
                            <input type="text" class="form-control" name="phoneName" placeholder="Telefoonnummer">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName12">Wat te doen bij calamiteit</label>
                            <textarea name="omschrijvingName" placeholder="Omschrijving" class="form-control" rows="5" id="comment"></textarea>
                        </div>
                        -->
                        <div class="form-group">
                            <label for="exampleInputName15">Afbeelding Url</label>
                            <input type="text" class="form-control" name="photoName" placeholder="Afbeelding">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName16">Vraag 1</label>
                            <input type="text" class="form-control" name="vraag1Name" placeholder="vraag1Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName17">Vraag 2</label>
                            <input type="text" class="form-control" name="vraag2Name" placeholder="vraag2Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName18">Vraag 3</label>
                            <input type="text" class="form-control" name="vraag3Name" placeholder="vraag3Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName19">Vraag 4</label>
                            <input type="text" class="form-control" name="vraag4Name" placeholder="vraag4Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName20">Vraag 5</label>
                            <input type="text" class="form-control" name="vraag5Name" placeholder="vraag5Titel">
                        </div>

                        <input type="hidden" class="form-control" value="calamiteitTemplate" name="templateName">

                        <div class="form-group">
                            <label for="exampleInputName22">Map locatie:</label>
                            <input type="text" class="form-control" id="us3-address" />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName23">Radius:</label>
                            <input type="text" class="form-control" id="us3-radius" />
                        </div>

                        <div id="us3" style="width: 100%; height: 400px;"></div> 
                        <div class="clearfix">&nbsp;</div>

                        <input type="hidden" class="form-control" name="latitudeName" id="us3-lat" />

                        <input type="hidden" class="form-control" name="longitudeName" id="us3-lon" />

                        <input type="hidden" class="form-control" value="vragenlijstTemplate" id="templateName" name="templateName"> 


                        <div class="clearfix"></div>
                        <script>
                            $('#us3').locationpicker({
                                location: {
                                    latitude: 51.4388648,
                                    longitude: 5.473207000000002
                                },
                                radius: 300,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                onchanged: function (currentLocation, radius, isMarkerDropped) {
                                    // Uncomment line below to show alert on each Location Changed event
                                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                                }
                            });
                        </script>

                        <input type="hidden" class="form-control" class="form-control" name="_token" value="{{ csrf_token() }}">
                        <input type="submit"  class="btn btn-primary" value="Save">
                    </form> 

                </div>
            </div>
        </div>
    </div>

    @endsection

