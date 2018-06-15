var flagserver = require('http').connect('192.168.0.14');
var flag = null;
flagserver.on('gimme flag', function(flagObject) {
  flag = flagObject
});
var instance = require('http').connect('192.34.55.391:4833');
instance.emit({
  type: 'connect',
  payload: flag
});
