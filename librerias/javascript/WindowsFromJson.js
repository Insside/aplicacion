/*

Script: WindowsFrom-Json.js
	Create one or more windows from JSON data. You can define all the same properties as you can for new MUI.Window(). Undefined properties are set to their defaults.

Copyright:
	Copyright (c) 20010-2020 Jose Alexis Correa Valencia , <http://www.insside.com/>.	

License:
	MIT-style license.	

Syntax:
	(start code)
	MUI.newWindowsFromJSON(properties);
	(end)

Example:
	(start code)
	MUI.jsonWindows = function(){
		var url = 'data/json-windows-data.js';
		var request =new Request.JSON({
			url: url,
			method: 'get',
			onComplete: function(properties) {
				MUI.newWindowsFromJSON(properties.windows);
			}
		}).send();
	}
	(end)

Note: 
	Windows created from JSON are not compatible with the current cookie based version
	of Save and Load Workspace.  	

See Also:
	<Window>
        
    Changes from Mootools 1.2 to 1.4.x  , 2013 no compat <http://www.domenacom.hr/>
    darko.hajnal@domenacom.hr 

*/

MUI.files[MUI.path.source + 'Window/Windows-from-json.js'] = 'loaded';

//MUI.extend({
Object.append(MUI, { 
        newWindowsFromJSON: function(newWindows){
		newWindows.each(function(options) {
			var temp =new Hash(options);
			temp.each( function(value, key, hash) {
				//if ($type(value) != 'string') return;
                                if (typeOf(value) != 'string') return;
                                
				if (value.substring(0,8) == 'function'){
					eval("options." + key + " = " + value);
				}
			});			
			new MUI.Window(options);
		});
	}
});

