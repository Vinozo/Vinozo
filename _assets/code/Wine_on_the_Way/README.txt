Welcome to the Snooth API!

'Wine on the Way' is a facebook application that uses the Snooth, Google
Maps, and Facebook APIs to search for wines and display local retailers 
(relative to the event location) where users can purchase the recommended wine!
The main purpose of this app is to help people explore the functionality of the
Snooth API.  If you don't want to set it all up you can still check out the
code and see it in action by going to http://apps.facebook.com/wineontheway/.

To get 'Wine on the Way' running on your own server you will want sign up for
various API keys from Snooth (http://api.snooth.com/register/), Google Maps
(http://code.google.com/apis/maps/signup.html), and Facebook
(http://www.facebook.com/developers/apps.php add the developer app and set up
a new application).  Use all the key information from these sites and set them
in the config file.

To set up the newly created facebook app in the developer application (look to 
facebook for more information on setup):
	Application Name: whatever name you want, ours is 'Wine on the Way'	
	Canvas Page URL: whatever name you want, ours is 'wineontheway'
	Canvas Callback URL: your server url
	Render Method: IFrame

Files Definition:
	index.php: Acts as a controller for the website, making high level
decisions
	xd_reciever.htm: an interface to the FB 'Add to profile' button
	config/facebook.conf.php: define all the configuration variables necessary,
like API keys
	func/facebook.func.php: various functions used
	htdocs/templates/: for html output
	htdocs/images/: self explanitory
	htdocs/css/: self explanitory
	htdocs/js/: javascript code which uses Google MAPs API
	lib/: contains our SnoothAPI class which interfaces to the Snooth API.
Also contains the facebook php client library
	loaders/: contains the files which were used to load all the
information from the Snooth API

MOST IMPORTANT FILES:
	SnoothAPI.lib.php: Class defined to interact with Snooth's API in a
simple understandable way.
	details-loader.php: Utilizes the SnoothAPI class to load information
specific to a facebook user's events. Psuedocode:
	SET latitude longitude information from facebook event object
	IF color is specified
		SET the query to the color specified
	SET api parameters:
		q = query
		n = number results return
		lat = latitude of the event
		lng = longitude of the event
		xp = maximum price of the wines searcheed
	EXECUTE wine search api method
	SET result of the wine search
	IF result is empty
		EXECUTE wine search again
	IF wines result is set
		FOREACH wine in results of wine search
			IF wine has an image
				SET the index to that of this wine
		IF index is not set default it to 0
		SET global 'wines_result' variable to the wine of index found
	ELSE 
		SET global 'wines_result' to 0
	SET code to the unique code of the global 'wines_result'
	RESET api parameters
	SET api parameters:
		id = code for the wine found
		i = inevntory (price information)
		lat, lng = coordinates of the facebook event
	EXECUTE wine details api method
	SET result of the wine details method
	SET wine_stores variable to that of the result's stores
	FOREACH store in wine_stores
		IF the store is local to the event
			SET global 'local_stores_for_wine' to this store
	RESET api parameters
	SET api parameters:
		lat, lng = coordinateas of the facebook event
	EXECUTE store search api method
	SET global 'stores_result' to the result of store search method
		(this 'stores_result' will disply to the user only if there
are no local stores found for wine)

Read all the documentation and our licensing agreement at http://api.snooth.com 
before using our API.
