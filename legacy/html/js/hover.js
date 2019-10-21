var imagePreset = new Class({
	options: {
		imageOut: new Object(),
		imageOver: new Object(),
		f: "DXImageTransform.Microsoft.AlphaImageLoader",
		selector: Class.empty,
		pngFixPath: "images/_blank.gif"
	},

	initialize: function(options){
		this.setOptions(options);
		this.initImages();
	},
	
	initImages: function() {	
		var fn = this;
		var pngRegExp = new RegExp("\\.png$", "i");
		
		// collect objects
		var imgArr = new Array();
		if ($type(fn.options.selector) == false) {
			imgArr.extend($$("img", "input"));
		} else if (fn.options.selector) {
			if ($type(fn.options.selector.each) == "function") {
				fn.options.selector.each(function(el){
					imgArr.extend(el.getElements("img")).extend(el.getElements("input"));
				});
			} else {
				imgArr.extend(fn.options.selector.getElements("img")).extend(fn.options.selector.getElements("input"));
			}
		}
		
		// apply settings to all images & inputs
		imgArr.each(function(item){
			var image = item.src.substr(item.src.lastIndexOf("/") + 1);
			var id = item.id || image.replace("_n.", "").replace("_N.", "");
			var hover = (image.toLowerCase().lastIndexOf("_n.") != -1);
			
			// preload
			if (hover) {
				fn.options.imageOut[id] = new Image();
				fn.options.imageOut[id].src = item.src;
				fn.options.imageOver[id] = new Image();
				fn.options.imageOver[id].src = item.src.substr(0, item.src.lastIndexOf("/")+1)+image.replace("_n.", "_o.").replace("_N.", "_O.");
			};
			
			// PNG Fix for IE<7
			if (Browser.Engine.trident4 && image.test(pngRegExp)) {
				item.set("styles", {
					width: item.offsetWidth,
					height: item.offsetHeight,
					filter: "progid:"+fn.options.f+"(src='"+item.src+"', sizingMethod='scale');"
				});
				item.src = fn.options.pngFixPath;
			};
			
			// add event hover images
			if (hover) {
				item.set("id", id);
				item.addEvents({
					"mouseover": function(e){
						try {
							fn.setImage(this, fn.options.imageOver[this.id].src);
						} catch(err) {}
					},
					"mouseout": function(){
						try {
							fn.setImage(this, fn.options.imageOut[this.id].src);
						} catch(err) {}
					}
				});
			};
		});
	},
	
	// set on / off images
	setImage: function (obj, src) {
		if (obj.hasClass("imgSelected")) {
			return;
		}
		if (Browser.Engine.trident4) {
			if (obj.filters[this.options.f] && obj.filters[this.options.f].src.test(pngRegExp)) {
				obj.filters[this.options.f].src = src;
			} else {
				obj.src = src;
			}
		} else {
			obj.src = src;
		}
	}
});
imagePreset.implement(new Chain, new Events, new Options);

// start
window.addEvent("domready", function(){
	new imagePreset();
});