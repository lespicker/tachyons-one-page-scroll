// Rules
var myrules = {

	// functions for panel A
	'#openA' : function(element){
		element.onclick = function(){
			var targetDiv = $('a');
			new Effect.BlindDown(targetDiv,{duration: 1});
			new Effect.Fade(this);
			Effect.Appear('closeA', {delay: 1});
		}
	},
	'#closeA' : function(element){
		element.onclick = function(){
			var targetDiv = $('a');
			new Effect.BlindUp(targetDiv,{duration: 1});
			new Effect.Fade(this); 
			Effect.Appear('openA', {delay: 1});
		}
	},
	'#close_me' : function(element){
		element.onclick = function(){
			var targetDiv = $('a');
			new Effect.BlindUp(targetDiv,{duration: 1});
			new Effect.Fade('closeA'); 
			Effect.Appear('openA', {delay: 1});
		}
	},
	
	// functions for panel B
	'#openB' : function(element){
		element.onclick = function(){
			var targetDiv = $('b');
			new Effect.BlindDown(targetDiv,{duration: 1});
			new Effect.Fade(this);
			Effect.Appear('closeB', {delay: 1});
		}
	},
	'#closeB' : function(element){
		element.onclick = function(){
			var targetDiv = $('b');
			new Effect.BlindUp(targetDiv,{duration: 1});
			new Effect.Fade(this); 
			Effect.Appear('openB', {delay: 1});
		}
	}
};

